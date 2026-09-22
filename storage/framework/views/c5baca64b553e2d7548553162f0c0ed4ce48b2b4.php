<?php
    $siteName    = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name');
    $locale      = app()->getLocale();
    $cur         = __('front.currency');
    $isFree      = ($course->price ?? 0) == 0;
    $lessonTotal = $course->units->sum(fn ($u) => $u->lessons->count());
    $teacherName = $course->teacher->name ?? null;
?>
<?php $__env->startSection('seo_title', $course->title . ' | ' . $siteName); ?>
<?php $__env->startSection('meta_desc', Str::limit(strip_tags($course->description ?: __('front.course_meta_desc_fallback', ['site' => $siteName, 'teacher' => $teacherName ?? $siteName])), 160)); ?>
<?php $__env->startSection('og_type', 'article'); ?>

<?php $__env->startPush('json_ld'); ?>
<?php
    $courseLd = array_filter([
        '@context'    => 'https://schema.org',
        '@type'       => 'Course',
        'name'        => $course->title,
        'description' => Str::limit(strip_tags($course->description), 300) ?: null,
        'url'         => url()->current(),
        'provider'    => ['@type' => 'EducationalOrganization', '@id' => url('/') . '/#organization', 'name' => $siteName],
        'instructor'  => $course->teacher ? array_filter([
            '@type'    => 'Person',
            'name'     => $course->teacher->name,
            'jobTitle' => $course->teacher->specialization ?: null,
        ]) : null,
        'inLanguage'       => $locale,
        'educationalLevel' => $course->category->name ?? null,
        'offers' => [
            '@type'         => 'Offer',
            'price'         => (string) ($course->price ?? 0),
            'priceCurrency' => 'JOD',
            'availability'  => 'https://schema.org/InStock',
            'category'      => $isFree ? __('front.jsonld_free') : __('front.jsonld_paid'),
        ],
        'hasCourseInstance' => ['@type' => 'CourseInstance', 'courseMode' => 'online', 'inLanguage' => $locale],
    ]);
    $crumbLd = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => __('front.home'),                   'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => __('front.courses_page_breadcrumb'), 'item' => route('courses.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $course->title,                      'item' => url()->current()],
        ],
    ];
    $ldFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG;
