@extends('front.layouts.app')

@section('seo_title', 'أكاديمية ابن زيدون التعليمية | دورات توجيهي وأساسي أردن | تعلم أونلاين')
@section('meta_desc', 'أكاديمية ابن زيدون التعليمية — أفضل منصة تعليم إلكتروني في الأردن. دورات تفاعلية للصفوف 1-10 والتوجيهي، إشراف نخبة المعلمين الأردنيين، امتحانات ذكية، وأوراق عمل احترافية. سجّل مجاناً الآن!')
@section('meta_keywords', 'أكاديمية ابن زيدون التعليمية, دورات توجيهي أردن, منصة تعليمية أردنية, كورسات الصف العاشر, دروس أونلاين أردن, تعلم إلكتروني أردن, امتحانات التوجيهي, دروس خصوصية أونلاين, أفضل منصة تعليمية أردن, ابن زيدون التعليمية, دورات الصف التاسع, دورات الصف العاشر')

@push('json_ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "@id": "{{ url('/') }}/#webpage",
      "url": "{{ url('/') }}",
      "name": "أكاديمية ابن زيدون التعليمية | دورات توجيهي وأساسي أردن",
      "isPartOf": { "@id": "{{ url('/') }}/#website" },
      "about": { "@id": "{{ url('/') }}/#organization" },
      "description": "أفضل منصة تعليم إلكتروني في الأردن للمرحلة الأساسية والتوجيهي",
      "inLanguage": "ar"
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "ما هي أكاديمية ابن زيدون التعليمية؟",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "أكاديمية ابن زيدون التعليمية منصة تعليم إلكتروني أردنية متخصصة في تقديم دورات تفاعلية للمرحلة الأساسية (الصفوف من الأول حتى العاشر) والتوجيهي (اول وثاني ثانوي)، إلى جانب امتحانات ذكية وأوراق عمل احترافية بإشراف نخبة من المعلمين المتميزين في الأردن."
          }
        },
        {
          "@type": "Question",
          "name": "هل تقدم أكاديمية ابن زيدون دورات للتوجيهي؟",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "نعم، تقدم أكاديمية ابن زيدون دورات شاملة لاول ثانوي وثاني ثانوي (التوجيهي) لجميع الفروع: الفرع الصحي، فرع الهندسة والعلوم والتكنولوجيا، فرع إدارة الأعمال، وفرع الآداب والعلوم الإنسانية. تشمل الدورات جميع المواد الوزارية والمدرسية."
          }
        },
        {
          "@type": "Question",
          "name": "ما الصفوف الدراسية التي تغطيها أكاديمية ابن زيدون؟",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "تغطي أكاديمية ابن زيدون التعليمية جميع صفوف المرحلة الأساسية من الصف الأول حتى الصف العاشر، بالإضافة إلى الصف الحادي عشر (اول ثانوي) والصف الثاني عشر (التوجيهي / ثاني ثانوي)."
          }
        },
        {
          "@type": "Question",
          "name": "كيف يمكن التسجيل في أكاديمية ابن زيدون التعليمية؟",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "يمكن التسجيل في أكاديمية ابن زيدون التعليمية بسهولة عبر الموقع الإلكتروني. انقر على زر 'إنشاء حساب جديد'، أدخل اسمك ورقم هاتفك وكلمة المرور، ثم ابدأ التعلم فوراً. التسجيل مجاني ومتاح طوال اليوم."
          }
        },
        {
          "@type": "Question",
          "name": "هل يمكن الوصول لدورات أكاديمية ابن زيدون من الهاتف؟",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "نعم، أكاديمية ابن زيدون التعليمية متوافقة مع جميع الأجهزة — هاتف ذكي، تابلت، أو حاسوب. يمكنك الوصول إلى دوراتك وامتحاناتك في أي وقت ومن أي مكان."
          }
        },
        {
          "@type": "Question",
          "name": "ما أسعار الدورات في أكاديمية ابن زيدون؟",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "تقدم أكاديمية ابن زيدون التعليمية دورات بأسعار مناسبة في متناول جميع الطلاب. بعض الدورات متاحة مجاناً، وتُفعَّل الدورات المدفوعة عبر بطاقات خدش متوفرة في نقاط بيع معتمدة في جميع أنحاء الأردن."
          }
        }
      ]
    }
  ]
}
</script>
@endpush

