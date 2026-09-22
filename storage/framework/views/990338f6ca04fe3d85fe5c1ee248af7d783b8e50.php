
<?php $__env->startSection('title', $course->title_en ?: $course->title_ar); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e($course->title_en ?: $course->title_ar); ?></h1>
        <p class="page-sub">
            <?php echo e($course->units->count()); ?> <?php echo e(__('messages.t_units')); ?> ·
            <?php echo e($course->units->sum(fn($u) => $u->lessons->count())); ?> <?php echo e(__('messages.t_lessons')); ?> ·
            <?php echo e($course->enrollments_count ?? 0); ?> <?php echo e(__('messages.t_students')); ?>

        </p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('teacher.courses.edit', $course->id)); ?>" class="btn-primary-sm">
            <i class="bi bi-pencil"></i> <?php echo e(__('messages.t_edit_info')); ?>

        </a>
        <a href="<?php echo e(route('teacher.courses.index')); ?>" class="btn-outline-sm">
            <i class="bi bi-arrow-left"></i> <?php echo e(__('messages.t_back')); ?>

        </a>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3"><?php echo e(session('error')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-3">
        <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php $hasErrors = $errors->any(); ?>


<ul class="nav nav-tabs mb-3" id="courseTabs">
    <li class="nav-item"><a class="nav-link <?php echo e($hasErrors ? '' : 'active'); ?>" data-bs-toggle="tab" href="#tab-content">📚 <?php echo e(__('messages.course_content')); ?></a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-overview">📋 <?php echo e(__('messages.overview')); ?></a></li>
    <li class="nav-item"><a class="nav-link <?php echo e($hasErrors ? 'active' : ''); ?>" data-bs-toggle="tab" href="#tab-add-unit">➕ <?php echo e(__('messages.add_unit')); ?></a></li>
</ul>

