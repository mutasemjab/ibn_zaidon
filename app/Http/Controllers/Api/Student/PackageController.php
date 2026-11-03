<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\CardNumber;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    use ApiResponse;

    // GET /packages — active packages, ordered like the admin sort order
    public function index(): JsonResponse
    {
        $packages = Package::active()
            ->withCount('courses')
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($p) => $this->packageCard($p));

        return $this->success($packages);
    }

    // GET /packages/{id} — package detail + the eligible course pool to pick from
    public function show(int $id): JsonResponse
    {
        $package = Package::active()->with(['courses.teacher'])->find($id);

        if (! $package) {
            return $this->error(
                app()->getLocale() === 'ar' ? 'الباقة غير موجودة' : 'Package not found',
                404
            );
        }

        $data = $this->packageCard($package);
        $data['courses'] = $package->courses->map(fn ($c) => $this->poolCourseCard($c))->values();

        return $this->success($data);
    }

    // POST /packages/{id}/activate  [auth]  body: { card_code, course_ids: [...] }
    public function activate(Request $request, int $id): JsonResponse
    {
        $package = Package::active()->with('courses')->find($id);

        if (! $package) {
            return $this->error(
                app()->getLocale() === 'ar' ? 'الباقة غير موجودة' : 'Package not found',
                404
            );
        }

        $request->validate([
            'card_code'     => ['required', 'string', 'max:100'],
            'course_ids'    => ['required', 'array', 'size:' . $package->pick_count],
            'course_ids.*'  => ['integer'],
        ]);

        $poolIds     = $package->courses->pluck('id')->all();
        $selectedIds = array_map('intval', $request->input('course_ids'));

        if (count(array_unique($selectedIds)) !== count($selectedIds)) {
            return $this->error('لا يمكن اختيار نفس الدورة أكثر من مرة', 422);
        }

        if (count(array_diff($selectedIds, $poolIds)) > 0) {
            return $this->error('الدورات المختارة لا تنتمي لهذه الباقة', 422);
        }

        $student = $request->user();

        // Find valid card number: active, not used, not yet sold — same
        // convention as single-course activation (CourseActivationController).
        $cardNumber = CardNumber::with('card')
            ->where('number', trim($request->card_code))
            ->where('activate', 1)
            ->where('status', 2)
            ->where('sell', 2)
            ->first();

        if (! $cardNumber || ! $cardNumber->card) {
            return $this->error('رمز البطاقة غير صحيح أو تم استخدامه مسبقاً', 422);
        }

        $card = $cardNumber->card;

        if ($card->activation_type !== 'package' || (int) $card->linked_package_id !== $package->id) {
            return $this->error('هذه البطاقة غير مخصصة لتفعيل هذه الباقة', 422);
        }

        DB::transaction(function () use ($student, $selectedIds, $cardNumber) {
            foreach ($selectedIds as $courseId) {
                Enrollment::firstOrCreate(
                    ['student_id' => $student->id, 'course_id' => $courseId],
                    [
                        'enrolled_at'         => now(),
                        'is_active'           => true,
                        'is_completed'        => false,
                        'progress_percentage' => 0,
                    ]
                );
            }

            $cardNumber->update([
                'status'           => 1,
                'sell'             => 1,
                'assigned_user_id' => $student->id,
            ]);
        });

        return $this->success([
            'package_id' => $package->id,
            'course_ids' => $selectedIds,
        ], 'تم تفعيل الباقة بنجاح! يمكنك البدء الآن', 201);
    }

    private function packageCard(Package $package): array
    {
        return [
            'id'             => $package->id,
            'title'          => $package->title,
            'title_ar'       => $package->title_ar,
            'title_en'       => $package->title_en,
            'description'    => $package->description,
            'image'          => $package->image ? asset('assets/uploads/packages/' . $package->image) : null,
            'pick_count'     => $package->pick_count,
            'price'          => $package->price,
            'old_price'      => $package->old_price,
            'discount'       => $package->discount_percentage,
            'is_featured'    => $package->is_featured,
            'courses_count'  => $package->courses_count ?? $package->courses->count(),
        ];
    }

    private function poolCourseCard(Course $course): array
    {
        return [
            'id'        => $course->id,
            'title'     => $course->title,
            'thumbnail' => $course->thumbnail ? asset('assets/uploads/courses/' . $course->thumbnail) : null,
            'price'     => $course->price,
            'old_price' => $course->old_price,
            'teacher'   => [
                'id'   => $course->teacher?->id,
                'name' => $course->teacher?->name,
            ],
        ];
    }
}
