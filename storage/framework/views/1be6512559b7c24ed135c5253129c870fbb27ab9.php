<?php $__env->startSection('title', __('front.exam_result_title')); ?>

<?php $__env->startSection('content'); ?>
<?php $letters = __('front.option_letters'); ?>

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">/</span>
            <a href="<?php echo e(route('exams.index')); ?>"><?php echo e(__('front.nav_exams')); ?></a>
            <span class="sep">/</span>
            <span><?php echo e(__('front.exam_result_crumb')); ?></span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0">
            <i class="bi bi-bar-chart-fill me-2"></i><?php echo e(__('front.exam_result_title')); ?>

        </h1>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center g-5">

        
        <div class="col-lg-4">
            <div class="contact-card text-center">
                <div class="result-circle <?php echo e($attempt->is_passed ? 'pass' : 'fail'); ?> mb-4">
                    <div class="result-pct" style="color:<?php echo e($attempt->is_passed ? 'var(--z-success)' : '#dc3545'); ?>">
                        <?php echo e($attempt->percentage); ?>%
                    </div>
                    <?php if($attempt->is_passed): ?>
                        <div class="result-pass-lbl mt-1"><i class="bi bi-check-circle-fill me-1"></i><?php echo e(__('front.exam_passed')); ?></div>
                    <?php else: ?>
                        <div class="result-fail-lbl mt-1"><i class="bi bi-x-circle-fill me-1"></i><?php echo e(__('front.exam_failed')); ?></div>
                    <?php endif; ?>
                </div>

                <h4 style="color:var(--z-primary);font-weight:800;margin-bottom:.5rem"><?php echo e($exam->title); ?></h4>

                <div class="row g-3 mt-2">
                    <div class="col-6">
                        <div style="background:rgba(40,167,69,.08);border-radius:var(--z-radius);padding:.75rem">
                            <div style="font-size:1.3rem;font-weight:800;color:var(--z-success)"><?php echo e($attempt->score); ?></div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)"><?php echo e(__('front.exam_score')); ?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:rgba(11,61,145,.06);border-radius:var(--z-radius);padding:.75rem">
                            <div style="font-size:1.3rem;font-weight:800;color:var(--z-primary)"><?php echo e($attempt->total_marks); ?></div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)"><?php echo e(__('front.exam_total_marks')); ?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:rgba(40,167,69,.06);border-radius:var(--z-radius);padding:.75rem">
                            <div style="font-size:1.3rem;font-weight:800;color:var(--z-success)">
                                <?php echo e($attempt->answers->where('is_correct', true)->count()); ?>

                            </div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)"><?php echo e(__('front.exam_correct_answers')); ?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:rgba(220,53,69,.06);border-radius:var(--z-radius);padding:.75rem">
                            <div style="font-size:1.3rem;font-weight:800;color:#dc3545">
                                <?php echo e($attempt->answers->where('is_correct', false)->count()); ?>

                            </div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)"><?php echo e(__('front.exam_wrong_answers')); ?></div>
                        </div>
                    </div>
                </div>

                <?php if($attempt->time_taken_seconds): ?>
                <div class="mt-3" style="font-size:.85rem;color:var(--z-text-muted)">
                    <i class="bi bi-clock me-1"></i>
                    <?php echo e(__('front.exam_time_taken')); ?>: <?php echo e(gmdate('i:s', $attempt->time_taken_seconds)); ?>

                </div>
                <?php endif; ?>

                <div class="d-flex flex-column gap-2 mt-4">
                    <a href="<?php echo e(route('exams.index')); ?>" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-grid-3x3-gap"></i> <?php echo e(__('front.exam_other_exams')); ?>

                    </a>
                    <a href="<?php echo e(route('exams.show', $exam->id)); ?>" class="btn-z btn-z-outline btn-z-block">
                        <i class="bi bi-arrow-repeat"></i> <?php echo e(__('front.exam_retry')); ?>

                    </a>
                </div>
            </div>
        </div>

        
        <div class="col-lg-8">
            <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">
                <i class="bi bi-eye-fill me-2"></i><?php echo e(__('front.exam_review')); ?>

            </h5>

            <?php $__currentLoopData = $exam->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $answer = $attempt->answers->firstWhere('question_id', $question->id);
                $isCorrect = $answer && $answer->is_correct;
                $correctOption = $question->options->firstWhere('is_correct', true);
                $selectedOption = $answer?->selectedOption;
            ?>
            <div class="q-card" style="border-color:<?php echo e($isCorrect ? 'rgba(40,167,69,.3)' : 'rgba(220,53,69,.3)'); ?>;
                                        background:<?php echo e($isCorrect ? 'rgba(40,167,69,.02)' : 'rgba(220,53,69,.02)'); ?>">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="q-num"><?php echo e(__('front.exam_question_n', ['n' => $i + 1])); ?></span>
                    <?php if($isCorrect): ?>
                        <span style="color:var(--z-success);font-size:.82rem;font-weight:700"><i class="bi bi-check-circle-fill me-1"></i><?php echo e(__('front.exam_correct')); ?></span>
                    <?php else: ?>
                        <span style="color:#dc3545;font-size:.82rem;font-weight:700"><i class="bi bi-x-circle-fill me-1"></i><?php echo e(__('front.exam_wrong')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="q-text"><?php echo e($question->question_text); ?></div>

                <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isSelected  = $selectedOption && $selectedOption->id === $option->id;
                    $isCorrectOpt = $option->is_correct;
                    $cls = '';
                    if ($isCorrectOpt) $cls = 'correct';
                    elseif ($isSelected && !$isCorrectOpt) $cls = 'wrong';
                ?>
                <label class="opt-lbl <?php echo e($cls); ?>" style="cursor:default">
                    <span class="opt-marker" style="<?php echo e($isCorrectOpt ? 'border-color:var(--z-success);background:var(--z-success);color:#fff' : ($cls==='wrong' ? 'border-color:#dc3545;background:#dc3545;color:#fff' : '')); ?>">
                        <?php echo e($letters[$j] ?? ($j+1)); ?>

                    </span>
                    <span><?php echo e($option->option_text); ?></span>
                    <?php if($isCorrectOpt): ?>
                        <i class="bi bi-check-circle-fill ms-auto" style="color:var(--z-success)"></i>
                    <?php elseif($isSelected && !$isCorrectOpt): ?>
                        <i class="bi bi-x-circle-fill ms-auto" style="color:#dc3545"></i>
                    <?php endif; ?>
                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(!$isCorrect && $question->explanation): ?>
                <div style="margin-top:.75rem;padding:.75rem;background:rgba(30,107,214,.06);border-radius:8px;border-inline-start:3px solid var(--z-accent)">
                    <div style="font-size:.8rem;font-weight:700;color:var(--z-accent);margin-bottom:.3rem">
                        <i class="bi bi-lightbulb-fill me-1"></i><?php echo e(__('front.exam_explanation')); ?>

                    </div>
                    <div style="font-size:.85rem;color:var(--z-text)"><?php echo e($question->explanation); ?></div>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\exam-result.blade.php ENDPATH**/ ?>