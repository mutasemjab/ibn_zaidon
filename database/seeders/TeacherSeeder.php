<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        // Preload grade-10 semester category IDs for grade-specific lookups
        $g10 = Category::where('level', 1)
            ->whereHas('parent', fn ($q) => $q->where('name_en', 'Main Grades'))
            ->where('order_index', 10)
            ->with('children')
            ->first();
        $g10SemIds = $g10?->children->pluck('id')->toArray() ?? [];

        $g9 = Category::where('level', 1)
            ->whereHas('parent', fn ($q) => $q->where('name_en', 'Main Grades'))
            ->where('order_index', 9)
            ->with('children')
            ->first();
        $g9SemIds = $g9?->children->pluck('id')->toArray() ?? [];

        $g7to10SemIds = Category::where('level', 2)
            ->whereHas('parent.parent', fn ($q) => $q->where('name_en', 'Main Grades'))
            ->whereHas('parent', fn ($q) => $q->whereIn('order_index', [7, 8, 9, 10]))
            ->pluck('id')->toArray();

        // Ministry sub-category IDs under grade-12 streams (level 3: مواد وزارية / مواد مدرسية)
        $grade12Streams = Category::where('level', 2)
            ->whereHas('parent', fn ($q) => $q->where('name_en', 'Tawjihi Grade 12'))
            ->with(['children' => fn ($q) => $q->orderBy('order_index')])
            ->orderBy('order_index')
            ->get()
            ->keyBy('order_index');

        $streamSubCatIds = [];
        foreach ($grade12Streams as $streamOrder => $stream) {
            foreach ($stream->children as $sub) {
                $streamSubCatIds[$streamOrder][$sub->order_index] = $sub->id;
            }
        }

        $healthMin = isset($streamSubCatIds[1][1]) ? [$streamSubCatIds[1][1]] : [];
        $engMin    = isset($streamSubCatIds[2][1]) ? [$streamSubCatIds[2][1]] : [];

        $teachers = [
            [
                'name'               => 'أ. محمد أحمد الزيود',
                'email'              => 'mohammad.zayoud@IbnZaidon.jo',
                'phone'              => '+962799001001',
                'password'           => 'IbnZaidon2024',
                'specialization_ar'  => 'الرياضيات والفيزياء',
                'specialization_en'  => 'Mathematics & Physics',
                'bio_ar'             => 'مدرس الرياضيات والفيزياء لأكثر من ١٥ عاماً. خبرة واسعة في توجيهي العلمي.',
                'bio_en'             => 'Mathematics and Physics teacher with over 15 years of experience in Tawjihi science track.',
                'qualification_ar'   => 'ماجستير في الرياضيات التطبيقية — جامعة الأردن',
                'qualification_en'   => 'M.Sc. Applied Mathematics — University of Jordan',
                'years_of_experience'=> 15,
                'gender'             => 'male',
                'average_rating'     => 4.9,
                'total_students'     => 1850,
                'total_courses'      => 8,
                'is_verified'        => true,
                'is_active'          => true,
                'subject_query'      => fn () => Subject::whereIn('category_id', array_merge(
                    $g10SemIds,
                    $healthMin,
                    $engMin
                ))->whereIn('name_ar', ['الرياضيات', 'الفيزياء'])->pluck('id'),
            ],
            [
                'name'               => 'أ. سارة عبدالله النمر',
                'email'              => 'sara.namer@IbnZaidon.jo',
                'phone'              => '+962799001002',
                'password'           => 'IbnZaidon2024',
                'specialization_ar'  => 'اللغة العربية وآدابها',
                'specialization_en'  => 'Arabic Language & Literature',
                'bio_ar'             => 'متخصصة في تدريس اللغة العربية للمراحل الأساسية والتوجيهي.',
                'bio_en'             => 'Specialist in Arabic language teaching for all stages.',
                'qualification_ar'   => 'ماجستير في اللغة العربية — جامعة اليرموك',
                'qualification_en'   => 'M.A. Arabic Language — Yarmouk University',
                'years_of_experience'=> 12,
                'gender'             => 'female',
                'average_rating'     => 4.8,
                'total_students'     => 1420,
                'total_courses'      => 6,
                'is_verified'        => true,
                'is_active'          => true,
                'subject_query'      => fn () => Subject::whereIn('category_id', array_merge(
                    $g7to10SemIds,
                    $healthMin
                ))->whereIn('name_ar', ['اللغة العربية', 'اللغة العربية وآدابها'])->pluck('id'),
            ],
            [
                'name'               => 'أ. خالد نادر الشريدة',
                'email'              => 'khaled.shraida@IbnZaidon.jo',
                'phone'              => '+962799001003',
                'password'           => 'IbnZaidon2024',
                'specialization_ar'  => 'الكيمياء والعلوم',
                'specialization_en'  => 'Chemistry & Sciences',
                'bio_ar'             => 'مدرس الكيمياء لمرحلة التوجيهي الفرع العلمي والصحي.',
                'bio_en'             => 'Chemistry teacher for Tawjihi science and health tracks.',
                'qualification_ar'   => 'بكالوريوس كيمياء — الجامعة الأردنية',
                'qualification_en'   => 'B.Sc. Chemistry — University of Jordan',
                'years_of_experience'=> 10,
                'gender'             => 'male',
                'average_rating'     => 4.7,
                'total_students'     => 980,
                'total_courses'      => 5,
                'is_verified'        => true,
                'is_active'          => true,
                'subject_query'      => fn () => Subject::whereIn('category_id', array_merge(
                    $g9SemIds,
                    $g10SemIds,
                    $healthMin,
                    $engMin
                ))->where('name_ar', 'الكيمياء')->pluck('id'),
            ],
            [
                'name'               => 'أ. رنا هاني جرار',
                'email'              => 'rana.jarrar@IbnZaidon.jo',
                'phone'              => '+962799001004',
                'password'           => 'IbnZaidon2024',
                'specialization_ar'  => 'اللغة الإنجليزية',
                'specialization_en'  => 'English Language',
                'bio_ar'             => 'معلمة اللغة الإنجليزية للمراحل الأساسية والتوجيهي بخبرة ١٢ عاماً.',
                'bio_en'             => 'English language teacher for all grades with 12 years of experience.',
                'qualification_ar'   => 'ماجستير في اللغويات التطبيقية — جامعة البترا',
                'qualification_en'   => 'M.A. Applied Linguistics — Petra University',
                'years_of_experience'=> 12,
                'gender'             => 'female',
                'average_rating'     => 4.8,
                'total_students'     => 1100,
                'total_courses'      => 5,
                'is_verified'        => true,
                'is_active'          => true,
                'subject_query'      => fn () => Subject::whereIn('category_id', array_merge(
                    $g7to10SemIds,
                    $healthMin
                ))->where('name_ar', 'اللغة الإنجليزية')->pluck('id'),
            ],
        ];

        foreach ($teachers as $data) {
            $subjectQuery = $data['subject_query'];
            unset($data['subject_query']);

            $teacher = Teacher::updateOrCreate(
                ['email' => $data['email']],
                array_merge($data, ['password' => bcrypt($data['password'])])
            );

            $teacher->subjects()->sync($subjectQuery());
        }
    }
}