@section('content')

{{-- ════════════ HERO ════════════ --}}
<section class="z-hero" id="hero">
    <div class="hero-blob"></div><div class="hero-blob"></div><div class="hero-blob"></div>
    <div class="hero-wave"></div>
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 hero-content">
                <div class="hero-eyebrow"><i class="bi bi-stars"></i> منصة تعليمية رقم 1 في الأردن</div>
                <h1 class="hero-title">تعلّم بلا حدود<br>وحقّق <span>نجاحك</span><br>اليوم</h1>
                <p class="hero-subtitle">دورات تفاعلية وامتحانات ذكية وأوراق عمل احترافية من نخبة المعلمين في الأردن للمرحلة الأساسية والتوجيهي.</p>
                <div class="hero-actions">
                    <a href="{{ route('courses.index') }}" class="btn-z btn-z-accent btn-z-lg">
                        <i class="bi bi-play-circle-fill"></i> ابدأ التعلم الآن
                    </a>
                    <a href="{{ route('exams.index') }}" class="btn-z btn-z-ghost btn-z-lg">
                        <i class="bi bi-clipboard-check"></i> جرّب الامتحانات
                    </a>
                </div>
                <div class="hero-stats-row">
                    <div class="hero-stat">
                        <strong>+{{ number_format($stats['students']) }}</strong>
                        <span>طالب مسجّل</span>
                    </div>
                    <div class="hero-stat">
                        <strong>+{{ $stats['courses'] }}</strong>
                        <span>دورة تعليمية</span>
                    </div>
                    <div class="hero-stat">
                        <strong>+{{ $stats['teachers'] }}</strong>
                        <span>معلم متميز</span>
                    </div>
                    <div class="hero-stat">
                        <strong>{{ $stats['satisfaction'] }}%</strong>
                        <span>نسبة الرضا</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-visual">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span style="color:rgba(255,255,255,.7);font-size:.83rem">دوراتنا المميزة</span>
                        <span style="background:rgba(245,166,35,.2);color:var(--z-highlight);padding:.15rem .6rem;border-radius:50px;font-size:.75rem;font-weight:700">جديد ✦</span>
                    </div>
                    @forelse($courses->take(3) as $course)
                    <div class="mini-course">
                        <div class="mini-ico {{ $loop->first ? 'gold' : ($loop->index === 1 ? 'blue' : 'green') }}">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="mini-text flex-grow-1">
                            <h6>{{ Str::limit($course->title_ar ?? $course->title ?? 'دورة تعليمية', 32) }}</h6>
                            <span>{{ $course->teacher->name ?? 'معلم ابن زيدون' }}</span>
                        </div>
                        <span style="color:var(--z-highlight);font-weight:800;font-size:.88rem;white-space:nowrap">
                            {{ $course->price > 0 ? number_format($course->price, 0).' د.أ' : 'مجاني' }}
                        </span>
                    </div>
                    @empty
                    <div class="mini-course">
                        <div class="mini-ico gold"><i class="bi bi-mortarboard"></i></div>
                        <div class="mini-text"><h6>رياضيات — الصف العاشر</h6><span>معلم ابن زيدون</span></div>
                    </div>
                    <div class="mini-course">
                        <div class="mini-ico blue"><i class="bi bi-atom"></i></div>
                        <div class="mini-text"><h6>فيزياء — التوجيهي</h6><span>معلم ابن زيدون</span></div>
                    </div>
                    @endforelse
                    <div class="text-center mt-3">
                        <a href="{{ route('courses.index') }}" class="btn-z btn-z-accent btn-z-sm btn-z-block">
                            <i class="bi bi-grid-3x3-gap"></i> عرض كل الدورات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════ STATS STRIP ════════════ --}}