?>
<script type="application/ld+json"><?php echo json_encode($courseLd, $ldFlags); ?></script>
<script type="application/ld+json"><?php echo json_encode($crumbLd, $ldFlags); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="course-hero">
    <div class="container">
        <div class="z-breadcrumb mb-3">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo e(route('courses.index')); ?>"><?php echo e(__('front.courses_page_breadcrumb')); ?></a>
            <span class="sep">/</span>
            <span><?php echo e(Str::limit($course->title, 40)); ?></span>
        </div>
        <div class="row align-items-start g-4">
            <div class="col-lg-8">
                <h1><?php echo e($course->title); ?></h1>
                <?php if($course->description): ?>
                <p style="color:rgba(255,255,255,.78);font-size:.97rem;margin-top:.75rem;max-width:680px">
                    <?php echo e(Str::limit($course->description, 200)); ?>

                </p>
                <?php endif; ?>
                <div class="c-meta-strip">
                    <?php if($course->teacher): ?>
                    <span class="c-meta"><i class="bi bi-person-fill"></i> <?php echo e($course->teacher->name); ?></span>
                    <?php endif; ?>
                    <?php if($course->category): ?>
                    <span class="c-meta"><i class="bi bi-tag-fill"></i> <?php echo e($course->category->name); ?></span>
                    <?php endif; ?>
                    <span class="c-meta"><i class="bi bi-people-fill"></i> <?php echo e(number_format($course->total_students ?? 0)); ?> <?php echo e(__('front.courses_students')); ?></span>
                    <?php if($course->units->count()): ?>
                    <span class="c-meta"><i class="bi bi-collection-play"></i> <?php echo e($course->units->count()); ?> <?php echo e(__('front.course_units_count')); ?></span>
                    <?php endif; ?>
                    <?php if($course->average_rating): ?>
                    <span class="c-meta"><i class="bi bi-star-fill" style="color:var(--z-highlight)"></i> <?php echo e(number_format($course->average_rating, 1)); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">

    
    <?php if(session('activation_success') && session('activated_course') == $course->id): ?>
    <div class="z-flash flash-success mb-4">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <span><?php echo e(session('activation_success')); ?></span>
    </div>
    <?php endif; ?>
    <?php if(session('activation_error') && session('error_course') == $course->id): ?>
    <div class="z-flash flash-error mb-4">
        <i class="bi bi-exclamation-circle-fill fs-5"></i>
        <span><?php echo e(session('activation_error')); ?></span>
    </div>
    <?php endif; ?>

    <div class="row g-5">

        
        <div class="col-lg-8" id="curriculum">

            
            <?php if($course->what_you_learn): ?>
            <div class="mb-5 p-4" style="background:rgba(245,166,35,.06);border-radius:var(--z-radius-lg);border:1.5px solid rgba(245,166,35,.2)">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1rem">
                    <i class="bi bi-lightbulb-fill text-warning me-2"></i><?php echo e(__('front.course_what_learn')); ?>

                </h5>
                <div class="row g-2">
                    <?php $__currentLoopData = explode("\n", $course->what_you_learn); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(trim($point)): ?>
                    <div class="col-md-6 d-flex align-items-start gap-2">
                        <i class="bi bi-check-circle-fill mt-1" style="color:var(--z-success);flex-shrink:0"></i>
                        <span style="font-size:.9rem"><?php echo e(trim($point)); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

            
            <h4 style="color:var(--z-primary);font-weight:800;margin-bottom:1.25rem">
                <i class="bi bi-collection-play-fill me-2"></i><?php echo e(__('front.course_content_title')); ?>

            </h4>

            <?php $__empty_1 = true; $__currentLoopData = $course->units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="mb-2">
                <button class="unit-acc-btn <?php echo e($loop->first ? '' : 'collapsed'); ?>"
                        data-body="unit-body-<?php echo e($unit->id); ?>">
                    <span>
                        <span style="background:rgba(255,255,255,.18);border-radius:6px;padding:.1rem .5rem;font-size:.78rem;margin-inline-end:.6rem"><?php echo e($loop->iteration); ?></span>
                        <?php echo e($unit->title); ?>

                    </span>
                    <span class="d-flex align-items-center gap-2">
                        <span style="font-size:.78rem;opacity:.7"><?php echo e($unit->lessons->count()); ?> <?php echo e(__('front.course_unit_lessons')); ?></span>
                        <i class="bi bi-chevron-down acc-ico" style="transition:transform .25s"></i>
                    </span>
                </button>
                <div class="unit-acc-body <?php echo e($loop->first ? 'show' : ''); ?>" id="unit-body-<?php echo e($unit->id); ?>">
                    <?php $__empty_2 = true; $__currentLoopData = $unit->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                    <div class="lesson-row">
                        <div class="lesson-ic">
                            <?php if($lesson->lesson_type === 'video'): ?>
                                <i class="bi bi-play-fill text-primary"></i>
                            <?php elseif($lesson->lesson_type === 'pdf'): ?>
                                <i class="bi bi-file-pdf text-danger"></i>
                            <?php else: ?>
                                <i class="bi bi-file-text"></i>
                            <?php endif; ?>
                        </div>
                        <span style="flex:1"><?php echo e($lesson->title); ?></span>
                        <?php if($lesson->duration_minutes): ?>
                        <span style="font-size:.78rem;color:var(--z-text-muted)"><?php echo e($lesson->duration_minutes); ?> <?php echo e(__('front.course_min_short')); ?></span>
                        <?php endif; ?>
                        <?php if(!$isEnrolled && !$lesson->is_free): ?>
                        <span class="lesson-lock"><i class="bi bi-lock-fill"></i></span>
                        <?php else: ?>
                        <span style="color:var(--z-success);font-size:.82rem"><i class="bi bi-play-circle-fill"></i></span>
                        <?php endif; ?>
                    </div>
                    <?php if(isset($lessonExams[$lesson->id])): ?>
                    <div class="lesson-row" style="background:rgba(245,166,35,.06);border-color:rgba(245,166,35,.25)">
                        <div class="lesson-ic" style="background:rgba(245,166,35,.15)"><i class="bi bi-clipboard-check text-warning"></i></div>
                        <span style="flex:1;font-size:.85rem"><?php echo e($lessonExams[$lesson->id]->title); ?></span>
                        <span style="font-size:.75rem;color:#b97700;background:rgba(245,166,35,.12);padding:.15rem .5rem;border-radius:50px"><?php echo e(__('front.exam_label')); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                    <div class="lesson-row" style="color:var(--z-text-muted);font-size:.88rem"><?php echo e(__('front.course_no_lessons')); ?></div>
                    <?php endif; ?>
                    <?php if(isset($unitEndExams[$unit->id])): ?>
                    <div class="lesson-row" style="background:rgba(11,61,145,.05);border-color:rgba(11,61,145,.18)">
                        <div class="lesson-ic" style="background:rgba(11,61,145,.1)"><i class="bi bi-journal-check text-primary"></i></div>
                        <span style="flex:1;font-size:.88rem;font-weight:600"><?php echo e($unitEndExams[$unit->id]->title); ?></span>
                        <span style="font-size:.75rem;color:var(--z-primary);background:rgba(11,61,145,.1);padding:.15rem .5rem;border-radius:50px"><?php echo e(__('front.unit_exam')); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="text-align:center;padding:3rem;color:var(--z-text-muted)">
                <i class="bi bi-collection" style="font-size:3rem;opacity:.35;display:block;margin-bottom:1rem"></i>
                <?php echo e(__('front.course_no_units')); ?>

            </div>
            <?php endif; ?>

            
            <?php if($courseExams->isNotEmpty()): ?>
            <div class="mt-4 p-3" style="background:var(--z-section-bg);border-radius:var(--z-radius);border:1.5px dashed var(--z-border)">
                <h6 style="color:var(--z-primary);font-weight:700;margin-bottom:.75rem">
                    <i class="bi bi-clipboard-data-fill me-2"></i><?php echo e(__('front.course_final_exams_title')); ?>

                </h6>
                <?php $__currentLoopData = $courseExams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex align-items-center gap-3 py-2 border-bottom" style="border-color:var(--z-border)!important">
                    <i class="bi bi-file-earmark-check-fill" style="color:var(--z-success);font-size:1.1rem"></i>
                    <span style="flex:1;font-size:.9rem"><?php echo e($exam->title); ?></span>
                    <?php if($isEnrolled): ?>
                    <a href="<?php echo e(route('exams.show', $exam->id)); ?>" class="btn-z btn-z-success btn-z-sm"><?php echo e(__('front.course_start_short')); ?></a>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            
            <?php if($relatedCourses->isNotEmpty()): ?>
            <div class="mt-5">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem"><?php echo e(__('front.course_similar')); ?></h5>
                <div class="row g-3">
                    <?php $__currentLoopData = $relatedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="course-card">
                            <div class="course-thumb-ph" style="aspect-ratio:16/6;font-size:2rem"><i class="bi bi-play-circle"></i></div>
                            <div class="course-body">
                                <div class="course-title" style="-webkit-line-clamp:2"><?php echo e($rc->title); ?></div>
                                <div class="course-teacher"><div class="av-xs"><i class="bi bi-person-fill"></i></div><span><?php echo e($rc->teacher->name ?? __('front.teacher_fallback')); ?></span></div>
                            </div>
                            <div class="course-foot">
                                <span class="price-tag <?php echo e(($rc->price??0)==0?'price-free':''); ?>">
                                    <?php echo e(($rc->price??0)>0 ? number_format($rc->price,2).' '.$cur : __('front.courses_free')); ?>

                                </span>
                            </div>
                            <div class="px-3 pb-3">
                                <a href="<?php echo e(route('courses.show', $rc->id)); ?>" class="btn-z btn-z-outline btn-z-sm btn-z-block"><?php echo e(__('front.view')); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="col-lg-4">
            <div class="purchase-box">
                <?php if($isEnrolled): ?>
                
                <div style="text-align:center;padding:1rem 0">
                    <div style="width:64px;height:64px;background:rgba(40,167,69,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;font-size:1.8rem;color:var(--z-success)">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h5 style="color:var(--z-success)"><?php echo e(__('front.course_enrolled_title')); ?></h5>
                    <p style="color:var(--z-text-muted);font-size:.88rem"><?php echo e(__('front.course_enrolled_desc')); ?></p>
                    <a href="#curriculum" class="btn-z btn-z-success btn-z-lg btn-z-block mt-2">
                        <i class="bi bi-play-circle-fill"></i> <?php echo e(__('front.course_start_learning')); ?>

                    </a>
                </div>
                <?php else: ?>
                
                <div class="purchase-price">
                    <?php if(! $isFree): ?>
                        <?php echo e(number_format($course->price, 2)); ?>

                        <span class="cur"><?php echo e($cur); ?></span>
                    <?php else: ?>
                        <span style="color:var(--z-success)"><?php echo e(__('front.courses_free')); ?></span>
                    <?php endif; ?>
                </div>

                
                <?php if(! $isFree): ?>
                <form method="POST" action="<?php echo e(route('cart.add', $course->id)); ?>" class="mb-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                        <i class="bi bi-cart-plus-fill"></i> <?php echo e(__('front.course_add_cart_btn')); ?>

                    </button>
                </form>
                <?php endif; ?>

                
                <?php if(auth()->guard('student')->check()): ?>
                <div class="mt-3">
                    <div class="divider-text"><span><?php echo e(__('front.course_or_card')); ?></span></div>
                    <form method="POST" action="<?php echo e(route('courses.activate', $course->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="card_number"
                               class="z-input code-input mb-2 <?php echo e($errors->has('card_number') ? 'is-invalid' : ''); ?>"
                               placeholder="XXXX-XXXX-XXXX" dir="ltr"
                               value="<?php echo e(old('card_number')); ?>" required>
                        <?php $__errorArgs = ['card_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <button type="submit" class="btn-z btn-z-success btn-z-block">
                            <i class="bi bi-key-fill"></i> <?php echo e(__('front.course_activate_btn')); ?>

                        </button>
                    </form>
                </div>
                <?php else: ?>
                <div class="mt-3 text-center">
                    <p style="font-size:.85rem;color:var(--z-text-muted)">
                        <a href="<?php echo e(route('student.login')); ?>" style="color:var(--z-accent);font-weight:600"><?php echo e(__('front.course_login_link')); ?></a>
                        <?php echo e(__('front.course_login_suffix')); ?>

                    </p>
                </div>
                <?php endif; ?>

                
                <div class="mt-4 pt-3" style="border-top:1.5px solid var(--z-border)">
                    <div class="include-row"><i class="bi bi-infinity"></i> <?php echo e(__('front.course_inc_unlimited')); ?></div>
                    <div class="include-row"><i class="bi bi-phone-fill"></i> <?php echo e(__('front.course_inc_devices')); ?></div>
                    <?php if($courseExams->isNotEmpty()): ?>
                    <div class="include-row"><i class="bi bi-clipboard-check-fill"></i> <?php echo e(__('front.course_inc_final_exam', ['count' => $courseExams->count()])); ?></div>
                    <?php endif; ?>
                    <?php if($lessonTotal > 0): ?>
                    <div class="include-row"><i class="bi bi-collection-play-fill"></i> <?php echo e(__('front.course_inc_lessons', ['count' => $lessonTotal])); ?></div>
                    <?php endif; ?>
                    <div class="include-row"><i class="bi bi-award-fill"></i> <?php echo e(__('front.course_sidebar_cert')); ?></div>
                </div>
                <?php endif; ?>

                
                <?php if($course->teacher): ?>
                <div class="mt-4 pt-3" style="border-top:1.5px solid var(--z-border);text-align:center">
                    <div class="t-photo-ph" style="width:56px;height:56px;font-size:1.3rem;margin-bottom:.6rem">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div style="font-weight:700;color:var(--z-primary);font-size:.95rem"><?php echo e($course->teacher->name); ?></div>
                    <?php if($course->teacher->specialization): ?>
                    <div style="font-size:.8rem;color:var(--z-text-muted);margin-bottom:.6rem"><?php echo e($course->teacher->specialization); ?></div>
                    <?php endif; ?>
                    <a href="<?php echo e(route('teachers.show', $course->teacher->id)); ?>"
                       class="btn-z btn-z-outline btn-z-sm"><?php echo e(__('front.teacher_view_profile_btn')); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\course-detail.blade.php ENDPATH**/ ?>