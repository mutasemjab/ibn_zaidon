<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // ── Roles & Employees ──────────────────────────────────────────────
            'role-table',             'role-add',             'role-edit',             'role-delete',
            'employee-table',         'employee-add',         'employee-edit',         'employee-delete',

            // ── Activity Log ───────────────────────────────────────────────────
            'activity-log-table',     'activity-log-delete',

            // ── Students ───────────────────────────────────────────────────────
            'student-table',          'student-add',          'student-edit',          'student-delete',

            // ── Teachers ───────────────────────────────────────────────────────
            'teacher-table',          'teacher-add',          'teacher-edit',          'teacher-delete',

            // ── Courses ────────────────────────────────────────────────────────
            'course-table',           'course-add',           'course-edit',           'course-delete',
            'course-content-add',     'course-content-edit',  'course-content-delete',

            // ── Categories ─────────────────────────────────────────────────────
            'category-table',         'category-add',         'category-edit',         'category-delete',

            // ── Subjects ───────────────────────────────────────────────────────
            'subject-table',          'subject-add',          'subject-edit',          'subject-delete',

            // ── Exams ──────────────────────────────────────────────────────────
            'exam-table',             'exam-add',             'exam-edit',             'exam-delete',

            // ── Question Banks ─────────────────────────────────────────────────
            'question-bank-table',    'question-bank-add',    'question-bank-edit',    'question-bank-delete',

            // ── Previous Year Exams ────────────────────────────────────────────
            'previous-exam-table',    'previous-exam-add',    'previous-exam-edit',    'previous-exam-delete',

            // ── Worksheets ─────────────────────────────────────────────────────
            'worksheet-table',        'worksheet-add',        'worksheet-edit',        'worksheet-delete',

            // ── Enrollments ────────────────────────────────────────────────────
            'enrollment-table',       'enrollment-edit',       'enrollment-delete',

            // ── Cards ──────────────────────────────────────────────────────────
            'card-table',             'card-add',             'card-edit',             'card-delete',
            'card-number-table',      'card-number-add',      'card-number-edit',      'card-number-delete',

            // ── Banners ────────────────────────────────────────────────────────
            'banner-table',           'banner-add',           'banner-edit',           'banner-delete',

            // ── Push Notifications ─────────────────────────────────────────────
            'notification-send',

            // ── Cities ────────────────────────────────────────────────────────
            'city-table',             'city-add',             'city-edit',             'city-delete',

            // ── Points of Sale ─────────────────────────────────────────────────
            'pos-table',              'pos-add',              'pos-edit',              'pos-delete',

            // ── Contact Messages ───────────────────────────────────────────────
            'contact-message-table',  'contact-message-delete',

            // ── Settings ──────────────────────────────────────────────────────
            'setting-edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }
    }
}
