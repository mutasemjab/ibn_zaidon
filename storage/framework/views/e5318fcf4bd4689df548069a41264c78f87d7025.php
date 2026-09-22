
<?php $__env->startSection('title', __('messages.add_exam')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e(__('messages.add_exam')); ?></h1></div>
    <a href="<?php echo e(route('admin.exams.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> <?php echo e(__('messages.Back')); ?></a>
</div>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-3"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>

<div class="row g-3">
<div class="col-12 col-xl-8">
<form action="<?php echo e(route('admin.exams.store')); ?>" method="POST">
<?php echo csrf_field(); ?>
<div class="panel-card">
    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.exam_info')); ?></h2></div>
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.title_ar')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="title_ar" value="<?php echo e(old('title_ar')); ?>" class="form-control <?php $__errorArgs = ['title_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" dir="rtl" required>
                <?php $__errorArgs = ['title_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.title_en')); ?> <span class="text-danger">*</span></label>
                <input type="text" name="title_en" value="<?php echo e(old('title_en')); ?>" class="form-control <?php $__errorArgs = ['title_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['title_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.description_ar')); ?></label>
                <textarea name="description_ar" rows="2" class="form-control" dir="rtl"><?php echo e(old('description_ar')); ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?php echo e(__('messages.description_en')); ?></label>
                <textarea name="description_en" rows="2" class="form-control"><?php echo e(old('description_en')); ?></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.exam_type_label')); ?> <span class="text-danger">*</span></label>
                <select name="exam_type" class="form-select <?php $__errorArgs = ['exam_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <?php $__currentLoopData = ['mock','unit','final','practice','previous_years','placement']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type); ?>" <?php if(old('exam_type') === $type): echo 'selected'; endif; ?>><?php echo e(__('messages.'.$type)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['exam_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.difficulty')); ?></label>
                <select name="difficulty_level" class="form-select">
                    <?php $__currentLoopData = ['easy','medium','hard','mixed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($d); ?>" <?php if(old('difficulty_level','mixed') === $d): echo 'selected'; endif; ?>><?php echo e(__('messages.'.$d)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.course')); ?></label>
                <select name="course_id" id="courseSelect" class="form-select">
                    <option value=""><?php echo e(__('messages.standalone')); ?></option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c->id); ?>" <?php if(old('course_id') == $c->id): echo 'selected'; endif; ?>><?php echo e(Str::limit($c->title_en ?: $c->title_ar, 35)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.subject')); ?></label>
                <select name="subject_id" id="subjectSelect" class="form-select">
                    <option value="">— <?php echo e(__('messages.select_subject')); ?> —</option>
                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($sub->id); ?>" <?php if(old('subject_id') == $sub->id): echo 'selected'; endif; ?>><?php echo e($sub->full_path); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.teacher')); ?></label>
                <select name="teacher_id" id="teacherSelect" class="form-select">
                    <option value="">— <?php echo e(__('messages.t_none')); ?> —</option>
                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t->id); ?>" <?php if(old('teacher_id') == $t->id): echo 'selected'; endif; ?>><?php echo e($t->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="col-12" id="placementPanel" style="display:none;">
                <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px;">
                    <div class="fw-semibold mb-2" style="font-size:.85rem;color:var(--navy);">
                        <i class="bi bi-pin-map me-1"></i> <?php echo e(__('messages.exam_placement')); ?>

                    </div>
                    <div class="d-flex flex-wrap gap-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="placement_type" id="pt_course" value="course" <?php if(old('placement_type','course')==='course'): echo 'checked'; endif; ?> onchange="updatePlacementUI()">
                            <label class="form-check-label" for="pt_course"><?php echo e(__('messages.placement_course_level')); ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="placement_type" id="pt_unit" value="unit" <?php if(old('placement_type')==='unit'): echo 'checked'; endif; ?> onchange="updatePlacementUI()">
                            <label class="form-check-label" for="pt_unit"><?php echo e(__('messages.placement_after_unit')); ?></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="placement_type" id="pt_lesson" value="lesson" <?php if(old('placement_type')==='lesson'): echo 'checked'; endif; ?> onchange="updatePlacementUI()">
                            <label class="form-check-label" for="pt_lesson"><?php echo e(__('messages.placement_after_lesson')); ?></label>
                        </div>
                    </div>
                    <div class="row g-2" id="placementSelects">
                        <div class="col-md-6" id="unitSelectWrap" style="display:none;">
                            <label class="form-label" style="font-size:.8rem;"><?php echo e(__('messages.select_unit')); ?></label>
                            <select name="unit_id" id="unitSelect" class="form-select form-select-sm" onchange="filterLessons()">
                                <option value="">— <?php echo e(__('messages.select_unit')); ?> —</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="lessonSelectWrap" style="display:none;">
                            <label class="form-label" style="font-size:.8rem;"><?php echo e(__('messages.select_lesson')); ?></label>
                            <select name="lesson_id" id="lessonSelect" class="form-select form-select-sm">
                                <option value="">— <?php echo e(__('messages.select_lesson')); ?> —</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.duration_minutes_label')); ?> <span class="text-danger">*</span></label>
                <input type="number" name="duration_minutes" value="<?php echo e(old('duration_minutes', 60)); ?>" min="1" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.total_marks')); ?> <span class="text-danger">*</span></label>
                <input type="number" name="total_marks" value="<?php echo e(old('total_marks', 100)); ?>" min="1" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label"><?php echo e(__('messages.pass_marks')); ?> <span class="text-danger">*</span></label>
                <input type="number" name="pass_marks" value="<?php echo e(old('pass_marks', 50)); ?>" min="1" class="form-control" required>
            </div>
            <div class="col-12">
                <div class="d-flex gap-4 flex-wrap">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published">
                        <label class="form-check-label" for="is_published"><?php echo e(__('messages.published')); ?></label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="shuffle_questions" value="1" id="shuffle_q">
                        <label class="form-check-label" for="shuffle_q"><?php echo e(__('messages.shuffle_questions')); ?></label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="shuffle_options" value="1" id="shuffle_o">
                        <label class="form-check-label" for="shuffle_o"><?php echo e(__('messages.shuffle_options')); ?></label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="show_result_immediately" value="1" id="show_result" checked>
                        <label class="form-check-label" for="show_result"><?php echo e(__('messages.show_result_immediately')); ?></label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> <?php echo e(__('messages.create_exam_add_questions')); ?></button>
            </div>
        </div>
    </div>