<section class="stats-strip">
    <div class="container">
        <div class="row g-4 align-items-center text-center">
            <div class="col-6 col-md-3">
                <div class="stat-block">
                    <span class="stat-num" data-count="{{ $stats['students'] }}" data-suffix="+">0</span>
                    <span class="stat-txt"><i class="bi bi-people-fill me-1"></i>طالب مسجّل</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-block">
                    <span class="stat-num" data-count="{{ $stats['courses'] }}" data-suffix="+">0</span>
                    <span class="stat-txt"><i class="bi bi-play-btn-fill me-1"></i>دورة متاحة</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-block">
                    <span class="stat-num" data-count="{{ $stats['teachers'] }}" data-suffix="+">0</span>
                    <span class="stat-txt"><i class="bi bi-person-badge-fill me-1"></i>معلم متميز</span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-block">
                    <span class="stat-num" data-count="{{ $stats['satisfaction'] }}" data-suffix="%">0</span>
                    <span class="stat-txt"><i class="bi bi-star-fill me-1"></i>نسبة الرضا</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════ ABOUT ════════════ --}}
<section class="section-pad" id="about">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 anim-fade-up">
                <div style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:var(--z-radius-xl);height:380px;display:flex;align-items:center;justify-content:center">
                    <div class="text-center text-white">
                        <i class="bi bi-mortarboard-fill" style="font-size:6rem;opacity:.35"></i>
                        <div style="font-size:1.5rem;font-weight:800;margin-top:1rem;opacity:.8">أكاديمية ابن زيدون</div>
                        <div style="font-size:.9rem;opacity:.5;margin-top:.4rem">التعليمية</div>
                    </div>
                </div>
                <div class="about-badge">
                    <strong>+{{ number_format($stats['students']) }}</strong>
                    <span>طالب استفادوا من منصتنا</span>
                </div>
            </div>
            <div class="col-lg-7 anim-fade-up anim-d2">
                <span class="section-label">من نحن</span>
                <h2 class="section-heading">نبني جيلاً واعياً<br>ومتفوقاً</h2>
                <p class="section-desc mb-4">أكاديمية ابن زيدون التعليمية منصة أردنية متخصصة في تقديم المحتوى التعليمي الرقمي للطلبة في مختلف المراحل الدراسية. نعمل مع نخبة من المعلمين المتميزين لتقديم محتوى عالي الجودة يُمكّن الطالب من التفوق والنجاح.</p>
                <div class="feat-item">
                    <div class="feat-icon"><i class="bi bi-lightbulb-fill"></i></div>
                    <div class="feat-body">
                        <h6>محتوى تعليمي احترافي</h6>
                        <p>دورات مصمّمة بعناية من قِبل معلمين خبراء وفق المنهج الأردني الحديث.</p>
                    </div>
                </div>
                <div class="feat-item">
                    <div class="feat-icon"><i class="bi bi-shield-check-fill"></i></div>
                    <div class="feat-body">
                        <h6>امتحانات تفاعلية ذكية</h6>
                        <p>بنك أسئلة ضخم وامتحانات لأعوام سابقة مع تحليل فوري للنتائج.</p>
                    </div>
                </div>
                <div class="feat-item">
                    <div class="feat-icon"><i class="bi bi-phone-fill"></i></div>
                    <div class="feat-body">
                        <h6>تعلّم في أي وقت ومن أي مكان</h6>
                        <p>منصة متوافقة مع جميع الأجهزة — هاتف، تابلت، أو حاسوب.</p>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <a href="{{ route('courses.index') }}" class="btn-z btn-z-primary btn-z-lg">
                        <i class="bi bi-arrow-left-circle-fill"></i> استعرض الدورات
                    </a>
                    <a href="#contact" class="btn-z btn-z-outline btn-z-lg">
                        <i class="bi bi-chat-dots"></i> تواصل معنا
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════ CATEGORIES ════════════ --}}
<section class="section-pad section-alt" id="categories">
    <div class="container">
        <div class="text-center mb-5 anim-fade-up">
            <span class="section-label">التصنيفات</span>
            <h2 class="section-heading">اختر تخصصك</h2>
            <p class="section-desc mx-auto">تصفّح دوراتنا التعليمية حسب المرحلة الدراسية والتخصص</p>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($categories as $category)
            <div class="col-lg-4 col-md-5 col-10 anim-fade-up anim-d{{ min($loop->index + 1, 4) }}">
                <a href="{{ route('categories.show', $category->id) }}" class="cat-card" style="padding:2.5rem 1.5rem">
                    <div class="cat-icon" style="font-size:2.5rem;margin-bottom:1rem">
                        @if($category->icon)<i class="bi {{ $category->icon }}"></i>@else📚@endif
                    </div>
                    <h5 style="font-size:1.2rem">{{ $category->name_ar ?? $category->name }}</h5>
                    <span class="cat-count">{{ $category->courses_count ?? 0 }} دورة</span>
                </a>
            </div>
            @empty
            <div class="col-lg-4 col-md-5 col-10">
                <div class="cat-card" style="padding:2.5rem 1.5rem">
                    <div class="cat-icon" style="font-size:2.5rem"><i class="bi bi-backpack2"></i></div>
                    <h5 style="font-size:1.2rem">الصفوف الرئيسية</h5>
                    <span class="cat-count">الصف الأول حتى العاشر</span>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-10">
                <div class="cat-card" style="padding:2.5rem 1.5rem">
                    <div class="cat-icon" style="font-size:2.5rem"><i class="bi bi-mortarboard"></i></div>
                    <h5 style="font-size:1.2rem">التوجيهي</h5>
                    <span class="cat-count">اول وثاني ثانوي</span>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ════════════ FEATURED COURSES ════════════ --}}
