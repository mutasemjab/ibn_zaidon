
<?php $__env->startSection('title', __('front.courses_page_header')); ?>

<?php $__env->startSection('content'); ?>
<?php
    $isRtl    = app()->getLocale() === 'ar';
    $prevIcon = $isRtl ? 'chevron-right' : 'chevron-left';
    $nextIcon = $isRtl ? 'chevron-left'  : 'chevron-right';
    $hasSubject = isset($currentSubject) && $currentSubject;
?>


<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <?php if($hasSubject && $currentSubject->category): ?>
                <span class="sep">/</span>
                <a href="<?php echo e(route('categories.show', $currentSubject->category_id)); ?>"><?php echo e($currentSubject->category->name); ?></a>
            <?php endif; ?>
            <span class="sep">/</span>
            <span><?php echo e($hasSubject ? $currentSubject->name : __('front.courses_page_breadcrumb')); ?></span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2rem);margin:0">
            <?php echo e($hasSubject ? __('front.courses_of_subject', ['name' => $currentSubject->name]) : __('front.courses_page_header')); ?>

        </h1>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">

        
        <div class="col-lg-3">
            <button class="mobile-filter-toggle" id="filterToggle">
                <i class="bi bi-funnel-fill"></i> <?php echo e(__('front.courses_filter_title')); ?>

                <i class="bi bi-chevron-down ms-auto" id="filterChevron"></i>
            </button>
            <div class="courses-sidebar" id="coursesSidebar" style="background:#fff;border-radius:var(--z-radius-lg);padding:1.5rem;border:1.5px solid var(--z-border);position:sticky;top:calc(var(--navbar-h) + 1rem)">
                <h6 style="font-weight:700;color:var(--z-primary);margin-bottom:1.25rem;display:flex;align-items:center;gap:.5rem">
                    <i class="bi bi-funnel-fill"></i> <?php echo e(__('front.courses_filter_title')); ?>

                </h6>

                <form method="GET" action="<?php echo e(route('courses.index')); ?>">
                    
                    <div class="mb-3">
                        <label class="z-label"><?php echo e(__('front.search')); ?></label>
                        <div style="position:relative">
                            <input type="text" name="q" class="z-input" style="padding-inline-end:2.5rem"
                                   value="<?php echo e(request('q')); ?>" placeholder="<?php echo e(__('front.courses_search_ph')); ?>">
                            <i class="bi bi-search" style="position:absolute;top:50%;inset-inline-end:.85rem;transform:translateY(-50%);color:var(--z-text-muted)"></i>
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <label class="z-label"><?php echo e(__('front.courses_category_label')); ?></label>
                        <select name="category" class="z-select z-input">
                            <option value=""><?php echo e(__('front.courses_filter_all_cat')); ?></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
                                <?php echo e($cat->name); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div class="mb-4">
                        <label class="z-label"><?php echo e(__('front.courses_sort_label')); ?></label>
                        <select name="sort" class="z-select z-input">
                            <option value="popular"   <?php echo e(request('sort','popular') === 'popular'   ? 'selected' : ''); ?>><?php echo e(__('front.courses_sort_popular')); ?></option>
                            <option value="newest"    <?php echo e(request('sort') === 'newest'    ? 'selected' : ''); ?>><?php echo e(__('front.courses_sort_newest')); ?></option>
                            <option value="top-rated" <?php echo e(request('sort') === 'top-rated' ? 'selected' : ''); ?>><?php echo e(__('front.courses_sort_rated')); ?></option>
                            <option value="cheap"     <?php echo e(request('sort') === 'cheap'     ? 'selected' : ''); ?>><?php echo e(__('front.courses_sort_cheap')); ?></option>
                        </select>
                    </div>

                    <button type="submit" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-search"></i> <?php echo e(__('front.courses_apply_filter')); ?>

                    </button>
                    <?php if(request()->hasAny(['q','category','sort'])): ?>
                    <a href="<?php echo e(route('courses.index')); ?>" class="btn-z btn-z-outline btn-z-block mt-2">
                        <i class="bi bi-x-circle"></i> <?php echo e(__('front.courses_clear_filter')); ?>

                    </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        
        <div class="col-lg-9">

            
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                <span style="color:var(--z-text-muted);font-size:.9rem">
                    <strong style="color:var(--z-primary)"><?php echo e($courses->total()); ?></strong> <?php echo e(__('front.courses_available_suffix')); ?>

                </span>
                <?php if(request()->hasAny(['q','category'])): ?>
                <div class="d-flex gap-2 flex-wrap">
                    <?php if(request('q')): ?>
                        <span style="background:rgba(30,107,214,.1);color:var(--z-accent);padding:.2rem .7rem;border-radius:50px;font-size:.8rem;font-weight:600">
                            <?php echo e(__('front.courses_search_tag')); ?> <?php echo e(request('q')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if($loop->first): ?>
            <div class="row g-4">
            <?php endif; ?>
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-thumb-ph"><i class="bi bi-play-circle"></i></div>
                        <div class="course-body">
                            <div class="course-tags">
                                <?php if($course->average_rating >= 4.5): ?>
                                    <span class="tag tag-popular"><?php echo e(__('front.courses_top_rated')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="course-title"><?php echo e($course->title); ?></div>
                            <div class="course-teacher">
                                <div class="av-xs"><i class="bi bi-person-fill"></i></div>
                                <span><?php echo e($course->teacher->name ?? __('front.teacher_fallback')); ?></span>
                            </div>
                            <?php if($course->category): ?>
                            <div style="font-size:.78rem;color:var(--z-text-muted);margin-top:.3rem">
                                <i class="bi bi-tag-fill me-1" style="color:var(--z-highlight)"></i>
                                <?php echo e($course->category->name); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="course-foot">
                            <span class="price-tag <?php echo e(($course->price??0)==0?'price-free':''); ?>">
                                <?php echo e(($course->price??0)>0 ? number_format($course->price,2).' '.__('front.currency') : __('front.courses_free')); ?>

                            </span>
                            <span class="enroll-ct">
                                <i class="bi bi-people-fill"></i>
                                <?php echo e(number_format($course->total_students??0)); ?>

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
            <?php if($loop->last): ?>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5">
                <i class="bi bi-search" style="font-size:4rem;color:var(--z-border)"></i>
                <h5 style="color:var(--z-text-muted);margin-top:1rem"><?php echo e(__('front.courses_no_results')); ?></h5>
                <p style="color:var(--z-text-muted);font-size:.9rem"><?php echo e(__('front.courses_change_terms')); ?></p>
                <a href="<?php echo e(route('courses.index')); ?>" class="btn-z btn-z-outline mt-2"><?php echo e(__('front.courses_view_all')); ?></a>
            </div>
            <?php endif; ?>

            
            <?php if($courses->hasPages()): ?>
            <nav class="z-pagination mt-4">
                <?php if($courses->onFirstPage()): ?>
                    <span class="z-page-link disabled"><i class="bi bi-<?php echo e($prevIcon); ?>"></i></span>
                <?php else: ?>
                    <a href="<?php echo e($courses->previousPageUrl()); ?>" class="z-page-link"><i class="bi bi-<?php echo e($prevIcon); ?>"></i></a>
                <?php endif; ?>

                <?php $__currentLoopData = $courses->getUrlRange(max(1, $courses->currentPage()-2), min($courses->lastPage(), $courses->currentPage()+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($url); ?>" class="z-page-link <?php echo e($page == $courses->currentPage() ? 'current' : ''); ?>"><?php echo e($page); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($courses->hasMorePages()): ?>
                    <a href="<?php echo e($courses->nextPageUrl()); ?>" class="z-page-link"><i class="bi bi-<?php echo e($nextIcon); ?>"></i></a>
                <?php else: ?>
                    <span class="z-page-link disabled"><i class="bi bi-<?php echo e($nextIcon); ?>"></i></span>
                <?php endif; ?>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    var btn  = document.getElementById('filterToggle');
    var side = document.getElementById('coursesSidebar');
    var chev = document.getElementById('filterChevron');
    if (!btn || !side) return;
    btn.addEventListener('click', function () {
        var open = side.classList.toggle('open');
        chev.className = open ? 'bi bi-chevron-up ms-auto' : 'bi bi-chevron-down ms-auto';
    });
})();
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\courses.blade.php ENDPATH**/ ?>