</div>
</form>
</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function buildStructureUrl(id) {
    return '<?php echo e(route("admin.courses.exam-structure", ":cid")); ?>'.replace(':cid', id);
}
let courseStructure = null;

const oldUnitId   = '<?php echo e(old("unit_id")); ?>';
const oldLessonId = '<?php echo e(old("lesson_id")); ?>';

jQuery('#courseSelect').on('change', function () {
    loadCourseStructure(this.value);
});

// teacher_id -> [subject_id, ...] — only teachers with at least one assigned
// subject appear here, so an unlisted teacher means "no subjects assigned".
const teacherSubjectsMap = <?php echo json_encode($teacherSubjects, 15, 512) ?>;
const oldSubjectId = '<?php echo e(old("subject_id")); ?>';

function refreshSubjectOptions(preselect) {
    const teacherSelect  = document.getElementById('teacherSelect');
    const subjectSelect  = document.getElementById('subjectSelect');
    const teacherId      = teacherSelect.value;
    const currentValue   = preselect !== undefined ? preselect : subjectSelect.value;

    const allOptions = Array.from(subjectSelect.querySelectorAll('option[value]:not([value=""])'));
    if (!subjectSelect.dataset.allOptionsHtml) {
        subjectSelect.dataset.allOptionsHtml = allOptions.map(o => o.outerHTML).join('');
    }

    let allowedIds = null;
    if (teacherId) {
        allowedIds = Object.prototype.hasOwnProperty.call(teacherSubjectsMap, teacherId)
            ? teacherSubjectsMap[teacherId].map(String)
            : [];
    }

    const placeholder = subjectSelect.options[0].outerHTML;
    const temp = document.createElement('div');
    temp.innerHTML = subjectSelect.dataset.allOptionsHtml;
    const kept = Array.from(temp.children).filter(o => !allowedIds || allowedIds.includes(String(o.value)));

    subjectSelect.innerHTML = placeholder + kept.map(o => o.outerHTML).join('');
    if (currentValue && kept.some(o => String(o.value) === String(currentValue))) {
        subjectSelect.value = currentValue;
    }

    // The select is enhanced by Select2 (see admin.layouts.app), which builds its
    // own dropdown UI from the options at init time and doesn't notice plain DOM
    // mutations on its own — it has to be told to re-read the <option> list.
    if (window.jQuery && jQuery.fn.select2) {
        jQuery(subjectSelect).trigger('change');
    }
}

