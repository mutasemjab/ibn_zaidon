<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware($this->perm('package-table'))->only(['index', 'show']);
        $this->middleware($this->perm('package-add'))->only(['create', 'store']);
        $this->middleware($this->perm('package-edit'))->only(['edit', 'update']);
        $this->middleware($this->perm('package-delete'))->only(['destroy']);
    }

    public function index(Request $request)
    {
        $packages = Package::withCount('courses')
            ->when($request->search, fn ($q, $s) => $q
                ->where('title_ar', 'like', "%{$s}%")
                ->orWhere('title_en', 'like', "%{$s}%")
            )
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $courses = $this->coursesForPicker();

        return view('admin.packages.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $courseIds = $data['course_ids'];
        unset($data['course_ids']);

        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('assets/uploads/packages', $request->file('image'));
        }

        $package = Package::create($data);
        $package->courses()->sync($courseIds);

        return redirect()->route('admin.packages.index')
            ->with('success', __('messages.package_created'));
    }

    public function edit(Package $package)
    {
        $package->load('courses');
        $courses = $this->coursesForPicker();

        return view('admin.packages.edit', compact('package', 'courses'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $this->validated($request);

        $courseIds = $data['course_ids'];
        unset($data['course_ids']);

        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('assets/uploads/packages', $request->file('image'));
        }

        $package->update($data);
        $package->courses()->sync($courseIds);

        return redirect()->route('admin.packages.index')
            ->with('success', __('messages.package_updated'));
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', __('messages.package_deleted'));
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title_ar'        => 'required|string|max:255',
            'title_en'        => 'nullable|string|max:255',
            'description_ar'  => 'nullable|string',
            'description_en'  => 'nullable|string',
            'pick_count'      => 'required|integer|min:1|max:20',
            'price'           => 'required|numeric|min:0',
            'old_price'       => 'nullable|numeric|min:0',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'       => 'boolean',
            'is_featured'     => 'boolean',
            'sort_order'      => 'nullable|integer|min:0',
            'course_ids'      => ['required', 'array', 'min:1'],
            'course_ids.*'    => 'integer|exists:courses,id',
        ]);
    }

    // Courses grouped by their subject's full path, for a readable pool picker.
    private function coursesForPicker(): \Illuminate\Support\Collection
    {
        return \App\Models\Course::with(['subject.category.parent.parent'])
            ->where('is_published', true)
            ->orderBy('title_ar')
            ->get()
            ->map(function ($course) {
                $course->picker_group = $course->subject?->full_path ?? __('messages.uncategorized');
                return $course;
            })
            ->groupBy('picker_group');
    }
}
