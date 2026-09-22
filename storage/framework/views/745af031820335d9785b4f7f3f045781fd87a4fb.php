
<?php
    $siteName    = \App\Models\SiteSetting::val('site_name')    ?: __('front.site_name');
    $siteTagline = \App\Models\SiteSetting::val('site_tagline') ?: __('front.site_tagline');
    $aboutDesc   = \App\Models\SiteSetting::val('about_description');
?>
<?php $__env->startSection('seo_title', $siteName . ' | ' . $siteTagline); ?>

<?php $__env->startPush('json_ld'); ?>
<?php
    $homeLd = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'       => 'WebPage',
                '@id'         => url('/') . '/#webpage',
                'url'         => url('/'),
                'name'        => $siteName . ' | ' . $siteTagline,
                'isPartOf'    => ['@id' => url('/') . '/#website'],
                'about'       => ['@id' => url('/') . '/#organization'],
                'description' => $aboutDesc,
                'inLanguage'  => app()->getLocale(),
            ],
            [
                '@type'      => 'FAQPage',
                'mainEntity' => collect([
                    [__('front.home_faq_1_q', ['site' => $siteName]), $aboutDesc],
                    [__('front.home_faq_2_q', ['site' => $siteName]), __('front.home_faq_2_a', ['site' => $siteName])],
                    [__('front.home_faq_3_q', ['site' => $siteName]), __('front.home_faq_3_a')],
                ])->filter(fn ($qa) => filled($qa[1]))->map(fn ($qa) => [
                    '@type'          => 'Question',
                    'name'           => $qa[0],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $qa[1]],
                ])->values()->all(),
            ],
        ],
    ];
?>
<script type="application/ld+json"><?php echo json_encode($homeLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG); ?></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php use App\Models\SiteSetting; ?>


