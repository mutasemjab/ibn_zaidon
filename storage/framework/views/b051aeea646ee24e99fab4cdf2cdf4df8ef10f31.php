<?php $__env->startSection('title', 'نتائج: ' . ($exam->title_ar ?: $exam->title_en)); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">نتائج الطلاب</h1>
        <p class="page-sub"><?php echo e($exam->title_ar ?: $exam->title_en); ?> · <?php echo e($attempts->count()); ?> طالب أجرى الاختبار</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('teacher.exams.show', $exam->id)); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> رجوع للاختبار</a>
    </div>
</div>

<?php if($attempts->isEmpty()): ?>
    <div class="panel-card">
        <div class="panel-card-body text-center py-5" style="color:var(--muted)">
            <i class="bi bi-inbox" style="font-size:2.5rem;display:block;margin-bottom:12px"></i>
            لم يُجرِ أي طالب هذا الاختبار بعد.
        </div>
    </div>
<?php else: ?>


<div class="panel-card mb-4">
    <div class="panel-card-header">
        <h2 class="panel-card-title">ملخص النتائج</h2>
    </div>
    <div class="panel-card-body p-0" style="overflow-x:auto">
        <table class="data-table" style="white-space:nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الطالب</th>
                    <th>الدرجة</th>
                    <th>النسبة</th>
                    <th>الحالة</th>
                    <th>وقت التقديم</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $attempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($attempt->student->name ?? '—'); ?></td>
                    <td><?php echo e($attempt->score); ?> / <?php echo e($attempt->total_marks); ?></td>
                    <td><?php echo e(number_format($attempt->percentage, 1)); ?>%</td>
                    <td>
                        <?php if($attempt->is_passed): ?>
                            <span class="pill pill-success">ناجح</span>
                        <?php else: ?>
                            <span class="pill pill-warning">راسب</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($attempt->submitted_at?->format('Y-m-d H:i') ?? '—'); ?></td>
                    <td>
                        <a href="#attempt-<?php echo e($attempt->id); ?>" class="btn-outline-sm" style="padding:3px 8px">
                            <i class="bi bi-eye"></i> الإجابات
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>


<?php $__currentLoopData = $attempts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attempt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="panel-card mb-4" id="attempt-<?php echo e($attempt->id); ?>">
    <div class="panel-card-header">
        <h2 class="panel-card-title">
            <?php echo e($attempt->student->name ?? 'طالب #'.$attempt->student_id); ?>

            <span class="pill pill-<?php echo e($attempt->is_passed ? 'success' : 'warning'); ?>" style="margin-inline-start:8px">
                <?php echo e($attempt->score); ?>/<?php echo e($attempt->total_marks); ?> (<?php echo e(number_format($attempt->percentage, 1)); ?>%)
            </span>
        </h2>
    </div>
    <div class="panel-card-body">
        <?php $__empty_1 = true; $__currentLoopData = $attempt->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="mb-4 pb-3" style="border-bottom:1px solid var(--border)">
            <div class="d-flex justify-content-between align-items-start mb-2 gap-2">
                <div style="font-weight:500;flex:1">
                    <span style="color:var(--primary)">س<?php echo e($loop->iteration); ?>.</span>
                    <?php echo e($answer->question->question_ar ?? $answer->question->question_en ?? '—'); ?>

                </div>
                <div style="flex-shrink:0">
                    <?php if($answer->is_correct): ?>
                        <span class="pill pill-success"><i class="bi bi-check-lg"></i> صحيح</span>
                    <?php else: ?>
                        <span class="pill pill-warning"><i class="bi bi-x-lg"></i> خطأ</span>
                    <?php endif; ?>
                    <span class="pill pill-info ms-1"><?php echo e($answer->marks_earned ?? 0); ?> علامة</span>
                </div>
            </div>

            <?php if($answer->question && $answer->question->options->count()): ?>
            <div class="ps-3">
                <?php $__currentLoopData = $answer->question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $isSelected = $answer->selected_option_id === $opt->id;
                ?>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-<?php echo e($opt->is_correct ? 'check-circle-fill' : ($isSelected && !$opt->is_correct ? 'x-circle-fill' : 'circle')); ?>"
                       style="color:<?php echo e($opt->is_correct ? '#059669' : ($isSelected && !$opt->is_correct ? '#dc2626' : 'var(--muted)')); ?>;flex-shrink:0"></i>
                    <span style="font-size:.85rem;<?php echo e($isSelected ? 'font-weight:600' : ''); ?>">
                        <?php echo e($opt->option_text_ar ?: $opt->option_text_en); ?>

                        <?php if($isSelected && !$opt->is_correct): ?>
                            <span style="color:#dc2626;font-size:.78rem"> (إجابة الطالب)</span>
                        <?php elseif($isSelected && $opt->is_correct): ?>
                            <span style="color:#059669;font-size:.78rem"> (إجابة الطالب ✓)</span>
                        <?php endif; ?>
                    </span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php elseif($answer->selectedOption): ?>
            <div class="ps-3" style="font-size:.85rem;color:var(--muted)">
                إجابة الطالب: <strong style="color:var(--text)"><?php echo e($answer->selectedOption->option_text_ar); ?></strong>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p style="color:var(--muted);font-size:.9rem">لا توجد إجابات مسجلة.</p>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\exams\results.blade.php ENDPATH**/ ?>