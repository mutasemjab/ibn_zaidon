<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentsExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use App\Models\AdminActivityLog;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware($this->perm('student-table'))->only(['index', 'show', 'export']);
        $this->middleware($this->perm('student-add'))->only(['create', 'store', 'import']);
        $this->middleware($this->perm('student-edit'))->only(['edit', 'update', 'resetDevice']);
        $this->middleware($this->perm('student-delete'))->only(['destroy']);
    }

    public function index(Request $request)
    {
        $students = Student::withCount('enrollments')
            ->when($request->search, fn ($q, $s) => $q
                ->where(fn ($sub) => $sub
                    ->where('name', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%")
                    ->orWhere('national_id', 'like', "%{$s}%")
                )
            )
            ->when($request->filled('class_id'), fn ($q) =>
                $q->where('class_id', $request->class_id)
            )
            ->when($request->is_active !== null && $request->is_active !== '', fn ($q) =>
                $q->where('is_active', $request->boolean('is_active'))
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();


        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:200',
            'national_id' => 'nullable|string|max:50|unique:students,national_id',
            'email'       => 'nullable|email|unique:students,email',
            'phone'       => 'nullable|string|max:20',
            'password'    => 'required|string|min:6',
            'gender'      => 'nullable|in:male,female',
            'nationality' => 'nullable|string|max:100',
            'avatar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = uploadImage('public/uploads/students', $request->file('avatar'));
        }

        $student = Student::create($data);
        AdminActivityLog::log('create', "إضافة طالب: {$student->name}", 'students', $student->id);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Request $request, Student $student)
    {
        $student->load(['enrollments.course', 'examAttempts.exam',]);

        $siblingResults = collect();
        if ($request->filled('sibling_search')) {
            $s = $request->sibling_search;
            $excludeIds = $student->siblings->pluck('id')->push($student->id);

            $siblingResults = Student::whereNotIn('id', $excludeIds)
                ->where(fn ($q) => $q
                    ->where('name', 'like', "%{$s}%")
                    ->orWhere('national_id', 'like', "%{$s}%")
                    ->orWhere('phone', 'like', "%{$s}%")
                )
                ->limit(20)
                ->get();
        }

        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:200',
            'national_id' => 'nullable|string|max:50|unique:students,national_id,' . $student->id,
            'email'       => 'nullable|email|unique:students,email,' . $student->id,
            'phone'       => 'nullable|string|max:20',
            'password'    => 'nullable|string|min:6',
            'gender'      => 'nullable|in:male,female',
            'nationality' => 'nullable|string|max:100',
            'is_active'   => 'boolean',
            'avatar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if (empty($data['password'])) {
            unset($data['password']);
        }

        if ($request->hasFile('avatar')) {
            $data['avatar'] = uploadImage('public/uploads/students', $request->file('avatar'));
        }

        $student->update($data);
        AdminActivityLog::log('update', "تعديل طالب: {$student->name}", 'students', $student->id);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function resetDevice(Student $student)
    {
        $student->update(['deviceId' => null]);

        return back()->with('success', 'تم إعادة تعيين الجهاز. يمكن للطالب الآن تسجيل الدخول من جهاز جديد.');
    }

    public function destroy(Student $student)
    {
        AdminActivityLog::log('delete', "حذف طالب: {$student->name}", 'students', $student->id);
        $student->forceDelete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }

   
}
