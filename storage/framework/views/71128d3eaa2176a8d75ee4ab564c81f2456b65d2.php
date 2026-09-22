<?php $__env->startSection('title', $teacher->name); ?>

<?php $__env->startSection('content'); ?>
<?php
    $siteName    = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name');
    $cur         = __('front.currency');
    $rating      = (float) ($teacher->average_rating ?? 0);
    $courseCount = $teacher->courses->count();
?>


<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:3rem 0 2.5rem">
    <div class="container">
        <div class="z-breadcrumb mb-4">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo e(route('home')); ?>#teachers"><?php echo e(__('front.nav_teachers')); ?></a>
            <span class="sep">/</span>
            <span><?php echo e($teacher->name); ?></span>
        </div>
        <div class="row align-items-center g-4">
            <div class="col-auto">
                <div style="width:110px;height:110px;border-radius:50%;background:rgba(255,255,255,.15);border:3px solid rgba(255,255,255,.35);display:flex;align-items:center;justify-content:center;font-size:2.8rem;color:rgba(255,255,255,.6)">
                    <i class="bi bi-person-circle"></i>
                </div>
            </div>
            <div class="col">
                <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2.1rem);margin-bottom:.4rem"><?php echo e($teacher->name); ?></h1>
                <?php if($teacher->specialization): ?>
                <div style="color:rgba(255,255,255,.72);font-size:.97rem;margin-bottom:.75rem">
                    <?php echo e($teacher->specialization); ?>

                </div>
                <?php endif; ?>
                <div class="d-flex flex-wrap gap-3">
                    <?php if($rating > 0): ?>
                    <span style="background:rgba(245,166,35,.18);color:var(--z-highlight);padding:.3rem .85rem;border-radius:50px;font-size:.82rem;font-weight:700">
                        <i class="bi bi-star-fill me-1"></i><?php echo e(number_format($rating, 1)); ?> <?php echo e(__('front.teacher_info_rating')); ?>

                    </span>
                    <?php endif; ?>
                    <span style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);padding:.3rem .85rem;border-radius:50px;font-size:.82rem">
                        <i class="bi bi-people-fill me-1"></i><?php echo e(number_format($teacher->total_students ?? 0)); ?> <?php echo e(__('front.courses_students')); ?>

                    </span>
                    <span style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);padding:.3rem .85rem;border-radius:50px;font-size:.82rem">
                        <i class="bi bi-play-btn-fill me-1"></i><?php echo e($courseCount); ?> <?php echo e(__('front.teacher_course_label')); ?>

                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">

        
        <div class="col-lg-4">
            <div class="contact-card mb-4">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.1rem">
                    <i class="bi bi-person-badge-fill me-2"></i><?php echo e(__('front.teacher_about')); ?>

                </h5>
                <?php if($teacher->bio): ?>
                <p style="color:var(--z-text-muted);font-size:.9rem;line-height:1.8"><?php echo e($teacher->bio); ?></p>
                <?php else: ?>
                <p style="color:var(--z-text-muted);font-size:.9rem">
                    <?php echo e(__('front.teacher_bio_fallback', ['site' => $siteName])); ?>

                </p>
                <?php endif; ?>

                <?php if($teacher->subjects->isNotEmpty()): ?>
                <div class="mt-3 pt-3" style="border-top:1.5px solid var(--z-border)">
                    <h6 style="color:var(--z-primary);font-weight:700;font-size:.88rem;margin-bottom:.75rem"><?php echo e(__('front.teacher_info_subjects')); ?></h6>
                    <div class="d-flex flex-wrap gap-2">
                        <?php $__currentLoopData = $teacher->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span style="background:rgba(11,61,145,.08);color:var(--z-primary);padding:.25rem .75rem;border-radius:50px;font-size:.8rem;font-weight:600">
                            <?php echo e($subject->name); ?>

                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="mt-3 pt-3" style="border-top:1.5px solid var(--z-border)">
                    <div class="d-flex justify-content-around text-center">
                        <div>
                            <div style="font-size:1.4rem;font-weight:800;color:var(--z-primary)"><?php echo e(number_format($teacher->total_students ?? 0)); ?></div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)"><?php echo e(__('front.courses_students')); ?></div>
                        </div>
                        <div style="width:1px;background:var(--z-border)"></div>
                        <div>
                            <div style="font-size:1.4rem;font-weight:800;color:var(--z-primary)"><?php echo e($courseCount); ?></div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)"><?php echo e(__('front.teacher_course_label')); ?></div>
                        </div>
                        <?php if($rating > 0): ?>
                        <div style="width:1px;background:var(--z-border)"></div>
                        <div>
                            <div style="font-size:1.4rem;font-weight:800;color:var(--z-highlight)"><?php echo e(number_format($rating, 1)); ?></div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)"><?php echo e(__('front.teacher_info_rating')); ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-8">
            <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">
                <i class="bi bi-collection-play-fill me-2"></i><?php echo e(__('front.teacher_courses_title')); ?>

                <span style="font-size:.82rem;font-weight:400;color:var(--z-text-muted);margin-inline-start:.5rem">
                    <?php echo e(__('front.teacher_courses_count', ['count' => $courseCount])); ?>

                </span>
            </h5>

            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $teacher->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6">
                    <div class="course-card">
                        <div class="course-thumb-ph"><i class="bi bi-play-circle"></i></div>
                        <div class="course-body">
                            <div class="course-title"><?php echo e($course->title); ?></div>
                            <div style="font-size:.8rem;color:var(--z-text-muted);margin-bottom:.5rem">
                                <i class="bi bi-people-fill me-1"></i><?php echo e(number_format($course->enrollments_count ?? $course->total_students ?? 0)); ?> <?php echo e(__('front.courses_students')); ?>

                            </div>
                        </div>
                        <div class="course-foot">
                            <span class="price-tag <?php echo e(($course->price??0)==0?'price-free':''); ?>">
                                <?php echo e(($course->price??0)>0 ? number_format($course->price,2).' '.$cur : __('front.courses_free')); ?>

                            </span>
                        </div>
                        <div class="px-3 pb-3">
                            <a href="<?php echo e(route('courses.show', $course->id)); ?>"
                               class="btn-z btn-z-primary btn-z-sm btn-z-block">
                                <i class="bi bi-eye"></i> <?php echo e(__('front.course_view_btn')); ?>

                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-4" style="color:var(--z-text-muted)">
                    <i class="bi bi-collection" style="font-size:3rem;opacity:.3;display:block;margin-bottom:1rem"></i>
                    <?php echo e(__('front.teacher_no_courses')); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\teacher-profile.blade.php ENDPATH**/ ?>