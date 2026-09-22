<?php $__env->startSection('title', __('front.nav_exams')); ?>

<?php $__env->startSection('content'); ?>
<?php
    $isRtl    = app()->getLocale() === 'ar';
    $prevIcon = $isRtl ? 'chevron-right' : 'chevron-left';
    $nextIcon = $isRtl ? 'chevron-left'  : 'chevron-right';
?>

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">/</span>
            <span><?php echo e(__('front.nav_exams')); ?></span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2rem);margin:0">
            <i class="bi bi-clipboard-check-fill me-2"></i><?php echo e(__('front.exams_page_header')); ?>

        </h1>
        <p style="color:rgba(255,255,255,.7);margin:.5rem 0 0;font-size:.95rem">
            <?php echo e(__('front.exams_page_sub')); ?>

        </p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">

        
        <div class="col-lg-8">
            
            <div class="d-flex gap-2 flex-wrap mb-4">
                <a href="<?php echo e(route('exams.index')); ?>"
                   class="btn-z btn-z-sm <?php echo e(!request('type') ? 'btn-z-primary' : 'btn-z-outline'); ?>">
                    <?php echo e(__('front.courses_filter_all_tag')); ?>

                </a>
                <a href="<?php echo e(route('exams.index', ['type'=>'practice'])); ?>"
                   class="btn-z btn-z-sm <?php echo e(request('type')==='practice' ? 'btn-z-primary' : 'btn-z-outline'); ?>">
                    <i class="bi bi-pencil-square"></i> <?php echo e(__('front.exams_filter_practice')); ?>

                </a>
                <a href="<?php echo e(route('exams.index', ['type'=>'previous_years'])); ?>"
                   class="btn-z btn-z-sm <?php echo e(request('type')==='previous_years' ? 'btn-z-primary' : 'btn-z-outline'); ?>">
                    <i class="bi bi-calendar-check"></i> <?php echo e(__('front.exam_type_previous')); ?>

                </a>
                <a href="<?php echo e(route('exams.index', ['type'=>'question_bank'])); ?>"
                   class="btn-z btn-z-sm <?php echo e(request('type')==='question_bank' ? 'btn-z-primary' : 'btn-z-outline'); ?>">
                    <i class="bi bi-database-check"></i> <?php echo e(__('front.exam_type_bank')); ?>

                </a>
            </div>

            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6">
                    <div class="exam-card">
                        <?php
                            $typeMap = [
                                'practice'      => ['pill-practice', __('front.exam_type_practice')],
                                'previous_years'=> ['pill-prev',     __('front.exam_type_previous')],
                                'question_bank' => ['pill-bank',     __('front.exam_type_bank')],
                            ];
                            [$pillClass, $pillLabel] = $typeMap[$exam->exam_type ?? ''] ?? ['pill-practice', __('front.exam_label')];
                        ?>
                        <span class="exam-pill <?php echo e($pillClass); ?>"><?php echo e($pillLabel); ?></span>
                        <h5 style="font-size:.97rem;font-weight:700;color:var(--z-text);margin-bottom:.5rem">
                            <?php echo e($exam->title); ?>

                        </h5>
                        <?php if($exam->academic_year): ?>
                        <div style="font-size:.8rem;color:var(--z-text-muted);margin-bottom:.5rem">
                            <i class="bi bi-calendar3 me-1"></i><?php echo e(__('front.exam_generation', ['year' => $exam->academic_year])); ?>

                        </div>
                        <?php endif; ?>
                        <div class="d-flex flex-wrap gap-2 mt-auto">
                            <?php if($exam->questions_count ?? null): ?>
                            <span style="font-size:.78rem;color:var(--z-text-muted)">
                                <i class="bi bi-question-circle me-1"></i><?php echo e($exam->questions_count); ?> <?php echo e(__('front.questions')); ?>

                            </span>
                            <?php endif; ?>
                            <?php if($exam->duration_minutes): ?>
                            <span style="font-size:.78rem;color:var(--z-text-muted)">
                                <i class="bi bi-clock me-1"></i><?php echo e($exam->duration_minutes); ?> <?php echo e(__('front.exams_minutes')); ?>

                            </span>
                            <?php endif; ?>
                            <span style="font-size:.78rem;color:var(--z-text-muted)">
                                <i class="bi bi-people me-1"></i><?php echo e(number_format($exam->total_attempts ?? 0)); ?>

                            </span>
                        </div>
                        <a href="<?php echo e(route('exams.show', $exam->id)); ?>"
                           class="btn-z btn-z-primary btn-z-sm btn-z-block mt-3">
                            <i class="bi bi-eye"></i> <?php echo e(__('front.exams_view_btn')); ?>

                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-clipboard-x" style="font-size:4rem;color:var(--z-border)"></i>
                    <h5 style="color:var(--z-text-muted);margin-top:1rem"><?php echo e(__('front.exams_no_exams')); ?></h5>
                </div>
                <?php endif; ?>
            </div>

            
            <?php if($exams->hasPages()): ?>
            <nav class="z-pagination mt-4">
                <?php if($exams->onFirstPage()): ?>
                    <span class="z-page-link disabled"><i class="bi bi-<?php echo e($prevIcon); ?>"></i></span>
                <?php else: ?>
                    <a href="<?php echo e($exams->previousPageUrl()); ?>" class="z-page-link"><i class="bi bi-<?php echo e($prevIcon); ?>"></i></a>
                <?php endif; ?>
                <?php $__currentLoopData = $exams->getUrlRange(max(1,$exams->currentPage()-2), min($exams->lastPage(),$exams->currentPage()+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($url); ?>" class="z-page-link <?php echo e($page==$exams->currentPage()?'current':''); ?>"><?php echo e($page); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($exams->hasMorePages()): ?>
                    <a href="<?php echo e($exams->nextPageUrl()); ?>" class="z-page-link"><i class="bi bi-<?php echo e($nextIcon); ?>"></i></a>
                <?php else: ?>
                    <span class="z-page-link disabled"><i class="bi bi-<?php echo e($nextIcon); ?>"></i></span>
                <?php endif; ?>
            </nav>
            <?php endif; ?>
        </div>

        
        <div class="col-lg-4">
            <div class="lb-card">
                <div class="lb-head">
                    <i class="bi bi-trophy-fill text-warning fs-5"></i>
                    <h5><?php echo e(__('front.exams_week_champions')); ?></h5>
                </div>
                <?php $__empty_1 = true; $__currentLoopData = $leaderboard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="lb-row">
                    <div class="lb-pos <?php echo e($i===0?'pos-1':($i===1?'pos-2':($i===2?'pos-3':'pos-n'))); ?>">
                        <?php if($i < 3): ?><?php echo e(['🥇','🥈','🥉'][$i]); ?><?php else: ?><?php echo e($i+1); ?><?php endif; ?>
                    </div>
                    <div>
                        <div class="lb-name"><?php echo e($entry->student->name ?? __('front.lb_student_fallback')); ?></div>
                        <div style="font-size:.75rem;color:var(--z-text-muted)"><?php echo e($entry->exam->title ?? ''); ?></div>
                    </div>
                    <span class="lb-pct"><?php echo e($entry->percentage); ?>%</span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding:1.5rem;text-align:center;color:var(--z-text-muted);font-size:.88rem">
                    <i class="bi bi-trophy" style="font-size:2rem;opacity:.3;display:block;margin-bottom:.75rem"></i>
                    <?php echo e(__('front.exams_lb_empty')); ?><br><?php echo e(__('front.exams_lb_empty2')); ?>

                </div>
                <?php endif; ?>
            </div>

            <div class="mt-4 p-4" style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:var(--z-radius-lg);color:#fff;text-align:center">
                <div style="font-size:2.5rem;margin-bottom:.75rem">🎯</div>
                <h5 style="color:#fff;font-weight:800"><?php echo e(__('front.exams_cta_title')); ?></h5>
                <p style="color:rgba(255,255,255,.75);font-size:.88rem;margin-bottom:1.25rem">
                    <?php echo e(__('front.exams_cta_desc')); ?>

                </p>
                <?php if(auth()->guard('student')->guest()): ?>
                <a href="<?php echo e(route('student.register')); ?>" class="btn-z btn-z-accent btn-z-block">
                    <i class="bi bi-person-plus-fill"></i> <?php echo e(__('front.exams_cta_register')); ?>

                </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\exams.blade.php ENDPATH**/ ?>