<section class="section-pad" id="courses">
    <div class="container">
        <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3">
            <div>
                <span class="section-label">الدورات المميزة</span>
                <h2 class="section-heading mb-0">دورات اختارها الطلاب</h2>
            </div>
            <a href="{{ route('courses.index') }}" class="btn-z btn-z-outline btn-z-sm">
                عرض الكل <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        <div class="row g-4">
            @forelse($courses as $course)
            <div class="col-lg-4 col-md-6 anim-fade-up anim-d{{ ($loop->index % 3) + 1 }}">
                <div class="course-card">
                    <div class="course-thumb-ph"><i class="bi bi-play-circle"></i></div>
                    <div class="course-body">
                        <div class="course-tags">
                            @if(str_contains($course->filter_tags ?? '', 'popular'))
                                <span class="tag tag-popular">الأكثر شعبية</span>
                            @endif
                            @if(str_contains($course->filter_tags ?? '', 'trending'))
                                <span class="tag tag-trending">رائج</span>
                            @endif
                        </div>
                        <div class="course-title">{{ $course->title_ar ?? $course->title ?? 'دورة تعليمية' }}</div>
                        <div class="course-teacher">
                            <div class="av-xs"><i class="bi bi-person-fill"></i></div>
                            <span>{{ $course->teacher->name ?? 'معلم ابن زيدون' }}</span>
                        </div>
                    </div>
                    <div class="course-foot">
                        <span class="price-tag {{ ($course->price ?? 0) == 0 ? 'price-free' : '' }}">
                            {{ ($course->price ?? 0) > 0 ? number_format($course->price, 2).' د.أ' : 'مجاني' }}
                        </span>
                        <span class="enroll-ct">
                            <i class="bi bi-people-fill"></i> {{ number_format($course->enrollments_count ?? 0) }}
                        </span>
                    </div>
                    <div class="px-3 pb-3">
                        <a href="{{ route('courses.show', $course->id) }}" class="btn-z btn-z-primary btn-z-sm btn-z-block">
                            <i class="bi bi-eye"></i> عرض الدورة
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-muted">
                <i class="bi bi-journal-x fs-1 d-block mb-2 opacity-35"></i>
                لا توجد دورات متاحة حالياً
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ════════════ SERVICES ════════════ --}}
<section class="section-pad section-alt" id="services">
    <div class="container">
        <div class="text-center mb-5 anim-fade-up">
            <span class="section-label">خدماتنا</span>
            <h2 class="section-heading">كل ما تحتاجه في مكان واحد</h2>
            <p class="section-desc mx-auto">اكتشف مجموعتنا الشاملة من الأدوات والموارد التعليمية</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="svc-tabs-nav mb-4">
                    <button class="svc-tab-btn active" data-target="svc-ws"><i class="bi bi-file-earmark-text"></i> أوراق العمل</button>
                    <button class="svc-tab-btn" data-target="svc-py"><i class="bi bi-calendar-check"></i> أسئلة سنوات</button>
                    <button class="svc-tab-btn" data-target="svc-qb"><i class="bi bi-database-check"></i> بنك الأسئلة</button>
                    <button class="svc-tab-btn" data-target="svc-ps"><i class="bi bi-shop"></i> نقاط بيع</button>
                </div>
                <div class="svc-panel active" id="svc-ws">
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-file-earmark-ruled"></i></div><div><h6>أوراق عمل شاملة لكل المواد</h6><p>تحميل أوراق عمل احترافية مصنّفة حسب الصف والوحدة والمادة، جاهزة للطباعة.</p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-pencil-square"></i></div><div><h6>تدريبات تفاعلية</h6><p>تمارين متنوعة بمستويات مختلفة تناسب جميع قدرات الطلاب.</p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-printer"></i></div><div><h6>جاهزة للطباعة بجودة عالية</h6><p>ملفات PDF احترافية يمكن طباعتها مباشرة أو حفظها للمراجعة.</p></div></div>
                    <div class="text-center mt-3"><a href="{{ route('exams.index') }}" class="btn-z btn-z-primary"><i class="bi bi-download"></i> تصفّح أوراق العمل</a></div>
                </div>
                <div class="svc-panel" id="svc-py">
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-calendar3"></i></div><div><h6>امتحانات السنوات السابقة</h6><p>أرشيف كامل لامتحانات التوجيهي والمرحلة الأساسية من سنوات متعددة.</p></div></div>
                    @forelse(array_slice($overlayData['generations'] ?? [], -2) as $gen)
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-file-earmark-check"></i></div><div><h6>{{ $gen['label'] }}</h6><p>امتحانات كاملة مع النماذج الإجابية وتحليل مفصّل.</p></div></div>
                    @empty
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-file-earmark-check"></i></div><div><h6>جيل 2024</h6><p>امتحانات التوجيهي — جميع الفروع والمواد.</p></div></div>
                    @endforelse
                    <div class="text-center mt-3"><a href="{{ route('exams.index') }}" class="btn-z btn-z-primary"><i class="bi bi-arrow-left-circle"></i> تصفّح الأسئلة</a></div>
                </div>
                <div class="svc-panel" id="svc-qb">
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-database"></i></div><div><h6>بنك أسئلة تفاعلي ضخم</h6><p>آلاف الأسئلة المصنّفة حسب الوحدة والمستوى مع إجابات فورية.</p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-shuffle"></i></div><div><h6>اختبارات عشوائية مخصصة</h6><p>أنشئ اختباراً مخصصاً وفق الوقت والموضوع الذي تحتاجه.</p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-graph-up-arrow"></i></div><div><h6>تحليل الأداء الفوري</h6><p>تقرير مفصّل بعد كل اختبار يُظهر نقاط القوة والضعف.</p></div></div>
                    <div class="text-center mt-3"><a href="{{ route('exams.index') }}" class="btn-z btn-z-primary"><i class="bi bi-collection"></i> استعرض البنك</a></div>
                </div>
                <div class="svc-panel" id="svc-ps">
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-shop-window"></i></div><div><h6>نقاط بيع في كل مكان</h6><p>اشترِ بطاقات تفعيل الدورات من أقرب نقطة بيع معتمدة.</p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-credit-card-2-front"></i></div><div><h6>بطاقات خدش سهلة الاستخدام</h6><p>اكشط كود التفعيل وأدخله في الموقع لتفعيل أي دورة فوراً.</p></div></div>
                    <div class="svc-item"><div class="svc-item-icon"><i class="bi bi-geo-alt-fill"></i></div><div><h6>توزيع على كل المحافظات</h6><p>موزّعون معتمدون في عمّان، الزرقاء، إربد، العقبة وجميع المحافظات.</p></div></div>
                    <div class="text-center mt-3"><a href="#contact" class="btn-z btn-z-primary"><i class="bi bi-pin-map"></i> ابحث عن أقرب نقطة بيع</a></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:var(--z-radius-lg);padding:2rem;color:#fff;height:100%">
                    <div style="font-size:3rem;margin-bottom:1rem">🎯</div>
                    <h4 style="color:#fff;font-weight:800;margin-bottom:1rem">لماذا ابن زيدون؟</h4>
                    @foreach(['محتوى مُحدَّث باستمرار','إشراف مباشر من المعلمين','نتائج فورية وتحليل تفصيلي','دعم فني على مدار الساعة','أسعار في متناول الجميع'] as $f)
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-check-circle-fill" style="color:var(--z-highlight)"></i>
                        <span style="font-size:.88rem;color:rgba(255,255,255,.88)">{{ $f }}</span>
                    </div>
                    @endforeach
                    <div class="mt-4">
                        <a href="{{ route('student.register') }}" class="btn-z btn-z-accent btn-z-block">
                            <i class="bi bi-person-plus-fill"></i> سجّل الآن مجاناً
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════ TEACHERS ════════════ --}}
<section class="section-pad" id="teachers">
    <div class="container">
        <div class="text-center mb-5 anim-fade-up">
            <span class="section-label">المعلمون</span>
            <h2 class="section-heading">نخبة من المعلمين المتميزين</h2>
            <p class="section-desc mx-auto">معلمون خبراء مدرّبون على أحدث أساليب التعليم الرقمي</p>
        </div>
        <div class="row g-4">
            @forelse($teachers as $teacher)
            <div class="col-lg-3 col-md-6 anim-fade-up anim-d{{ min($loop->index + 1, 4) }}">
                <div class="teacher-card">
                    <div class="t-photo-ph"><i class="bi bi-person-circle"></i></div>
                    <div class="t-name">{{ $teacher->name }}</div>
                    <div class="t-subj">{{ $teacher->specialization ?? 'معلم ابن زيدون' }}</div>
                    <div class="stars">
                        @for($i=1;$i<=5;$i++)<i class="bi bi-star{{ $i<=round($teacher->rating??4.8)?'-fill':'' }}"></i>@endfor
                        <span class="rv">({{ number_format($teacher->rating??4.8,1) }})</span>
                    </div>
                    <div class="t-meta mt-2">
                        <div><strong>{{ number_format($teacher->total_students??0) }}</strong><div style="font-size:.75rem">طالب</div></div>
                        <div><strong>{{ $teacher->total_courses??0 }}</strong><div style="font-size:.75rem">دورة</div></div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('teachers.show', $teacher->id) }}" class="btn-z btn-z-outline btn-z-sm btn-z-block">
                            عرض الملف الشخصي
                        </a>
                    </div>
                </div>
            </div>
            @empty
            @foreach(['أ. محمد الأحمد','أ. سارة العلي','أ. خالد السلمان','أ. منى الحسن'] as $t)
            <div class="col-lg-3 col-md-6">
                <div class="teacher-card">
                    <div class="t-photo-ph"><i class="bi bi-person-circle"></i></div>
                    <div class="t-name">{{ $t }}</div>
                    <div class="t-subj">معلم ابن زيدون</div>
                    <div class="stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        <span class="rv">(4.9)</span>
                    </div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ════════════ LEADERBOARD ════════════ --}}
