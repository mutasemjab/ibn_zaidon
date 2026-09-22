<?php
    $siteName = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name');
    $isRtl    = app()->getLocale() === 'ar';
?>
<?php $__env->startSection('seo_title', $category->name . ' | ' . $siteName); ?>
<?php $__env->startSection('meta_desc', __('front.cat_meta_desc', ['name' => $category->name, 'site' => $siteName])); ?>

<?php $__env->startPush('json_ld'); ?>
    <?php
        $crumbs = [['name' => __('front.home'), 'item' => url('/')]];
        if ($category->parent) {
            $crumbs[] = ['name' => $category->parent->name, 'item' => route('categories.show', $category->parent_id)];
        }
        $crumbs[] = ['name' => $category->name, 'item' => url()->current()];
        $breadcrumbLd = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => collect($crumbs)->values()->map(fn ($c, $i) => [
                '@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['name'], 'item' => $c['item'],
            ])->all(),
        ];
    ?>
    <script type="application/ld+json"><?php echo json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    
    <div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
        <div class="container">
            <div class="z-breadcrumb mb-2">
                <a href="<?php echo e(route('home')); ?>"><?php echo e(__('front.home')); ?></a>
                <?php if($category->parent): ?>
                    <span class="sep">/</span>
                    <?php if($category->parent->parent_id): ?>
                        <a
                            href="<?php echo e(route('categories.show', $category->parent->parent_id)); ?>"><?php echo e($category->parent->parent->name ?? ''); ?></a>
                        <span class="sep">/</span>
                    <?php endif; ?>
                    <a href="<?php echo e(route('categories.show', $category->parent_id)); ?>"><?php echo e($category->parent->name); ?></a>
                <?php endif; ?>
                <span class="sep">/</span>
                <span><?php echo e($category->name); ?></span>
            </div>
            <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0">
                <?php if($category->icon): ?>
                    <i class="bi <?php echo e($category->icon); ?> me-2"></i>
                <?php endif; ?>
                <?php echo e($category->name); ?>

            </h1>
        </div>
    </div>

    <div class="container py-5">

        <?php
            $hasChildren = $category->children->isNotEmpty();
            $hasSubjects = $category->subjects->isNotEmpty();

            // Semester-type children are detected on the stored Arabic name ("الفصل"), regardless of UI language
            $isSemesterBased = $hasChildren && $category->children->every(fn($c) => str_contains($c->name_ar, 'الفصل'));

            // Collect subjects grouped by semester (for grade pages)
            $semesterGroups = collect();
            if ($isSemesterBased) {
                foreach ($category->children as $sem) {
                    $semesterGroups->push([
                        'id' => $sem->id,
                        'name' => $sem->name,
                        'subjects' => $sem->subjects,
                    ]);
                }
            }
            $allSemesterSubjects = $semesterGroups->flatMap(
                fn($g) => $g['subjects']->map(
                    fn($s) => array_merge($s->toArray(), [
                        'name' => $s->name,
                        '_sem_id' => $g['id'],
                        '_sem_name' => $g['name'],
                    ]),
                ),
            );
        ?>

        
        <?php if($isSemesterBased): ?>

            <?php if($allSemesterSubjects->isEmpty()): ?>
                <div class="text-center py-5">
                    <i class="bi bi-journal-x" style="font-size:4rem;color:var(--z-border)"></i>
                    <h5 style="color:var(--z-text-muted);margin-top:1rem"><?php echo e(__('front.cat_page_no_subjects')); ?></h5>
                </div>
            <?php else: ?>
                
                <div class="mb-4 d-flex gap-2 flex-wrap" id="semTabs">
                    <button class="btn-z btn-z-primary btn-z-sm sem-btn active" data-sem="all"><?php echo e(__('front.cat_sem_all')); ?></button>
                    <?php $__currentLoopData = $semesterGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button class="btn-z btn-z-outline btn-z-sm sem-btn" data-sem="<?php echo e($sem['id']); ?>">
                            <i class="bi bi-<?php echo e($loop->index === 0 ? '1' : '2'); ?>-circle"></i>
                            <?php echo e($sem['name']); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="row g-4" id="subjectsGrid">
                    <?php $__currentLoopData = $allSemesterSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-4 col-6 subj-item" data-sem="<?php echo e($subject['_sem_id']); ?>">
                            <a href="<?php echo e(route('courses.index', ['subject' => $subject['id']])); ?>" class="cat-card">
                                <div class="cat-icon">
                                    <?php if(!empty($subject['icon'])): ?>
                                    <i class="bi <?php echo e($subject['icon']); ?>"></i><?php else: ?>📚
                                    <?php endif; ?>
                                </div>
                                <h5><?php echo e($subject['name']); ?></h5>
                                <span class="cat-count"><?php echo e($subject['courses_count'] ?? 0); ?> <?php echo e(__('front.cat_courses_count')); ?></span>
                                <small
                                    style="color:var(--z-text-muted);font-size:.75rem;margin-top:.25rem;display:block"><?php echo e($subject['_sem_name']); ?></small>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <script>
                    document.querySelectorAll('.sem-btn').forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            document.querySelectorAll('.sem-btn').forEach(function(b) {
                                b.classList.remove('active');
                                b.classList.add('btn-z-outline');
                                b.classList.remove('btn-z-primary');
                            });
                            this.classList.add('active', 'btn-z-primary');
                            this.classList.remove('btn-z-outline');
                            var sem = this.dataset.sem;
                            document.querySelectorAll('.subj-item').forEach(function(item) {
                                item.style.display = (sem === 'all' || item.dataset.sem === sem) ? '' : 'none';
                            });
                        });
                    });
                </script>
            <?php endif; ?>

            
        <?php elseif($hasChildren): ?>
            <div class="row g-4">
                <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-6 anim-fade-up anim-d<?php echo e(min($loop->index + 1, 4)); ?>">
                        <a href="<?php echo e(route('categories.show', $child->id)); ?>" class="cat-card">
                            <div class="cat-icon">
                                <?php if($child->icon): ?>
                                <i class="bi <?php echo e($child->icon); ?>" style="font-size:2rem"></i><?php else: ?>📚
                                <?php endif; ?>
                            </div>
                            <h5><?php echo e($child->name); ?></h5>
                            <?php
                                $subCount = $child->subjects->count();
                                $childCount = $child->children->count();
                                // Count subjects inside children (for semester categories)
                                $nestedSubCount = $child->children->sum(fn($c) => $c->subjects->count());
                            ?>
                            <?php if($subCount > 0): ?>
                                <span class="cat-count"><?php echo e($subCount); ?> <?php echo e(__('front.cat_subjects_count')); ?></span>
                            <?php elseif($nestedSubCount > 0): ?>
                                <span class="cat-count"><?php echo e($nestedSubCount); ?> <?php echo e(__('front.cat_subjects_count')); ?></span>
                            <?php elseif($childCount > 0): ?>
                                <span class="cat-count"><?php echo e($childCount); ?> <?php echo e(__('front.cat_category_count')); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
        <?php elseif($hasSubjects): ?>
            <div class="row g-4">
                <?php $__currentLoopData = $category->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-4 col-6 anim-fade-up anim-d<?php echo e(min($loop->index + 1, 4)); ?>">
                        <a href="<?php echo e(route('courses.index', ['subject' => $subject->id])); ?>" class="cat-card">
                            <div class="cat-icon">
                                <?php if($subject->icon): ?>
                                <i class="bi <?php echo e($subject->icon); ?>"></i><?php else: ?>📚
                                <?php endif; ?>
                            </div>
                            <h5><?php echo e($subject->name); ?></h5>
                            <span class="cat-count"><?php echo e($subject->courses_count ?? 0); ?> <?php echo e(__('front.cat_courses_count')); ?></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-folder2-open" style="font-size:4rem;color:var(--z-border)"></i>
                <h5 style="color:var(--z-text-muted);margin-top:1rem"><?php echo e(__('front.cat_page_empty')); ?></h5>
                <a href="<?php echo e(route('home')); ?>" class="btn-z btn-z-outline mt-3"><?php echo e(__('front.cat_back_home')); ?></a>
            </div>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\category.blade.php ENDPATH**/ ?>