<section class="z-hero" id="hero">
    <div class="hero-blob"></div><div class="hero-blob"></div><div class="hero-blob"></div>
    <div class="hero-wave"></div>
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 hero-content">
                <div class="hero-eyebrow"><i class="bi bi-stars"></i> <?php echo e(SiteSetting::val('hero_badge')); ?></div>
                <h1 class="hero-title">
                    <?php echo e(SiteSetting::val('hero_title_line1')); ?><br>
                    <?php echo e(Str::before(SiteSetting::val('hero_title_line2'), SiteSetting::val('hero_title_accent'))); ?><span><?php echo e(SiteSetting::val('hero_title_accent')); ?></span><?php echo e(Str::after(SiteSetting::val('hero_title_line2'), SiteSetting::val('hero_title_accent'))); ?>

                </h1>
                <p class="hero-subtitle"><?php echo e(SiteSetting::val('hero_subtitle')); ?></p>
                <div class="hero-actions">
                    <a href="<?php echo e(route('courses.index')); ?>" class="btn-z btn-z-accent btn-z-lg">
                        <i class="bi bi-play-circle-fill"></i> <?php echo e(SiteSetting::val('hero_cta_primary') ?: __('front.hero_btn_start')); ?>

                    </a>
                    <a href="<?php echo e(route('exams.index')); ?>" class="btn-z btn-z-ghost btn-z-lg">
                        <i class="bi bi-clipboard-check"></i> <?php echo e(SiteSetting::val('hero_cta_secondary') ?: __('front.hero_btn_exams')); ?>

                    </a>
                </div>
                <div class="hero-stats-row">
                    <div class="hero-stat">
                        <strong>+<?php echo e(number_format($stats['students'])); ?></strong>
                        <span><?php echo e(__('front.stat_enrolled')); ?></span>
                    </div>
                    <div class="hero-stat">
                        <strong>+<?php echo e($stats['courses']); ?></strong>
                        <span><?php echo e(__('front.stat_available_courses')); ?></span>
                    </div>
                    <div class="hero-stat">
                        <strong>+<?php echo e($stats['teachers']); ?></strong>
                        <span><?php echo e(__('front.stat_top_teacher')); ?></span>
                    </div>
                    <div class="hero-stat">
                        <strong><?php echo e($stats['satisfaction']); ?>%</strong>
                        <span><?php echo e(__('front.stat_satisfaction_pct')); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-visual">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span style="color:rgba(255,255,255,.7);font-size:.83rem"><?php echo e(__('front.hero_featured_courses')); ?></span>
                        <span style="background:rgba(245,166,35,.2);color:var(--z-highlight);padding:.15rem .6rem;border-radius:50px;font-size:.75rem;font-weight:700"><?php echo e(__('front.hero_new_badge')); ?></span>
                    </div>
                    <?php $__empty_1 = true; $__currentLoopData = $courses->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="mini-course">
                        <div class="mini-ico <?php echo e($loop->first ? 'gold' : ($loop->index === 1 ? 'blue' : 'green')); ?>">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="mini-text flex-grow-1">
                            <h6><?php echo e(Str::limit($course->title, 32)); ?></h6>
                            <span><?php echo e($course->teacher->name ?? __('front.hero_teacher_fallback')); ?></span>
                        </div>
                        <span style="color:var(--z-highlight);font-weight:800;font-size:.88rem;white-space:nowrap">
                            <?php echo e($course->price > 0 ? number_format($course->price, 0).' '.__('front.courses_jod') : __('front.hero_price_free')); ?>

                        </span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="mini-course">
                        <div class="mini-ico gold"><i class="bi bi-mortarboard"></i></div>
                        <div class="mini-text"><h6><?php echo e(__('front.courses_no_courses')); ?></h6><span><?php echo e(__('front.hero_teacher_fallback')); ?></span></div>
                    </div>
                    <?php endif; ?>
                    <div class="text-center mt-3">
                        <a href="<?php echo e(route('courses.index')); ?>" class="btn-z btn-z-accent btn-z-sm btn-z-block">
                            <i class="bi bi-grid-3x3-gap"></i> <?php echo e(__('front.hero_view_all_btn')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="section-pad" id="about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 anim-fade-up">
                <div class="about-visual-inner" style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:var(--z-radius-xl);height:380px;display:flex;align-items:center;justify-content:center">
                    <div class="text-center text-white">
                        <i class="bi bi-mortarboard-fill" style="font-size:6rem;opacity:.35"></i>
                        <div style="font-size:1.5rem;font-weight:800;margin-top:1rem;opacity:.8"><?php echo e(SiteSetting::val('site_name')); ?></div>
                    </div>
                </div>
                <div class="about-badge">
                    <strong>+<?php echo e(number_format($stats['students'])); ?></strong>
                    <span><?php echo e(__('front.about_badge_students')); ?></span>
                </div>
            </div>
            <div class="col-lg-7 anim-fade-up anim-d2">
                <span class="section-label"><?php echo e(__('front.about_tag')); ?></span>
                <h2 class="section-heading"><?php echo e(SiteSetting::val('about_title')); ?></h2>
                <p class="section-desc mb-4"><?php echo e(SiteSetting::val('about_description')); ?></p>
                <div class="feat-item">
                    <div class="feat-icon"><i class="bi <?php echo e(SiteSetting::raw('about_feat1_icon') ?: 'bi-lightbulb-fill'); ?>"></i></div>
                    <div class="feat-body">
                        <h6><?php echo e(SiteSetting::val('about_feat1_title')); ?></h6>
                        <p><?php echo e(SiteSetting::val('about_feat1_desc')); ?></p>
                    </div>
                </div>
                <div class="feat-item">
                    <div class="feat-icon"><i class="bi <?php echo e(SiteSetting::raw('about_feat2_icon') ?: 'bi-shield-check-fill'); ?>"></i></div>
                    <div class="feat-body">
                        <h6><?php echo e(SiteSetting::val('about_feat2_title')); ?></h6>
                        <p><?php echo e(SiteSetting::val('about_feat2_desc')); ?></p>
                    </div>
                </div>
                <div class="feat-item">
                    <div class="feat-icon"><i class="bi <?php echo e(SiteSetting::raw('about_feat3_icon') ?: 'bi-phone-fill'); ?>"></i></div>
                    <div class="feat-body">
                        <h6><?php echo e(SiteSetting::val('about_feat3_title')); ?></h6>
                        <p><?php echo e(SiteSetting::val('about_feat3_desc')); ?></p>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <a href="<?php echo e(route('courses.index')); ?>" class="btn-z btn-z-primary btn-z-lg">
                        <i class="bi bi-arrow-left-circle-fill"></i> <?php echo e(__('front.about_browse_btn')); ?>

                    </a>
                    <a href="#contact" class="btn-z btn-z-outline btn-z-lg">
                        <i class="bi bi-chat-dots"></i> <?php echo e(__('front.about_contact_btn')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-pad section-alt" id="categories">
    <div class="container">
        <div class="text-center mb-5 anim-fade-up">
            <span class="section-label"><?php echo e(__('front.cat_section_label')); ?></span>
            <h2 class="section-heading"><?php echo e(__('front.cat_heading')); ?></h2>
            <p class="section-desc mx-auto"><?php echo e(__('front.cat_desc')); ?></p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6 col-6 anim-fade-up anim-d<?php echo e(min($loop->index + 1, 4)); ?>">
                <a href="<?php echo e(route('categories.show', $category->id)); ?>" class="cat-card" style="padding:2.5rem 1.5rem">
                    <div class="cat-icon" style="font-size:2.5rem;margin-bottom:1rem">
                        <?php if($category->icon): ?><i class="bi <?php echo e($category->icon); ?>"></i><?php else: ?>📚<?php endif; ?>
                    </div>
                    <h5 style="font-size:1.2rem"><?php echo e($category->name); ?></h5>
                    <span class="cat-count"><?php echo e($category->courses_count ?? 0); ?> <?php echo e(__('front.cat_courses_count')); ?></span>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-folder2-open fs-1 d-block mb-2 opacity-35"></i>
                <?php echo e(__('front.courses_no_courses')); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<section class="section-pad" id="courses">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3">
            <div>
                <span class="section-label"><?php echo e(__('front.feat_section_label')); ?></span>
                <h2 class="section-heading mb-0"><?php echo e(__('front.feat_heading')); ?></h2>
            </div>
            <a href="<?php echo e(route('courses.index')); ?>" class="btn-z btn-z-outline btn-z-sm">
                <?php echo e(__('front.feat_view_all')); ?> <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6 anim-fade-up anim-d<?php echo e(($loop->index % 3) + 1); ?>">
                <div class="course-card">
                    <div class="course-thumb-ph"><i class="bi bi-play-circle"></i></div>
                    <div class="course-body">
                        <div class="course-tags">
                            <?php if(str_contains($course->filter_tags ?? '', 'popular')): ?>
                                <span class="tag tag-popular"><?php echo e(__('front.tag_popular')); ?></span>
                            <?php endif; ?>
                            <?php if(str_contains($course->filter_tags ?? '', 'trending')): ?>
                                <span class="tag tag-trending"><?php echo e(__('front.tag_trending')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="course-title"><?php echo e($course->title); ?></div>
                        <div class="course-teacher">
                            <div class="av-xs"><i class="bi bi-person-fill"></i></div>
                            <span><?php echo e($course->teacher->name ?? __('front.hero_teacher_fallback')); ?></span>
                        </div>
                    </div>
                    <div class="course-foot">
                        <span class="price-tag <?php echo e(($course->price ?? 0) == 0 ? 'price-free' : ''); ?>">
                            <?php echo e(($course->price ?? 0) > 0 ? number_format($course->price, 2).' '.__('front.courses_jod') : __('front.courses_free')); ?>

                        </span>
                        <span class="enroll-ct">
                            <i class="bi bi-people-fill"></i> <?php echo e(number_format($course->enrollments_count ?? 0)); ?>

                        </span>
                    </div>
                    <div class="px-3 pb-3">
                        <a href="<?php echo e(route('courses.show', $course->id)); ?>" class="btn-z btn-z-primary btn-z-sm btn-z-block">
                            <i class="bi bi-eye"></i> <?php echo e(__('front.course_view_btn')); ?>

                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-journal-x fs-1 d-block mb-2 opacity-35"></i>
                <?php echo e(__('front.courses_no_courses')); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<section class="section-pad section-alt" id="services">
    <div class="container">
        <div class="text-center mb-5 anim-fade-up">
            <span class="section-label"><?php echo e(__('front.svc_section_label')); ?></span>
            <h2 class="section-heading"><?php echo e(__('front.svc_heading')); ?></h2>
            <p class="section-desc mx-auto"><?php echo e(__('front.svc_desc')); ?></p>
        </div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="svc-tabs-nav mb-4">
                    <button class="svc-tab-btn active" data-target="svc-ws"><i class="bi bi-file-earmark-text"></i> <?php echo e(__('front.svc_tab_worksheets')); ?></button>
                    <button class="svc-tab-btn" data-target="svc-py"><i class="bi bi-calendar-check"></i> <?php echo e(__('front.svc_tab_prev_years')); ?></button>
                    <button class="svc-tab-btn" data-target="svc-qb"><i class="bi bi-database-check"></i> <?php echo e(__('front.svc_tab_qbank')); ?></button>
                    <button class="svc-tab-btn" data-target="svc-ps"><i class="bi bi-shop"></i> <?php echo e(__('front.svc_tab_sales')); ?></button>
                </div>
                <div class="svc-panel active" id="svc-ws">
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-file-earmark-ruled"></i></div><div><h6><?php echo e(__('front.svc_ws_title1')); ?></h6><p><?php echo e(__('front.svc_ws_desc1')); ?></p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-pencil-square"></i></div><div><h6><?php echo e(__('front.svc_ws_title2')); ?></h6><p><?php echo e(__('front.svc_ws_desc2')); ?></p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-printer"></i></div><div><h6><?php echo e(__('front.svc_ws_title3')); ?></h6><p><?php echo e(__('front.svc_ws_desc3')); ?></p></div></div>
                    <div class="text-center mt-3"><a href="<?php echo e(route('worksheets.index')); ?>" class="btn-z btn-z-primary"><i class="bi bi-download"></i> <?php echo e(__('front.svc_ws_btn')); ?></a></div>
                </div>
                <div class="svc-panel" id="svc-py">
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-calendar3"></i></div><div><h6><?php echo e(__('front.svc_py_title1')); ?></h6><p><?php echo e(__('front.svc_py_desc1')); ?></p></div></div>
                    <?php $__empty_1 = true; $__currentLoopData = array_slice($overlayData['generations'] ?? [], -2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-file-earmark-check"></i></div><div><h6><?php echo e($gen['label']); ?></h6><p><?php echo e(__('front.svc_py_exam_desc')); ?></p></div></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-file-earmark-check"></i></div><div><h6><?php echo e(__('front.exams_leaderboard_title')); ?></h6><p><?php echo e(__('front.svc_py_exam_desc')); ?></p></div></div>
                    <?php endif; ?>
                    <div class="text-center mt-3"><a href="<?php echo e(route('previous-years.index')); ?>" class="btn-z btn-z-primary"><i class="bi bi-arrow-left-circle"></i> <?php echo e(__('front.svc_py_btn')); ?></a></div>
                </div>
                <div class="svc-panel" id="svc-qb">
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-database"></i></div><div><h6><?php echo e(__('front.svc_qb_title1')); ?></h6><p><?php echo e(__('front.svc_qb_desc1')); ?></p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-shuffle"></i></div><div><h6><?php echo e(__('front.svc_qb_title2')); ?></h6><p><?php echo e(__('front.svc_qb_desc2')); ?></p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-graph-up-arrow"></i></div><div><h6><?php echo e(__('front.svc_qb_title3')); ?></h6><p><?php echo e(__('front.svc_qb_desc3')); ?></p></div></div>
                    <div class="text-center mt-3"><a href="<?php echo e(route('question-banks.index')); ?>" class="btn-z btn-z-primary"><i class="bi bi-collection"></i> <?php echo e(__('front.svc_qb_btn')); ?></a></div>
                </div>
                <div class="svc-panel" id="svc-ps">
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-shop-window"></i></div><div><h6><?php echo e(__('front.svc_sp_title1')); ?></h6><p><?php echo e(__('front.svc_sp_desc1')); ?></p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-credit-card-2-front"></i></div><div><h6><?php echo e(__('front.svc_sp_title2')); ?></h6><p><?php echo e(__('front.svc_sp_desc2')); ?></p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-geo-alt-fill"></i></div><div><h6><?php echo e(__('front.svc_sp_title3')); ?></h6><p><?php echo e(__('front.svc_sp_desc3')); ?></p></div></div>
                    <div class="text-center mt-3"><a href="<?php echo e(route('pos.index')); ?>" class="btn-z btn-z-primary"><i class="bi bi-pin-map"></i> <?php echo e(__('front.svc_sp_btn')); ?></a></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:var(--z-radius-lg);padding:2rem;color:#fff;height:100%">
                    <div style="font-size:3rem;margin-bottom:1rem">🎯</div>
                    <h4 style="color:#fff;font-weight:800;margin-bottom:1rem"><?php echo e(__('front.svc_why_heading')); ?></h4>
                    <?php $__currentLoopData = ['why_us_1','why_us_2','why_us_3','why_us_4','why_us_5']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $bullet = SiteSetting::val($key); ?>
                    <?php if($bullet): ?>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-check-circle-fill" style="color:var(--z-highlight)"></i>
                        <span style="font-size:.88rem;color:rgba(255,255,255,.88)"><?php echo e($bullet); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="mt-4">
                        <a href="<?php echo e(route('student.register')); ?>" class="btn-z btn-z-accent btn-z-block">
                            <i class="bi bi-person-plus-fill"></i> <?php echo e(__('front.svc_register_btn')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-pad" id="teachers">
    <div class="container">
        <div class="text-center mb-5 anim-fade-up">
            <span class="section-label"><?php echo e(__('front.teachers_section_label')); ?></span>
            <h2 class="section-heading"><?php echo e(__('front.teachers_heading')); ?></h2>
            <p class="section-desc mx-auto"><?php echo e(__('front.teachers_heading_desc')); ?></p>
        </div>
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-3 col-md-6 anim-fade-up anim-d<?php echo e(min($loop->index + 1, 4)); ?>">
                <div class="teacher-card">
                    <div class="t-photo-ph"><i class="bi bi-person-circle"></i></div>
                    <div class="t-name"><?php echo e($teacher->name); ?></div>
                    <div class="t-subj"><?php echo e($teacher->specialization ?: __('front.teachers_fallback_subj')); ?></div>
                    <div class="stars">
                        <?php for($i=1;$i<=5;$i++): ?><i class="bi bi-star<?php echo e($i<=round($teacher->average_rating??4.8)?'-fill':''); ?>"></i><?php endfor; ?>
                        <span class="rv">(<?php echo e(number_format($teacher->average_rating??4.8,1)); ?>)</span>
                    </div>
                    <div class="t-meta mt-2">
                        <div><strong><?php echo e(number_format($teacher->total_students??0)); ?></strong><div style="font-size:.75rem"><?php echo e(__('front.teacher_student_label')); ?></div></div>
                        <div><strong><?php echo e($teacher->total_courses??0); ?></strong><div style="font-size:.75rem"><?php echo e(__('front.teacher_course_label')); ?></div></div>
                    </div>
                    <div class="mt-3">
                        <a href="<?php echo e(route('teachers.show', $teacher->id)); ?>" class="btn-z btn-z-outline btn-z-sm btn-z-block">
                            <?php echo e(__('front.teacher_view_profile_btn')); ?>

                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-person-x fs-1 d-block mb-2 opacity-35"></i>
                <?php echo e(__('front.courses_no_courses')); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php if(!empty($leaderboard) && $leaderboard->isNotEmpty()): ?>
<section class="section-pad section-alt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-4 anim-fade-up">
                    <span class="section-label"><?php echo e(__('front.lb_section_label')); ?></span>
                    <h2 class="section-heading"><?php echo e(__('front.lb_heading')); ?></h2>
                    <p class="section-desc mx-auto"><?php echo e(__('front.lb_week_desc')); ?></p>
                </div>
                <div class="lb-card anim-fade-up anim-d2">
                    <div class="lb-head">
                        <i class="bi bi-trophy-fill text-warning fs-5"></i>
                        <h5><?php echo e(__('front.lb_card_title')); ?></h5>
                    </div>
                    <?php $__currentLoopData = $leaderboard; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="lb-row">
                        <div class="lb-pos <?php echo e($i===0?'pos-1':($i===1?'pos-2':($i===2?'pos-3':'pos-n'))); ?>">
                            <?php if($i<3): ?><?php echo e(['🥇','🥈','🥉'][$i]); ?><?php else: ?><?php echo e($i+1); ?><?php endif; ?>
                        </div>
                        <span class="lb-name"><?php echo e($entry->student->name ?? __('front.lb_student_fallback')); ?></span>
                        <span class="lb-pct"><?php echo e($entry->percentage); ?>%</span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('exams.index')); ?>" class="btn-z btn-z-primary btn-z-lg">
                        <i class="bi bi-clipboard-check-fill"></i> <?php echo e(__('front.lb_join_btn')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="section-pad" id="contact">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7 anim-fade-up">
                <span class="section-label"><?php echo e(__('front.contact_section_label')); ?></span>
                <h2 class="section-heading"><?php echo e(__('front.contact_heading')); ?></h2>
                <p class="section-desc mb-4"><?php echo e(__('front.contact_sub_desc')); ?></p>
                <div class="contact-card">
                    <form method="POST" action="<?php echo e(route('contact.store')); ?>" novalidate>
                        <?php echo csrf_field(); ?>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="z-label"><?php echo e(__('front.contact_full_name')); ?> <span class="text-danger"><?php echo e(__('front.contact_required')); ?></span></label>
                                <input type="text" name="name" class="z-input <?php echo e($errors->has('name')?'is-invalid':''); ?>" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('front.contact_full_name_ph')); ?>" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6">
                                <label class="z-label"><?php echo e(__('front.contact_email_field')); ?> <span class="text-danger"><?php echo e(__('front.contact_required')); ?></span></label>
                                <input type="email" name="email" class="z-input <?php echo e($errors->has('email')?'is-invalid':''); ?>" value="<?php echo e(old('email')); ?>" placeholder="example@email.com" dir="ltr" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="z-label"><?php echo e(__('front.contact_phone_field')); ?></label>
                                <input type="tel" name="phone" class="z-input" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('front.contact_phone_ph')); ?>" dir="ltr">
                            </div>
                            <div class="col-md-6">
                                <label class="z-label"><?php echo e(__('front.contact_subject_field')); ?></label>
                                <input type="text" name="subject" class="z-input" value="<?php echo e(old('subject')); ?>" placeholder="<?php echo e(__('front.contact_subject_ph')); ?>">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="z-label"><?php echo e(__('front.contact_message_field')); ?> <span class="text-danger"><?php echo e(__('front.contact_required')); ?></span></label>
                            <textarea name="message" rows="5" class="z-textarea <?php echo e($errors->has('message')?'is-invalid':''); ?>" placeholder="<?php echo e(__('front.contact_message_ph_txt')); ?>" required><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="z-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                            <i class="bi bi-send-fill"></i> <?php echo e(__('front.contact_send_btn')); ?>

                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 anim-fade-up anim-d2">
                <div style="padding-top:3.5rem">
                    <?php
                        $cPhone  = \App\Models\SiteSetting::raw('contact_phone');
                        $cEmail  = \App\Models\SiteSetting::raw('contact_email');
                        $cWa     = \App\Models\SiteSetting::raw('contact_whatsapp');
                        $cHours  = \App\Models\SiteSetting::val('contact_hours');
                        $cPhHrs  = \App\Models\SiteSetting::val('contact_phone_hours');
                    ?>
                    <?php if($cPhone): ?>
                    <div class="ci-item"><div class="ci-icon"><i class="bi bi-telephone-fill"></i></div><div class="ci-text"><h6><?php echo e(__('front.contact_phone_label_word')); ?></h6><p><?php echo e($cPhone); ?><br><?php echo e($cPhHrs); ?></p></div></div>
                    <?php endif; ?>
                    <?php if($cEmail): ?>
                    <div class="ci-item"><div class="ci-icon"><i class="bi bi-envelope-fill"></i></div><div class="ci-text"><h6><?php echo e(__('front.contact_email_field')); ?></h6><p><?php echo e($cEmail); ?></p></div></div>
                    <?php endif; ?>
                    <?php if($cWa): ?>
                    <div class="ci-item"><div class="ci-icon"><i class="bi bi-whatsapp"></i></div><div class="ci-text"><h6><?php echo e(__('front.contact_whatsapp_label')); ?></h6><p><?php echo e($cWa); ?></p></div></div>
                    <?php endif; ?>
                    <?php if($cHours): ?>
                    <div class="ci-item"><div class="ci-icon"><i class="bi bi-clock-fill"></i></div><div class="ci-text"><h6><?php echo e(__('front.contact_hours_label_word')); ?></h6><p><?php echo e($cHours); ?></p></div></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\home.blade.php ENDPATH**/ ?>