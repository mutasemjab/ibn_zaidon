
<?php $__env->startSection('title', $exam->title_en ?: $exam->title_ar); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e($exam->title_en ?: $exam->title_ar); ?></h1>
        <p class="page-sub"><?php echo e($exam->questions->count()); ?> <?php echo e(__('messages.t_questions')); ?> · <?php echo e($exam->duration_minutes); ?> <?php echo e(__('messages.t_min')); ?> · <?php echo e(__('messages.t_pass')); ?>: <?php echo e($exam->pass_marks); ?>/<?php echo e($exam->total_marks); ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('teacher.exams.results', $exam->id)); ?>" class="btn-primary-sm"><i class="bi bi-bar-chart"></i> نتائج الطلاب</a>
        <a href="<?php echo e(route('teacher.exams.edit', $exam->id)); ?>" class="btn-outline-sm"><i class="bi bi-pencil"></i> <?php echo e(__('messages.t_edit')); ?></a>
        <a href="<?php echo e(route('teacher.exams.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.t_back')); ?></a>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3">
        <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-3">

    
    <div class="col-12 col-xl-7">
        <div class="panel-card">
            <div class="panel-card-header">
                <h2 class="panel-card-title"><?php echo e(__('messages.t_questions')); ?> (<?php echo e($exam->questions->count()); ?>)</h2>
            </div>
            <div class="panel-card-body">
                <?php $__empty_1 = true; $__currentLoopData = $exam->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="mb-4 pb-3" style="border-bottom:1px solid var(--border)">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div style="font-weight:500;flex:1">
                            <span style="color:var(--primary)">Q<?php echo e($loop->iteration); ?>.</span>
                            <?php echo e($q->question_ar ?: $q->question_en); ?>

                        </div>
                        <div class="d-flex gap-1" style="flex-shrink:0">
                            <?php
                                $qEditData = $q->only(['id','question_ar','question_en','image','question_type','difficulty','marks','explanation_ar','explanation_en']);
                                $qEditOpts = $q->options->map(fn($o) => ['text_ar' => $o->option_text_ar, 'text_en' => $o->option_text_en, 'correct' => (bool) $o->is_correct])->values()->all();
                            ?>
                            <button type="button" class="btn-outline-sm" style="padding:3px 7px"
                                    onclick='openEditQuestion(<?php echo json_encode($qEditData, 15, 512) ?>, <?php echo json_encode($qEditOpts, 15, 512) ?>)'>
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="<?php echo e(route('teacher.exams.questions.destroy', $q->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.t_confirm_delete_question')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn-outline-sm" style="padding:3px 7px;color:#dc2626;border-color:#fecaca"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php if($q->image): ?>
                    <div class="mb-2">
                        <img src="<?php echo e(asset('assets/uploads/questions/'.$q->image)); ?>"
                             alt="question image"
                             style="max-height:160px;border-radius:8px;border:1px solid #e2e8f0;cursor:pointer"
                             onclick="this.style.maxHeight=this.style.maxHeight==='none'?'160px':'none'">
                    </div>
                    <?php endif; ?>
                    <div class="d-flex gap-2 mb-2">
                        <span class="pill pill-neutral"><?php echo e(ucfirst(str_replace('_',' ',$q->question_type))); ?></span>
                        <span class="pill pill-info"><?php echo e($q->marks); ?> <?php echo e($q->marks > 1 ? __('messages.t_marks') : __('messages.t_mark')); ?></span>
                        <span class="pill pill-<?php echo e($q->difficulty === 'easy' ? 'success' : ($q->difficulty === 'hard' ? 'warning' : 'neutral')); ?>"><?php echo e(ucfirst($q->difficulty)); ?></span>
                    </div>
                    <?php if($q->options->count()): ?>
                    <div class="ps-3">
                        <?php $__currentLoopData = $q->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-<?php echo e($opt->is_correct ? 'check-circle-fill' : 'circle'); ?>" style="color:<?php echo e($opt->is_correct ? '#059669' : 'var(--muted)'); ?>"></i>
                            <span style="font-size:.85rem"><?php echo e($opt->option_text_ar ?: $opt->option_text_en); ?></span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="color:var(--muted)"><?php echo e(__('messages.t_no_questions_yet')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-12 col-xl-5">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.t_add_question')); ?></h2></div>
            <div class="panel-card-body">
                <form action="<?php echo e(route('teacher.exams.questions.store', $exam->id)); ?>" method="POST" enctype="multipart/form-data" id="question-form">
                <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('messages.t_question_ar')); ?> <span class="text-danger">*</span></label>
                        <?php echo $__env->make('partials.symbol_picker', ['target' => 'question_text_ar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <textarea name="question_text_ar" id="question_text_ar" rows="2" class="form-control symbol-target" dir="rtl" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('messages.t_question_en')); ?></label>
                        <textarea name="question_text_en" id="question_text_en" rows="2" class="form-control symbol-target"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('messages.question_image')); ?> <span style="color:var(--muted);font-size:.8rem">(<?php echo e(__('messages.optional')); ?>)</span></label>
                        <input type="file" name="question_image" accept="image/*" class="form-control form-control-sm"
                               onchange="previewImg(this, 'qimg-preview')">
                        <img id="qimg-preview" src="" alt="" style="display:none;max-height:120px;margin-top:8px;border-radius:8px;border:1px solid #e2e8f0">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label"><?php echo e(__('messages.t_type')); ?></label>
                            <select name="question_type" class="form-select form-select-sm" onchange="toggleOptions('', this.value)">
                                <option value="mcq">اختيار متعدد</option>
                                <option value="true_false">صح وخطأ</option>
                                <option value="short_answer"><?php echo e(__('messages.t_short_answer')); ?></option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><?php echo e(__('messages.t_difficulty')); ?></label>
                            <select name="difficulty" class="form-select form-select-sm">
                                <option value="easy"><?php echo e(__('messages.t_easy')); ?></option>
                                <option value="medium" selected><?php echo e(__('messages.t_medium')); ?></option>
                                <option value="hard"><?php echo e(__('messages.t_hard')); ?></option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><?php echo e(__('messages.t_marks')); ?></label>
                            <input type="number" name="marks" value="1" min="1" class="form-control form-control-sm">
                        </div>
                    </div>

                    
                    <div id="options-section">
                        <label class="form-label"><?php echo e(__('messages.t_options')); ?></label>

                        
                        <div id="mcq-rows" data-next-index="4">
                            <?php for($i = 0; $i < 4; $i++): ?>
                            <div class="option-row d-flex align-items-center gap-2 mb-2">
                                <input type="radio" name="correct_option" value="<?php echo e($i); ?>" <?php echo e($i === 0 ? 'checked' : ''); ?>>
                                <input type="text" name="options[<?php echo e($i); ?>][text_ar]" class="form-control form-control-sm symbol-target" placeholder="<?php echo e(__('messages.t_option')); ?> <?php echo e($i+1); ?> (<?php echo e(__('messages.t_arabic')); ?>)" dir="rtl">
                                <input type="text" name="options[<?php echo e($i); ?>][text_en]" class="form-control form-control-sm symbol-target" placeholder="<?php echo e(__('messages.t_english')); ?>">
                                <input type="hidden" name="options[<?php echo e($i); ?>][correct]" value="<?php echo e($i === 0 ? '1' : '0'); ?>" class="correct-flag">
                                <button type="button" class="btn-outline-sm" style="padding:3px 8px;color:#dc2626;flex-shrink:0" onclick="removeOptionRow(this, '')"><i class="bi bi-x-lg"></i></button>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <button type="button" class="btn-outline-sm mb-3" onclick="addOptionRow('')"><i class="bi bi-plus-lg"></i> <?php echo e(__('messages.add_option')); ?></button>

                        
                        <div id="tf-rows" style="display:none">
                            <div class="option-row d-flex align-items-center gap-2 mb-2">
                                <input type="radio" name="correct_option" value="0" checked disabled>
                                <span class="form-control form-control-sm" style="background:#f0fdf4;border-color:#86efac;color:#166534;font-weight:600">✓ صح (True)</span>
                                <input type="hidden" name="options[0][text_ar]" value="صح" disabled>
                                <input type="hidden" name="options[0][text_en]" value="True" disabled>
                                <input type="hidden" name="options[0][correct]" value="1" class="correct-flag" disabled>
                            </div>
                            <div class="option-row d-flex align-items-center gap-2 mb-2">
                                <input type="radio" name="correct_option" value="1" disabled>
                                <span class="form-control form-control-sm" style="background:#fef2f2;border-color:#fca5a5;color:#dc2626;font-weight:600">✗ خطأ (False)</span>
                                <input type="hidden" name="options[1][text_ar]" value="خطأ" disabled>
                                <input type="hidden" name="options[1][text_en]" value="False" disabled>
                                <input type="hidden" name="options[1][correct]" value="0" class="correct-flag" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><?php echo e(__('messages.t_explanation_ar')); ?></label>
                        <textarea name="explanation_ar" rows="2" class="form-control symbol-target" dir="rtl"></textarea>
                    </div>

                    <button type="submit" class="btn-primary-sm w-100 justify-content-center">
                        <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.t_add_question')); ?>

                    </button>
                </form>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="editQuestionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form id="edit-question-form" method="POST" enctype="multipart/form-data" data-url-template="<?php echo e(url('teacher/questions/__ID__')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="modal-header">
            <h5 class="modal-title"><?php echo e(__('messages.edit_question_title')); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label"><?php echo e(__('messages.t_question_ar')); ?> <span class="text-danger">*</span></label>
                <?php echo $__env->make('partials.symbol_picker', ['target' => 'edit-question_text_ar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <textarea name="question_text_ar" id="edit-question_text_ar" rows="2" class="form-control symbol-target" dir="rtl" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label"><?php echo e(__('messages.t_question_en')); ?></label>
                <textarea name="question_text_en" id="edit-question_text_en" rows="2" class="form-control symbol-target"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label"><?php echo e(__('messages.question_image')); ?> <span style="color:var(--muted);font-size:.8rem">(<?php echo e(__('messages.optional')); ?>)</span></label>
                <input type="file" name="question_image" accept="image/*" class="form-control form-control-sm" onchange="previewImg(this, 'edit-qimg-preview')">
                <div id="edit-qimg-wrap" class="mt-2" style="display:none">
                    <img id="edit-qimg-preview" src="" alt="" style="max-height:120px;border-radius:8px;border:1px solid #e2e8f0">
                    <div class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="edit-remove_image">
                        <label class="form-check-label" for="edit-remove_image" style="font-size:.82rem"><?php echo e(__('messages.remove_image')); ?></label>
                    </div>
                </div>
            </div>
            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <label class="form-label"><?php echo e(__('messages.t_type')); ?></label>
                    <select name="question_type" id="edit-question_type" class="form-select form-select-sm" onchange="toggleOptions('edit-', this.value)">
                        <option value="mcq">اختيار متعدد</option>
                        <option value="true_false">صح وخطأ</option>
                        <option value="short_answer"><?php echo e(__('messages.t_short_answer')); ?></option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><?php echo e(__('messages.t_difficulty')); ?></label>
                    <select name="difficulty" id="edit-difficulty" class="form-select form-select-sm">
                        <option value="easy"><?php echo e(__('messages.t_easy')); ?></option>
                        <option value="medium"><?php echo e(__('messages.t_medium')); ?></option>
                        <option value="hard"><?php echo e(__('messages.t_hard')); ?></option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><?php echo e(__('messages.t_marks')); ?></label>
                    <input type="number" name="marks" id="edit-marks" value="1" min="1" class="form-control form-control-sm">
                </div>
            </div>

            <div id="edit-options-section">
                <label class="form-label"><?php echo e(__('messages.t_options')); ?></label>
                <div id="edit-mcq-rows" data-next-index="0"></div>
                <button type="button" class="btn-outline-sm mb-3" onclick="addOptionRow('edit-')"><i class="bi bi-plus-lg"></i> <?php echo e(__('messages.add_option')); ?></button>

                <div id="edit-tf-rows" style="display:none">
                    <div class="option-row d-flex align-items-center gap-2 mb-2">
                        <input type="radio" name="edit-correct_option" value="0">
                        <span class="form-control form-control-sm" style="background:#f0fdf4;border-color:#86efac;color:#166534;font-weight:600">✓ صح (True)</span>
                        <input type="hidden" name="options[0][text_ar]" value="صح" disabled>
                        <input type="hidden" name="options[0][text_en]" value="True" disabled>
                        <input type="hidden" name="options[0][correct]" value="1" class="correct-flag" disabled>
                    </div>
                    <div class="option-row d-flex align-items-center gap-2 mb-2">
                        <input type="radio" name="edit-correct_option" value="1">
                        <span class="form-control form-control-sm" style="background:#fef2f2;border-color:#fca5a5;color:#dc2626;font-weight:600">✗ خطأ (False)</span>
                        <input type="hidden" name="options[1][text_ar]" value="خطأ" disabled>
                        <input type="hidden" name="options[1][text_en]" value="False" disabled>
                        <input type="hidden" name="options[1][correct]" value="0" class="correct-flag" disabled>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label"><?php echo e(__('messages.t_explanation_ar')); ?></label>
                <textarea name="explanation_ar" id="edit-explanation_ar" rows="2" class="form-control symbol-target" dir="rtl"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-outline-sm" data-bs-dismiss="modal"><?php echo e(__('messages.Cancel')); ?></button>
            <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> <?php echo e(__('messages.Save')); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function previewImg(input, imgId) {
    const img = document.getElementById(imgId);
    const wrap = document.getElementById(imgId + '-wrap') || (img && img.closest('#edit-qimg-wrap'));
    if (input.files && input.files[0]) {
        img.src = URL.createObjectURL(input.files[0]);
        img.style.display = 'block';
        if (wrap) wrap.style.display = 'block';
    } else if (!wrap) {
        img.style.display = 'none';
    }
}

// Insert a math symbol at the cursor position of whichever question/option/explanation
// field was last focused (so one toolbar can serve every field in the form), falling
// back to the button's own data-target when nothing has been focused yet. This avoids
// copy-pasting symbols in from elsewhere, which was garbling the text.
var lastFocusedSymbolTarget = null;
document.addEventListener('focusin', function (e) {
    if (e.target.classList && e.target.classList.contains('symbol-target')) {
        lastFocusedSymbolTarget = e.target;
    }
});
document.addEventListener('click', function (e) {
    var btn = e.target.closest('.math-symbol-btn');
    if (!btn) return;
    var form = btn.closest('form');
    var target = (lastFocusedSymbolTarget && form && form.contains(lastFocusedSymbolTarget))
        ? lastFocusedSymbolTarget
        : document.getElementById(btn.dataset.target);
    if (!target) return;
    var start = target.selectionStart ?? target.value.length;
    var end   = target.selectionEnd ?? target.value.length;
    var symbol = btn.dataset.symbol;
    target.value = target.value.slice(0, start) + symbol + target.value.slice(end);
    var newPos = start + symbol.length;
    target.focus();
    target.setSelectionRange(newPos, newPos);
    lastFocusedSymbolTarget = target;
});

// Update the correct-flag hidden input whenever a correct_option radio changes,
// scoped to whichever prefix (add form = '', edit modal = 'edit-') it belongs to.
document.addEventListener('change', function(e) {
    if (!e.target.name || e.target.name.indexOf('correct_option') === -1) return;
    var prefix = e.target.name.replace('correct_option', '');
    var mcqRows = document.getElementById(prefix + 'mcq-rows');
    var tfRows  = document.getElementById(prefix + 'tf-rows');
    var activeSection = (mcqRows && mcqRows.style.display !== 'none') ? mcqRows : tfRows;
    if (!activeSection) return;
    activeSection.querySelectorAll('.correct-flag').forEach(function(el) { el.value = '0'; });
    e.target.closest('.option-row').querySelector('.correct-flag').value = '1';
});

function toggleOptions(prefix, type) {
    var optSection = document.getElementById(prefix + 'options-section');
    var mcqRows    = document.getElementById(prefix + 'mcq-rows');
    var tfRows     = document.getElementById(prefix + 'tf-rows');

    if (type === 'short_answer' || type === 'essay') {
        optSection.style.display = 'none';
        mcqRows.querySelectorAll('input').forEach(function(el){ el.disabled = true; });
        tfRows.querySelectorAll('input').forEach(function(el){ el.disabled = true; });
        return;
    }

    optSection.style.display = '';

    if (type === 'mcq') {
        mcqRows.style.display = '';
        tfRows.style.display  = 'none';
        mcqRows.querySelectorAll('input').forEach(function(el){ el.disabled = false; });
        tfRows.querySelectorAll('input').forEach(function(el){ el.disabled = true; });
        if (!mcqRows.querySelector('input[type="radio"]:checked')) {
            var firstRadio = mcqRows.querySelector('input[type="radio"]');
            if (firstRadio) {
                firstRadio.checked = true;
                mcqRows.querySelectorAll('.correct-flag').forEach(function(el, i){ el.value = i === 0 ? '1' : '0'; });
            }
        }
    } else if (type === 'true_false') {
        mcqRows.style.display = 'none';
        tfRows.style.display  = '';
        mcqRows.querySelectorAll('input').forEach(function(el){ el.disabled = true; });
        tfRows.querySelectorAll('input').forEach(function(el){ el.disabled = false; });
        if (!tfRows.querySelector('input[type="radio"]:checked')) {
            tfRows.querySelector('input[type="radio"]').checked = true;
            tfRows.querySelectorAll('.correct-flag').forEach(function(el, i){ el.value = i === 0 ? '1' : '0'; });
        }
    }
}

function optionRowHtml(prefix, index, textAr, textEn, correct) {
    return '' +
        '<div class="option-row d-flex align-items-center gap-2 mb-2">' +
            '<input type="radio" name="' + prefix + 'correct_option" value="' + index + '"' + (correct ? ' checked' : '') + '>' +
            '<input type="text" name="options[' + index + '][text_ar]" class="form-control form-control-sm symbol-target" placeholder="<?php echo e(__('messages.option_ar_placeholder')); ?>" dir="rtl" value="' + (textAr || '').replace(/"/g, '&quot;') + '">' +
            '<input type="text" name="options[' + index + '][text_en]" class="form-control form-control-sm symbol-target" placeholder="<?php echo e(__('messages.t_english')); ?>" value="' + (textEn || '').replace(/"/g, '&quot;') + '">' +
            '<input type="hidden" name="options[' + index + '][correct]" value="' + (correct ? '1' : '0') + '" class="correct-flag">' +
            '<button type="button" class="btn-outline-sm" style="padding:3px 8px;color:#dc2626;flex-shrink:0" onclick="removeOptionRow(this, \'' + prefix + '\')"><i class="bi bi-x-lg"></i></button>' +
        '</div>';
}

function addOptionRow(prefix) {
    var container = document.getElementById(prefix + 'mcq-rows');
    var idx = parseInt(container.dataset.nextIndex || container.querySelectorAll('.option-row').length, 10);
    container.insertAdjacentHTML('beforeend', optionRowHtml(prefix, idx, '', '', false));
    container.dataset.nextIndex = idx + 1;
}

function removeOptionRow(btn, prefix) {
    var container = document.getElementById(prefix + 'mcq-rows');
    if (container.querySelectorAll('.option-row').length <= 2) {
        alert('<?php echo e(__('messages.min_two_options')); ?>');
        return;
    }
    var row = btn.closest('.option-row');
    var wasChecked = row.querySelector('input[type="radio"]').checked;
    row.remove();
    if (wasChecked) {
        var first = container.querySelector('input[type="radio"]');
        if (first) {
            first.checked = true;
            first.closest('.option-row').querySelector('.correct-flag').value = '1';
        }
    }
}

function buildMcqRows(prefix, options) {
    var container = document.getElementById(prefix + 'mcq-rows');
    container.innerHTML = '';
    options.forEach(function(opt, i) {
        container.insertAdjacentHTML('beforeend', optionRowHtml(prefix, i, opt.text_ar, opt.text_en, !!opt.correct));
    });
    container.dataset.nextIndex = options.length;
}

function openEditQuestion(question, options) {
    var form = document.getElementById('edit-question-form');
    form.action = form.dataset.urlTemplate.replace('__ID__', question.id);

    document.getElementById('edit-question_text_ar').value = question.question_ar || '';
    document.getElementById('edit-question_text_en').value = question.question_en || '';
    document.getElementById('edit-difficulty').value = question.difficulty || 'medium';
    document.getElementById('edit-marks').value = question.marks || 1;
    document.getElementById('edit-explanation_ar').value = question.explanation_ar || '';
    document.getElementById('edit-remove_image').checked = false;

    var imgPreview = document.getElementById('edit-qimg-preview');
    var imgWrap = document.getElementById('edit-qimg-wrap');
    if (question.image) {
        imgPreview.src = '<?php echo e(asset('assets/uploads/questions')); ?>/' + question.image;
        imgWrap.style.display = 'block';
    } else {
        imgPreview.src = '';
        imgWrap.style.display = 'none';
    }

    var type = question.question_type || 'mcq';
    document.getElementById('edit-question_type').value = type;

    if (type === 'mcq') {
        buildMcqRows('edit-', options && options.length ? options : [{text_ar:'',text_en:'',correct:true},{text_ar:'',text_en:'',correct:false}]);
    } else {
        buildMcqRows('edit-', [{text_ar:'',text_en:'',correct:true},{text_ar:'',text_en:'',correct:false}]);
    }

    toggleOptions('edit-', type);

    if (type === 'true_false') {
        var correctIndex = options.findIndex(function(o){ return o.correct; });
        var radios = document.querySelectorAll('input[name="edit-correct_option"]');
        radios.forEach(function(r, i) {
            r.checked = (i === (correctIndex === -1 ? 0 : correctIndex));
        });
        document.querySelectorAll('#edit-tf-rows .correct-flag').forEach(function(el, i) {
            el.value = (i === (correctIndex === -1 ? 0 : correctIndex)) ? '1' : '0';
        });
    }

    var modal = new bootstrap.Modal(document.getElementById('editQuestionModal'));
    modal.show();
}

// Keep the "add question" form's field state in sync with whatever the
// select is actually showing on load (e.g. browser back/forward cache).
toggleOptions('', document.querySelector('#question-form select[name="question_type"]').value);
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\exams\show.blade.php ENDPATH**/ ?>