<div class="tab-content">

    
    <div class="tab-pane fade <?php echo e($hasErrors ? '' : 'show active'); ?>" id="tab-content">
        <?php $__empty_1 = true; $__currentLoopData = $course->units->sortBy('order_index'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="panel-card mb-3">
            <div class="panel-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-collection" style="color:var(--primary)"></i>
                    <strong><?php echo e(__('messages.unit_label')); ?> <?php echo e($loop->iteration); ?>: <?php echo e($unit->title_en ?: $unit->title_ar); ?></strong>
                    <span class="pill pill-neutral"><?php echo e($unit->lessons->count()); ?> <?php echo e(__('messages.lessons_suffix')); ?></span>
                </div>
                <form action="<?php echo e(route('teacher.courses.units.destroy', [$course->id, $unit->id])); ?>" method="POST"
                      onsubmit="return confirm('<?php echo e(__('messages.t_delete_unit_confirm')); ?>')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca">
                        <i class="bi bi-trash"></i> <?php echo e(__('messages.delete_unit')); ?>

                    </button>
                </form>
            </div>
            <div class="panel-card-body">

                
                <?php $__empty_2 = true; $__currentLoopData = $unit->lessons->sortBy('order_index'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                <div class="mb-2">
                    <div class="d-flex align-items-center gap-2 p-2" style="background:var(--bg-soft);border-radius:8px">
                        <?php if($lesson->lesson_type === 'pdf'): ?>
                            <i class="bi bi-file-earmark-pdf-fill" style="color:#dc2626;flex-shrink:0"></i>
                        <?php else: ?>
                            <i class="bi bi-play-circle-fill" style="color:var(--primary);flex-shrink:0"></i>
                        <?php endif; ?>
                        <div style="flex:1;min-width:0">
                            <div style="font-size:.85rem;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                <?php echo e($lesson->title_ar ?: $lesson->title_en); ?>

                                <?php if($lesson->title_en && $lesson->title_ar): ?>
                                    <span style="color:var(--muted);font-weight:400"> / <?php echo e($lesson->title_en); ?></span>
                                <?php endif; ?>
                            </div>
                            <div style="font-size:.75rem;color:var(--muted);display:flex;gap:6px;align-items:center;flex-wrap:wrap">
                                <?php echo e($lesson->duration_minutes ? $lesson->duration_minutes.' '.__('messages.min_suffix') : ''); ?>

                                <?php if($lesson->is_free): ?><span class="pill pill-success" style="font-size:.6rem"><?php echo e(__('messages.free')); ?></span> <?php endif; ?>
                                <?php if($lesson->lesson_type === 'pdf' && $lesson->file_path): ?>
                                    <a href="<?php echo e(asset('assets/uploads/lessons/'.$lesson->file_path)); ?>" target="_blank" style="font-size:.7rem;color:#dc2626"><i class="bi bi-download"></i> PDF</a>
                                <?php elseif($lesson->video_url): ?>
                                    <a href="<?php echo e($lesson->video_url); ?>" target="_blank" style="font-size:.7rem;color:var(--primary)"><i class="bi bi-play-btn"></i> <?php echo e(mb_strlen($lesson->video_url) > 40 ? mb_substr($lesson->video_url,0,40).'…' : $lesson->video_url); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <button class="btn-outline-sm" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#edit-lesson-<?php echo e($lesson->id); ?>"
                                style="padding:2px 6px;flex-shrink:0">
                            <i class="bi bi-pencil"></i>
                        </button>
                        
                        <form action="<?php echo e(route('teacher.lessons.destroy', [$course->id, $unit->id, $lesson->id])); ?>" method="POST"
                              onsubmit="return confirm('<?php echo e(__('messages.t_confirm_delete_lesson')); ?>')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn-outline-sm" style="padding:2px 6px;color:#dc2626;border-color:#fecaca;flex-shrink:0">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                    
                    <div class="collapse mt-1" id="edit-lesson-<?php echo e($lesson->id); ?>">
                        <form action="<?php echo e(route('teacher.lessons.update', [$course->id, $unit->id, $lesson->id])); ?>" method="POST"
                              enctype="multipart/form-data"
                              style="background:#f0f7ff;border-radius:10px;padding:14px;border:1px solid #bfdbfe">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            
                            <div class="d-flex gap-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="lesson_type"
                                           id="elt-video-<?php echo e($lesson->id); ?>" value="video"
                                           <?php echo e(($lesson->lesson_type ?? 'video') === 'video' ? 'checked' : ''); ?>

                                           onchange="toggleEditLessonType(<?php echo e($lesson->id); ?>)">
                                    <label class="form-check-label" for="elt-video-<?php echo e($lesson->id); ?>" style="font-size:.82rem">
                                        <i class="bi bi-play-circle"></i> <?php echo e(__('messages.video_type')); ?>

                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="lesson_type"
                                           id="elt-pdf-<?php echo e($lesson->id); ?>" value="pdf"
                                           <?php echo e($lesson->lesson_type === 'pdf' ? 'checked' : ''); ?>

                                           onchange="toggleEditLessonType(<?php echo e($lesson->id); ?>)">
                                    <label class="form-check-label" for="elt-pdf-<?php echo e($lesson->id); ?>" style="font-size:.82rem">
                                        <i class="bi bi-file-earmark-pdf"></i> <?php echo e(__('messages.pdf_type')); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" name="title_ar" class="form-control form-control-sm"
                                           placeholder="<?php echo e(__('messages.lesson_title_ar')); ?>" dir="rtl"
                                           value="<?php echo e($lesson->title_ar); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="title_en" class="form-control form-control-sm"
                                           placeholder="<?php echo e(__('messages.lesson_title_en')); ?>"
                                           value="<?php echo e($lesson->title_en); ?>">
                                </div>
                                
                                <div class="col-12" id="evideo-wrap-<?php echo e($lesson->id); ?>"
                                     style="<?php echo e($lesson->lesson_type === 'pdf' ? 'display:none' : ''); ?>">
                                    <input type="url" name="video_url" class="form-control form-control-sm"
                                           placeholder="<?php echo e(__('messages.video_url_ph')); ?>"
                                           value="<?php echo e($lesson->video_url); ?>">
                                </div>
                                
                                <div class="col-12" id="epdf-wrap-<?php echo e($lesson->id); ?>"
                                     style="<?php echo e($lesson->lesson_type !== 'pdf' ? 'display:none' : ''); ?>">
                                    <?php if($lesson->file_path): ?>
                                        <div class="mb-1" style="font-size:.78rem;color:var(--muted)">
                                            <?php echo e(__('messages.current_file')); ?>:
                                            <a href="<?php echo e(asset('assets/uploads/lessons/'.$lesson->file_path)); ?>" target="_blank" style="color:#dc2626">
                                                <i class="bi bi-file-earmark-pdf"></i> <?php echo e($lesson->file_path); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" name="lesson_file" class="form-control form-control-sm" accept=".pdf">
                                    <small class="text-muted" style="font-size:.72rem"><?php echo e(__('messages.leave_empty_keep_file')); ?></small>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="duration_minutes" class="form-control form-control-sm"
                                           placeholder="<?php echo e(__('messages.duration_min')); ?>" min="1"
                                           value="<?php echo e($lesson->duration_minutes); ?>">
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <div class="form-check form-check-inline mb-0">
                                        <input class="form-check-input" type="checkbox" name="is_free" value="1"
                                               id="elf-<?php echo e($lesson->id); ?>" <?php echo e($lesson->is_free ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="elf-<?php echo e($lesson->id); ?>" style="font-size:.82rem"><?php echo e(__('messages.free_preview')); ?></label>
                                    </div>
                                </div>
                                <div class="col-12 d-flex gap-2">
                                    <button type="submit" class="btn-primary-sm">
                                        <i class="bi bi-save"></i> <?php echo e(__('messages.Save')); ?>

                                    </button>
                                    <button type="button" class="btn-outline-sm"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#edit-lesson-<?php echo e($lesson->id); ?>">
                                        <?php echo e(__('messages.Cancel')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                <p style="color:var(--muted);font-size:.83rem"><?php echo e(__('messages.no_lessons_yet')); ?></p>
                <?php endif; ?>

                
                <button class="btn-outline-sm mt-2" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#add-lesson-<?php echo e($unit->id); ?>">
                    <i class="bi bi-plus"></i> <?php echo e(__('messages.add_lesson')); ?>

                </button>
                <div class="collapse mt-2" id="add-lesson-<?php echo e($unit->id); ?>">
                    <form action="<?php echo e(route('teacher.lessons.store', [$course->id, $unit->id])); ?>" method="POST"
                          enctype="multipart/form-data"
                          style="background:#f8fafc;border-radius:10px;padding:14px;border:1px solid #e2e8f0">
                        <?php echo csrf_field(); ?>
                        
                        <div class="d-flex gap-3 mb-2">
                            <div class="form-check">
                                <input class="form-check-input lesson-type-radio" type="radio" name="lesson_type"
                                       id="lt-video-<?php echo e($unit->id); ?>" value="video" checked
                                       onchange="toggleLessonType(<?php echo e($unit->id); ?>)">
                                <label class="form-check-label" for="lt-video-<?php echo e($unit->id); ?>" style="font-size:.82rem">
                                    <i class="bi bi-play-circle"></i> <?php echo e(__('messages.video_type')); ?>

                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input lesson-type-radio" type="radio" name="lesson_type"
                                       id="lt-pdf-<?php echo e($unit->id); ?>" value="pdf"
                                       onchange="toggleLessonType(<?php echo e($unit->id); ?>)">
                                <label class="form-check-label" for="lt-pdf-<?php echo e($unit->id); ?>" style="font-size:.82rem">
                                    <i class="bi bi-file-earmark-pdf"></i> <?php echo e(__('messages.pdf_type')); ?>

                                </label>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" name="title_ar" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.lesson_title_ar')); ?>" dir="rtl" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="title_en" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.lesson_title_en')); ?>">
                            </div>
                            
                            <div class="col-12" id="video-url-wrap-<?php echo e($unit->id); ?>">
                                <input type="url" name="video_url" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.video_url_ph')); ?>">
                            </div>
                            
                            <div class="col-12" id="pdf-file-wrap-<?php echo e($unit->id); ?>" style="display:none">
                                <input type="file" name="lesson_file" class="form-control form-control-sm" accept=".pdf">
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="duration_minutes" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.duration_min')); ?>" min="1">
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-check form-check-inline mb-0">
                                    <input class="form-check-input" type="checkbox" name="is_free" value="1" id="lf-<?php echo e($unit->id); ?>">
                                    <label class="form-check-label" for="lf-<?php echo e($unit->id); ?>" style="font-size:.82rem"><?php echo e(__('messages.free_preview')); ?></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-primary-sm">
                                    <i class="bi bi-save"></i> <?php echo e(__('messages.add_lesson')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="panel-card">
            <div class="panel-card-body text-center py-5">
                <div style="font-size:48px;margin-bottom:12px">📂</div>
                <p style="color:var(--muted)"><?php echo e(__('messages.no_units_yet_add')); ?></p>
                <button class="btn-primary-sm" data-bs-toggle="tab" data-bs-target="#tab-add-unit">
                    <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_first_unit')); ?>

                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="tab-pane fade" id="tab-overview">
        <div class="row g-3">
            <div class="col-12 col-xl-8">
                <?php if($course->thumbnail): ?>
                <div class="panel-card mb-3">
                    <div class="panel-card-body p-0">
                        <img src="<?php echo e(asset('assets/uploads/courses/'.$course->thumbnail)); ?>" class="img-fluid rounded" alt="" style="max-height:260px;object-fit:cover;width:100%">
                    </div>
                </div>
                <?php endif; ?>
                <div class="panel-card">
                    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.descriptions')); ?></h2></div>
                    <div class="panel-card-body">
                        <div class="mb-3">
                            <div style="font-size:.75rem;font-weight:700;text-transform:uppercase;color:var(--muted);margin-bottom:6px">AR</div>
                            <p style="line-height:1.7" dir="rtl"><?php echo e($course->description_ar ?: '—'); ?></p>
                        </div>
                        <div>
                            <div style="font-size:.75rem;font-weight:700;text-transform:uppercase;color:var(--muted);margin-bottom:6px">EN</div>
                            <p style="line-height:1.7"><?php echo e($course->description_en ?: '—'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="panel-card mb-3">
                    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.overview')); ?></h2></div>
                    <div class="panel-card-body">
                        <?php
                            $details = [
                                ['bi-tag', __('messages.t_category'), $course->category->name ?? '—'],
                                ['bi-book', __('messages.subject'), $course->subject->name ?? '—'],
                                ['bi-currency-dollar', __('messages.price'), $course->is_free ? __('messages.free') : number_format($course->price).' JD'],
                                ['bi-people', __('messages.t_students'), number_format($course->enrollments_count ?? 0)],
                                ['bi-clock', __('messages.duration_hours'), ($course->duration_hours ?? 0).' h'],
                                ['bi-bar-chart', __('messages.level'), $course->difficulty_level ?? '—'],
                            ];
                        ?>
                        <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi <?php echo e($d[0]); ?>" style="color:var(--primary);width:18px"></i>
                            <span style="color:var(--muted);font-size:.83rem;min-width:80px"><?php echo e($d[1]); ?></span>
                            <span style="font-size:.85rem;font-weight:500"><?php echo e($d[2]); ?></span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <hr>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="pill <?php echo e($course->is_published ? 'pill-success' : 'pill-neutral'); ?>">
                                <?php echo e($course->is_published ? __('messages.t_published') : __('messages.t_draft')); ?>

                            </span>
                            <?php if($course->is_free): ?><span class="pill pill-success"><?php echo e(__('messages.free')); ?></span><?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="panel-card">
                    <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.t_quick_actions')); ?></h2></div>
                    <div class="panel-card-body d-flex flex-column gap-2">
                        <a href="<?php echo e(route('teacher.courses.edit', $course->id)); ?>" class="btn-outline-sm justify-content-center">
                            <i class="bi bi-pencil"></i> <?php echo e(__('messages.t_edit_course_info')); ?>

                        </a>
                        <form action="<?php echo e(route('teacher.courses.destroy', $course->id)); ?>" method="POST"
                              onsubmit="return confirm('<?php echo e(__('messages.t_confirm_delete_course')); ?>')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn-outline-sm w-100 justify-content-center" style="color:#dc2626;border-color:#fecaca;padding:10px">
                                <i class="bi bi-trash"></i> <?php echo e(__('messages.t_delete_course')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="tab-pane fade <?php echo e($hasErrors ? 'show active' : ''); ?>" id="tab-add-unit">
        <div class="row g-3">
        <div class="col-12 col-xl-6">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><?php echo e(__('messages.add_unit')); ?></h2></div>
            <div class="panel-card-body">
                <form action="<?php echo e(route('teacher.courses.units.store', $course->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('messages.t_title_ar')); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" value="<?php echo e(old('title_ar')); ?>" class="form-control" dir="rtl" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><?php echo e(__('messages.t_title_en')); ?></label>
                            <input type="text" name="title_en" value="<?php echo e(old('title_en')); ?>" class="form-control">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-primary-sm">
                                <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_unit')); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        </div>
    </div>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
function toggleLessonType(unitId) {
    const selected = document.querySelector(`input[name="lesson_type"][id^="lt-"][id$="-${unitId}"]:checked`).value;
    document.getElementById(`video-url-wrap-${unitId}`).style.display = (selected === 'video') ? '' : 'none';
    document.getElementById(`pdf-file-wrap-${unitId}`).style.display  = (selected === 'pdf')   ? '' : 'none';
}
function toggleEditLessonType(lessonId) {
    const selected = document.querySelector(`input[name="lesson_type"][id^="elt-"][id$="-${lessonId}"]:checked`).value;
    document.getElementById(`evideo-wrap-${lessonId}`).style.display = (selected === 'video') ? '' : 'none';
    document.getElementById(`epdf-wrap-${lessonId}`).style.display   = (selected === 'pdf')   ? '' : 'none';
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\teacher\courses\show.blade.php ENDPATH**/ ?>