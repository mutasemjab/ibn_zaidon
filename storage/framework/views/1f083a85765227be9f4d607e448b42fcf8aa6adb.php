
<?php $__env->startSection('title', __('front.pos_page_header')); ?>

<?php $__env->startSection('content'); ?>

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
            <span class="sep">/</span>
            <span><?php echo e(__('front.pos_page_header')); ?></span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2rem);margin:0">
            <i class="bi bi-shop me-2"></i><?php echo e(__('front.pos_page_header')); ?>

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
            <div class="courses-sidebar" id="coursesSidebar">
                <h6 style="font-weight:700;color:var(--z-primary);margin-bottom:1.25rem;display:flex;align-items:center;gap:.5rem">
                    <i class="bi bi-funnel-fill"></i> <?php echo e(__('front.courses_filter_title')); ?>

                </h6>
                <form method="GET" action="<?php echo e(route('pos.index')); ?>">
                    <div class="mb-3">
                        <label class="z-label"><?php echo e(__('front.search')); ?></label>
                        <input type="text" name="q" class="z-input" value="<?php echo e(request('q')); ?>" placeholder="<?php echo e(__('front.courses_search_ph')); ?>">
                    </div>
                    <div class="mb-4">
                        <label class="z-label"><?php echo e(__('front.pos_city_label')); ?></label>
                        <select name="city" class="z-select z-input">
                            <option value=""><?php echo e(__('front.pos_all_cities')); ?></option>
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($city->id); ?>" <?php echo e(request('city') == $city->id ? 'selected' : ''); ?>><?php echo e($city->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button type="submit" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-search"></i> <?php echo e(__('front.courses_apply_filter')); ?>

                    </button>
                    <?php if(request()->hasAny(['q','city'])): ?>
                        <a href="<?php echo e(route('pos.index')); ?>" class="btn-z btn-z-outline btn-z-block mt-2">
                            <i class="bi bi-x-circle"></i> <?php echo e(__('front.courses_clear_filter')); ?>

                        </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                <span style="color:var(--z-text-muted);font-size:.9rem">
                    <strong style="color:var(--z-primary)"><?php echo e($items->total()); ?></strong> <?php echo e(__('front.pos_count_suffix')); ?>

                </span>
            </div>

            <?php if($items->isEmpty()): ?>
                <div class="text-center py-5">
                    <i class="bi bi-shop" style="font-size:4rem;color:var(--z-border)"></i>
                    <h5 style="color:var(--z-text-muted);margin-top:1rem"><?php echo e(__('front.pos_no_results')); ?></h5>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="pdf-card pdf-card-orange">
                            <div class="pdf-card-icon">
                                <i class="bi bi-shop-window"></i>
                            </div>
                            <div class="pdf-card-body">
                                <?php if($item->city): ?>
                                    <span class="pdf-tag"><?php echo e($item->city->name); ?></span>
                                <?php endif; ?>
                                <h6 class="pdf-title"><?php echo e($item->name); ?></h6>
                                <div class="pdf-meta">
                                    <span><i class="bi bi-telephone-fill"></i> <?php echo e($item->phone); ?></span>
                                </div>
                            </div>
                            <div class="pdf-card-foot">
                                <?php if($item->google_map_link): ?>
                                    <a href="<?php echo e($item->google_map_link); ?>" target="_blank" rel="noopener"
                                       class="btn-z btn-z-primary btn-z-sm btn-z-block">
                                        <i class="bi bi-geo-alt-fill"></i> <?php echo e(__('front.pos_map_btn')); ?>

                                    </a>
                                <?php else: ?>
                                    <span class="btn-z btn-z-outline btn-z-sm btn-z-block" style="cursor:default;opacity:.6">
                                        <i class="bi bi-telephone"></i> <?php echo e($item->phone); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php if($items->hasPages()): ?>
                    <?php $isRtl = app()->getLocale() === 'ar'; ?>
                    <nav class="z-pagination mt-4">
                        <?php if($items->onFirstPage()): ?>
                            <span class="z-page-link disabled"><i class="bi bi-chevron-<?php echo e($isRtl ? 'right' : 'left'); ?>"></i></span>
                        <?php else: ?>
                            <a href="<?php echo e($items->previousPageUrl()); ?>" class="z-page-link"><i class="bi bi-chevron-<?php echo e($isRtl ? 'right' : 'left'); ?>"></i></a>
                        <?php endif; ?>
                        <?php $__currentLoopData = $items->getUrlRange(max(1,$items->currentPage()-2), min($items->lastPage(),$items->currentPage()+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($url); ?>" class="z-page-link <?php echo e($page == $items->currentPage() ? 'current' : ''); ?>"><?php echo e($page); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($items->hasMorePages()): ?>
                            <a href="<?php echo e($items->nextPageUrl()); ?>" class="z-page-link"><i class="bi bi-chevron-<?php echo e($isRtl ? 'left' : 'right'); ?>"></i></a>
                        <?php else: ?>
                            <span class="z-page-link disabled"><i class="bi bi-chevron-<?php echo e($isRtl ? 'left' : 'right'); ?>"></i></span>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php echo $__env->make('front.partials.filter-toggle-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\pos.blade.php ENDPATH**/ ?>