@if(!empty($leaderboard) && $leaderboard->isNotEmpty())
<section class="section-pad section-alt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-4 anim-fade-up">
                    <span class="section-label">أبطال الأسبوع</span>
                    <h2 class="section-heading">لوحة المتفوقين 🏆</h2>
                    <p class="section-desc mx-auto">أعلى المتقدمين في امتحانات هذا الأسبوع</p>
                </div>
                <div class="lb-card anim-fade-up anim-d2">
                    <div class="lb-head">
                        <i class="bi bi-trophy-fill text-warning fs-5"></i>
                        <h5>المتفوقون هذا الأسبوع</h5>
                    </div>
                    @foreach($leaderboard as $i => $entry)
                    <div class="lb-row">
                        <div class="lb-pos {{ $i===0?'pos-1':($i===1?'pos-2':($i===2?'pos-3':'pos-n')) }}">
                            @if($i<3){{ ['🥇','🥈','🥉'][$i] }}@else{{ $i+1 }}@endif
                        </div>
                        <span class="lb-name">{{ $entry->student->name ?? 'طالب' }}</span>
                        <span class="lb-pct">{{ $entry->percentage }}%</span>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('exams.index') }}" class="btn-z btn-z-primary btn-z-lg">
                        <i class="bi bi-clipboard-check-fill"></i> شارك في الامتحانات الآن
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ════════════ CONTACT ════════════ --}}
<section class="section-pad" id="contact">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7 anim-fade-up">
                <span class="section-label">تواصل معنا</span>
                <h2 class="section-heading">نسعد بسماع استفساراتك</h2>
                <p class="section-desc mb-4">راسلنا وسيتواصل معك فريق الدعم خلال 24 ساعة</p>
                <div class="contact-card">
                    <form method="POST" action="{{ route('contact.store') }}" novalidate>
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="z-label">الاسم الكامل <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="z-input {{ $errors->has('name')?'is-invalid':'' }}" value="{{ old('name') }}" placeholder="محمد أحمد" required>
                                @error('name')<span class="z-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="z-label">البريد الإلكتروني <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="z-input {{ $errors->has('email')?'is-invalid':'' }}" value="{{ old('email') }}" placeholder="example@email.com" dir="ltr" required>
                                @error('email')<span class="z-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="z-label">رقم الهاتف</label>
                                <input type="tel" name="phone" class="z-input" value="{{ old('phone') }}" placeholder="+962 7X XXX XXXX" dir="ltr">
                            </div>
                            <div class="col-md-6">
                                <label class="z-label">الموضوع</label>
                                <input type="text" name="subject" class="z-input" value="{{ old('subject') }}" placeholder="استفسار عن الدورات">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="z-label">الرسالة <span class="text-danger">*</span></label>
                            <textarea name="message" rows="5" class="z-textarea {{ $errors->has('message')?'is-invalid':'' }}" placeholder="اكتب رسالتك هنا..." required>{{ old('message') }}</textarea>
                            @error('message')<span class="z-error">{{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                            <i class="bi bi-send-fill"></i> إرسال الرسالة
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 anim-fade-up anim-d2">
                <div style="padding-top:3.5rem">
                    <div class="ci-item"><div class="ci-icon"><i class="bi bi-telephone-fill"></i></div><div class="ci-text"><h6>الهاتف</h6><p>+962 XX XXXX XXX<br>أيام العمل 8ص–6م</p></div></div>
                    <div class="ci-item"><div class="ci-icon"><i class="bi bi-envelope-fill"></i></div><div class="ci-text"><h6>البريد الإلكتروني</h6><p>info@zaidon.jo<br>support@zaidon.jo</p></div></div>
                    <div class="ci-item"><div class="ci-icon"><i class="bi bi-whatsapp"></i></div><div class="ci-text"><h6>واتساب</h6><p>+962 7X XXX XXXX</p></div></div>
                    <div class="ci-item"><div class="ci-icon"><i class="bi bi-clock-fill"></i></div><div class="ci-text"><h6>ساعات العمل</h6><p>السبت – الخميس: 8ص – 6م</p></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