// Select2 (applied to every .form-select in admin.layouts.app) fires its
// selection change through jQuery's own event system, not a real DOM 'change'
// event — a native addEventListener('change', ...) here never sees it, so this
// has to be bound through jQuery too.
jQuery('#teacherSelect').on('change', function () {
    refreshSubjectOptions('');
});

// On page load, restore if old('course_id') was set
window.addEventListener('DOMContentLoaded', function () {
    const courseId = document.getElementById('courseSelect').value;
    if (courseId) {
        loadCourseStructure(courseId, oldUnitId, oldLessonId);
    }
    refreshSubjectOptions(oldSubjectId);
    updatePlacementUI();
});

function loadCourseStructure(courseId, preselectUnit, preselectLesson) {
    const panel = document.getElementById('placementPanel');
    if (!courseId) {
        panel.style.display = 'none';
        courseStructure = null;
        return;
    }
    fetch(buildStructureUrl(courseId))
        .then(r => r.json())
        .then(data => {
            courseStructure = data;
            buildUnitSelect(data.units, preselectUnit);
            panel.style.display = '';
            updatePlacementUI();
            if (preselectUnit) filterLessons(preselectLesson);
        });
}

function buildUnitSelect(units, preselectUnit) {
    const sel = document.getElementById('unitSelect');
    sel.innerHTML = '<option value="">— <?php echo e(__("messages.select_unit")); ?> —</option>';
    units.forEach(u => {
        const opt = document.createElement('option');
        opt.value = u.id;
        opt.textContent = (u.title_en || u.title_ar);
        opt.dataset.lessons = JSON.stringify(u.lessons);
        if (preselectUnit && String(u.id) === String(preselectUnit)) opt.selected = true;
        sel.appendChild(opt);
    });
}

function filterLessons(preselectLesson) {
    const unitSel   = document.getElementById('unitSelect');
    const lessonSel = document.getElementById('lessonSelect');
    const selected  = unitSel.options[unitSel.selectedIndex];
    lessonSel.innerHTML = '<option value="">— <?php echo e(__("messages.select_lesson")); ?> —</option>';
    if (!selected || !selected.dataset.lessons) return;
    const lessons = JSON.parse(selected.dataset.lessons);
    lessons.forEach(l => {
        const opt = document.createElement('option');
        opt.value = l.id;
        opt.textContent = (l.title_en || l.title_ar);
        if (preselectLesson && String(l.id) === String(preselectLesson)) opt.selected = true;
        lessonSel.appendChild(opt);
    });
}

function updatePlacementUI() {
    const type = document.querySelector('input[name="placement_type"]:checked')?.value || 'course';
    document.getElementById('unitSelectWrap').style.display   = (type === 'unit' || type === 'lesson') ? '' : 'none';
    document.getElementById('lessonSelectWrap').style.display = (type === 'lesson') ? '' : 'none';
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\exams\create.blade.php ENDPATH**/ ?>