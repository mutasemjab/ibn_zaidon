<?php $__env->startSection('title', $exam->title); ?>

<?php $__env->startSection('content'); ?>
<?php
    $isRtl         = app()->getLocale() === 'ar';
    $questionCount = $exam->questions()->count();
?>

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-3">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo e(route('exams.index')); ?>"><?php echo e(__('front.nav_exams')); ?></a>
            <span class="sep">/</span>
            <span><?php echo e(Str::limit($exam->title, 40)); ?></span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0"><?php echo e($exam->title); ?></h1>
        <?php if($exam->description): ?>
        <p style="color:rgba(255,255,255,.72);margin:.6rem 0 0;font-size:.93rem;max-width:600px">
            <?php echo e(Str::limit($exam->description, 180)); ?>

        </p>
        <?php endif; ?>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5 justify-content-center">
        <div class="col-lg-7">

            
            <div class="contact-card mb-4">
                <div class="row g-3 text-center mb-4">
                    <?php if($questionCount): ?>
                    <div class="col-4">
                        <div style="background:rgba(11,61,145,.06);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-primary)"><?php echo e($questionCount); ?></div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)"><?php echo e(__('front.questions')); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($exam->duration_minutes): ?>
                    <div class="col-4">
                        <div style="background:rgba(245,166,35,.08);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-highlight)"><?php echo e($exam->duration_minutes); ?></div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)"><?php echo e(__('front.exams_minutes')); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($exam->average_success_rate): ?>
                    <div class="col-4">
                        <div style="background:rgba(40,167,69,.06);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-success)"><?php echo e($exam->average_success_rate); ?>%</div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)"><?php echo e(__('front.exam_avg_success')); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <?php if($exam->subject): ?>
                    <div class="d-flex align-items-center gap-2 mb-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-book-fill" style="color:var(--z-primary)"></i>
                        <span><?php echo e(__('front.exam_subject_label')); ?> <strong style="color:var(--z-text)"><?php echo e($exam->subject->name); ?></strong></span>
                    </div>
                    <?php endif; ?>
                    <?php if($exam->academic_year): ?>
                    <div class="d-flex align-items-center gap-2 mb-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-calendar3" style="color:var(--z-primary)"></i>
                        <span><?php echo e(__('front.exam_year_label')); ?> <strong style="color:var(--z-text)"><?php echo e($exam->academic_year); ?></strong></span>
                    </div>
                    <?php endif; ?>
                    <?php if($exam->pass_marks): ?>
                    <div class="d-flex align-items-center gap-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-check-circle-fill" style="color:var(--z-success)"></i>
                        <span><?php echo e(__('front.exam_pass_marks')); ?> <strong style="color:var(--z-text)"><?php echo e($exam->pass_marks); ?></strong></span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="p-3 mb-4" style="background:rgba(245,166,35,.07);border:1px solid rgba(245,166,35,.2);border-radius:var(--z-radius)">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-info-circle-fill mt-1" style="color:var(--z-highlight);flex-shrink:0"></i>
                        <div style="font-size:.87rem;color:var(--z-text-muted)">
                            <?php echo e(__('front.exam_warning')); ?>

                            <?php if($exam->duration_minutes): ?>
                                <?php echo __('front.exam_duration_note', ['minutes' => '<strong style="color:var(--z-primary)">'.e($exam->duration_minutes).'</strong>']); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if(auth()->guard('student')->check()): ?>
                <a href="<?php echo e(route('exams.take', $exam->id)); ?>"
                   class="btn-z btn-z-primary btn-z-lg btn-z-block">
                    <i class="bi bi-play-circle-fill"></i>
                    <?php echo e(__('front.exam_start_now')); ?>

                </a>
                <?php else: ?>
                <div class="text-center">
                    <p style="color:var(--z-text-muted);font-size:.9rem;margin-bottom:1rem">
                        <?php echo e(__('front.exam_login_required')); ?>

                    </p>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="<?php echo e(route('student.login')); ?>" class="btn-z btn-z-primary btn-z-lg">
                            <i class="bi bi-box-arrow-in-right"></i> <?php echo e(__('front.auth_login_title')); ?>

                        </a>
                        <a href="<?php echo e(route('student.register')); ?>" class="btn-z btn-z-outline btn-z-lg">
                            <i class="bi bi-person-plus"></i> <?php echo e(__('front.auth_register_title')); ?>

                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="text-center">
                <a href="<?php echo e(route('exams.index')); ?>" style="color:var(--z-text-muted);font-size:.88rem">
                    <i class="bi bi-arrow-<?php echo e($isRtl ? 'right' : 'left'); ?> me-1"></i> <?php echo e(__('front.exam_back_list')); ?>

                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\exam-show.blade.php ENDPATH**/ ?>