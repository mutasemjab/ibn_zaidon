@extends('front.layouts.app')
@php
    $siteName    = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name');
    $locale      = app()->getLocale();
    $cur         = __('front.currency');
    $isFree      = ($course->price ?? 0) == 0;
    $lessonTotal = $course->units->sum(fn ($u) => $u->lessons->count());
    $teacherName = $course->teacher->name ?? null;
@endphp
@section('seo_title', $course->title . ' | ' . $siteName)
@section('meta_desc', Str::limit(strip_tags($course->description ?: __('front.course_meta_desc_fallback', ['site' => $siteName, 'teacher' => $teacherName ?? $siteName])), 160))
@section('og_type', 'article')

@push('json_ld')
@php
    $courseLd = array_filter([
        '@context'    => 'https://schema.org',
        '@type'       => 'Course',
        'name'        => $course->title,
        'description' => Str::limit(strip_tags($course->description), 300) ?: null,
        'url'         => url()->current(),
        'provider'    => ['@type' => 'EducationalOrganization', '@id' => url('/') . '/#organization', 'name' => $siteName],
        'instructor'  => $course->teacher ? array_filter([
            '@type'    => 'Person',
            'name'     => $course->teacher->name,
            'jobTitle' => $course->teacher->specialization ?: null,
        ]) : null,
        'inLanguage'       => $locale,
        'educationalLevel' => $course->category->name ?? null,
        'offers' => [
            '@type'         => 'Offer',
            'price'         => (string) ($course->price ?? 0),
            'priceCurrency' => 'JOD',
            'availability'  => 'https://schema.org/InStock',
            'category'      => $isFree ? __('front.jsonld_free') : __('front.jsonld_paid'),
        ],
        'hasCourseInstance' => ['@type' => 'CourseInstance', 'courseMode' => 'online', 'inLanguage' => $locale],
    ]);
    $crumbLd = [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => __('front.home'),                   'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => __('front.courses_page_breadcrumb'), 'item' => route('courses.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $course->title,                      'item' => url()->current()],
        ],
    ];
    $ldFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG;
@endphp
<script type="application/ld+json">{!! json_encode($courseLd, $ldFlags) !!}</script>
<script type="application/ld+json">{!! json_encode($crumbLd, $ldFlags) !!}</script>
@endpush

@section('content')

{{-- Course Hero --}}
<div class="course-hero">
    <div class="container">
        <div class="z-breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <a href="{{ route('courses.index') }}">{{ __('front.courses_page_breadcrumb') }}</a>
            <span class="sep">/</span>
            <span>{{ Str::limit($course->title, 40) }}</span>
        </div>
        <div class="row align-items-start g-4">
            <div class="col-lg-8">
                <h1>{{ $course->title }}</h1>
                @if($course->description)
                <p style="color:rgba(255,255,255,.78);font-size:.97rem;margin-top:.75rem;max-width:680px">
                    {{ Str::limit($course->description, 200) }}
                </p>
                @endif
                <div class="c-meta-strip">
                    @if($course->teacher)
                    <span class="c-meta"><i class="bi bi-person-fill"></i> {{ $course->teacher->name }}</span>
                    @endif
                    @if($course->category)
                    <span class="c-meta"><i class="bi bi-tag-fill"></i> {{ $course->category->name }}</span>
                    @endif
                    <span class="c-meta"><i class="bi bi-people-fill"></i> {{ number_format($course->total_students ?? 0) }} {{ __('front.courses_students') }}</span>
                    @if($course->units->count())
                    <span class="c-meta"><i class="bi bi-collection-play"></i> {{ $course->units->count() }} {{ __('front.course_units_count') }}</span>
                    @endif
                    @if($course->average_rating)
                    <span class="c-meta"><i class="bi bi-star-fill" style="color:var(--z-highlight)"></i> {{ number_format($course->average_rating, 1) }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">

    {{-- Alerts --}}
    @if(session('activation_success') && session('activated_course') == $course->id)
    <div class="z-flash flash-success mb-4">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <span>{{ session('activation_success') }}</span>
    </div>
    @endif
    @if(session('activation_error') && session('error_course') == $course->id)
    <div class="z-flash flash-error mb-4">
        <i class="bi bi-exclamation-circle-fill fs-5"></i>
        <span>{{ session('activation_error') }}</span>
    </div>
    @endif

    <div class="row g-5">

        {{-- Left: Curriculum + Related --}}
        <div class="col-lg-8" id="curriculum">

            {{-- What You'll Learn --}}
            @if($course->what_you_learn)
            <div class="mb-5 p-4" style="background:rgba(245,166,35,.06);border-radius:var(--z-radius-lg);border:1.5px solid rgba(245,166,35,.2)">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1rem">
                    <i class="bi bi-lightbulb-fill text-warning me-2"></i>{{ __('front.course_what_learn') }}
                </h5>
                <div class="row g-2">
                    @foreach(explode("\n", $course->what_you_learn) as $point)
                    @if(trim($point))
                    <div class="col-md-6 d-flex align-items-start gap-2">
                        <i class="bi bi-check-circle-fill mt-1" style="color:var(--z-success);flex-shrink:0"></i>
                        <span style="font-size:.9rem">{{ trim($point) }}</span>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Curriculum --}}
            <h4 style="color:var(--z-primary);font-weight:800;margin-bottom:1.25rem">
                <i class="bi bi-collection-play-fill me-2"></i>{{ __('front.course_content_title') }}
            </h4>

            @forelse($course->units as $unit)
            <div class="mb-2">
                <button class="unit-acc-btn {{ $loop->first ? '' : 'collapsed' }}"
                        data-body="unit-body-{{ $unit->id }}">
                    <span>
                        <span style="background:rgba(255,255,255,.18);border-radius:6px;padding:.1rem .5rem;font-size:.78rem;margin-inline-end:.6rem">{{ $loop->iteration }}</span>
                        {{ $unit->title }}
                    </span>
                    <span class="d-flex align-items-center gap-2">
                        <span style="font-size:.78rem;opacity:.7">{{ $unit->lessons->count() }} {{ __('front.course_unit_lessons') }}</span>
                        <i class="bi bi-chevron-down acc-ico" style="transition:transform .25s"></i>
                    </span>
                </button>
                <div class="unit-acc-body {{ $loop->first ? 'show' : '' }}" id="unit-body-{{ $unit->id }}">
                    @forelse($unit->lessons as $lesson)
                    <div class="lesson-row">
                        <div class="lesson-ic">
                            @if($lesson->lesson_type === 'video')
                                <i class="bi bi-play-fill text-primary"></i>
                            @elseif($lesson->lesson_type === 'pdf')
                                <i class="bi bi-file-pdf text-danger"></i>
                            @else
                                <i class="bi bi-file-text"></i>
                            @endif
                        </div>
                        <span style="flex:1">{{ $lesson->title }}</span>
                        @if($lesson->duration_minutes)
                        <span style="font-size:.78rem;color:var(--z-text-muted)">{{ $lesson->duration_minutes }} {{ __('front.course_min_short') }}</span>
                        @endif
                        @if(!$isEnrolled && !$lesson->is_free)
                        <span class="lesson-lock"><i class="bi bi-lock-fill"></i></span>
                        @else
                        <span style="color:var(--z-success);font-size:.82rem"><i class="bi bi-play-circle-fill"></i></span>
                        @endif
                    </div>
                    @if(isset($lessonExams[$lesson->id]))
                    <div class="lesson-row" style="background:rgba(245,166,35,.06);border-color:rgba(245,166,35,.25)">
                        <div class="lesson-ic" style="background:rgba(245,166,35,.15)"><i class="bi bi-clipboard-check text-warning"></i></div>
                        <span style="flex:1;font-size:.85rem">{{ $lessonExams[$lesson->id]->title }}</span>
                        <span style="font-size:.75rem;color:#b97700;background:rgba(245,166,35,.12);padding:.15rem .5rem;border-radius:50px">{{ __('front.exam_label') }}</span>
                    </div>
                    @endif
                    @empty
                    <div class="lesson-row" style="color:var(--z-text-muted);font-size:.88rem">{{ __('front.course_no_lessons') }}</div>
                    @endforelse
                    @if(isset($unitEndExams[$unit->id]))
                    <div class="lesson-row" style="background:rgba(11,61,145,.05);border-color:rgba(11,61,145,.18)">
                        <div class="lesson-ic" style="background:rgba(11,61,145,.1)"><i class="bi bi-journal-check text-primary"></i></div>
                        <span style="flex:1;font-size:.88rem;font-weight:600">{{ $unitEndExams[$unit->id]->title }}</span>
                        <span style="font-size:.75rem;color:var(--z-primary);background:rgba(11,61,145,.1);padding:.15rem .5rem;border-radius:50px">{{ __('front.unit_exam') }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div style="text-align:center;padding:3rem;color:var(--z-text-muted)">
                <i class="bi bi-collection" style="font-size:3rem;opacity:.35;display:block;margin-bottom:1rem"></i>
                {{ __('front.course_no_units') }}
            </div>
            @endforelse

            {{-- Course-level Exams --}}
            @if($courseExams->isNotEmpty())
            <div class="mt-4 p-3" style="background:var(--z-section-bg);border-radius:var(--z-radius);border:1.5px dashed var(--z-border)">
                <h6 style="color:var(--z-primary);font-weight:700;margin-bottom:.75rem">
                    <i class="bi bi-clipboard-data-fill me-2"></i>{{ __('front.course_final_exams_title') }}
                </h6>
                @foreach($courseExams as $exam)
                <div class="d-flex align-items-center gap-3 py-2 border-bottom" style="border-color:var(--z-border)!important">
                    <i class="bi bi-file-earmark-check-fill" style="color:var(--z-success);font-size:1.1rem"></i>
                    <span style="flex:1;font-size:.9rem">{{ $exam->title }}</span>
                    @if($isEnrolled)
                    <a href="{{ route('exams.show', $exam->id) }}" class="btn-z btn-z-success btn-z-sm">{{ __('front.course_start_short') }}</a>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

            {{-- Related Courses --}}
            @if($relatedCourses->isNotEmpty())
            <div class="mt-5">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">{{ __('front.course_similar') }}</h5>
                <div class="row g-3">
                    @foreach($relatedCourses as $rc)
                    <div class="col-md-4">
                        <div class="course-card">
                            <div class="course-thumb-ph" style="aspect-ratio:16/6;font-size:2rem"><i class="bi bi-play-circle"></i></div>
                            <div class="course-body">
                                <div class="course-title" style="-webkit-line-clamp:2">{{ $rc->title }}</div>
                                <div class="course-teacher"><div class="av-xs"><i class="bi bi-person-fill"></i></div><span>{{ $rc->teacher->name ?? __('front.teacher_fallback') }}</span></div>
                            </div>
                            <div class="course-foot">
                                <span class="price-tag {{ ($rc->price??0)==0?'price-free':'' }}">
                                    {{ ($rc->price??0)>0 ? number_format($rc->price,2).' '.$cur : __('front.courses_free') }}
                                </span>
                            </div>
                            <div class="px-3 pb-3">
                                <a href="{{ route('courses.show', $rc->id) }}" class="btn-z btn-z-outline btn-z-sm btn-z-block">{{ __('front.view') }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Right: Purchase Box --}}
        <div class="col-lg-4">
            <div class="purchase-box">
                @if($isEnrolled)
                {{-- Already enrolled --}}
                <div style="text-align:center;padding:1rem 0">
                    <div style="width:64px;height:64px;background:rgba(40,167,69,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;font-size:1.8rem;color:var(--z-success)">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h5 style="color:var(--z-success)">{{ __('front.course_enrolled_title') }}</h5>
                    <p style="color:var(--z-text-muted);font-size:.88rem">{{ __('front.course_enrolled_desc') }}</p>
                    <a href="#curriculum" class="btn-z btn-z-success btn-z-lg btn-z-block mt-2">
                        <i class="bi bi-play-circle-fill"></i> {{ __('front.course_start_learning') }}
                    </a>
                </div>
                @else
                {{-- Price & purchase --}}
                <div class="purchase-price">
                    @if(! $isFree)
                        {{ number_format($course->price, 2) }}
                        <span class="cur">{{ $cur }}</span>
                    @else
                        <span style="color:var(--z-success)">{{ __('front.courses_free') }}</span>
                    @endif
                </div>

                {{-- Add to cart --}}
                @if(! $isFree)
                <form method="POST" action="{{ route('cart.add', $course->id) }}" class="mb-2">
                    @csrf
                    <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                        <i class="bi bi-cart-plus-fill"></i> {{ __('front.course_add_cart_btn') }}
                    </button>
                </form>
                @endif

                {{-- Activate with card --}}
                @auth('student')
                <div class="mt-3">
                    <div class="divider-text"><span>{{ __('front.course_or_card') }}</span></div>
                    <form method="POST" action="{{ route('courses.activate', $course->id) }}">
                        @csrf
                        <input type="text" name="card_number"
                               class="z-input code-input mb-2 {{ $errors->has('card_number') ? 'is-invalid' : '' }}"
                               placeholder="XXXX-XXXX-XXXX" dir="ltr"
                               value="{{ old('card_number') }}" required>
                        @error('card_number')<span class="z-error">{{ $message }}</span>@enderror
                        <button type="submit" class="btn-z btn-z-success btn-z-block">
                            <i class="bi bi-key-fill"></i> {{ __('front.course_activate_btn') }}
                        </button>
                    </form>
                </div>
                @else
                <div class="mt-3 text-center">
                    <p style="font-size:.85rem;color:var(--z-text-muted)">
                        <a href="{{ route('student.login') }}" style="color:var(--z-accent);font-weight:600">{{ __('front.course_login_link') }}</a>
                        {{ __('front.course_login_suffix') }}
                    </p>
                </div>
                @endauth

                {{-- Includes --}}
                <div class="mt-4 pt-3" style="border-top:1.5px solid var(--z-border)">
                    <div class="include-row"><i class="bi bi-infinity"></i> {{ __('front.course_inc_unlimited') }}</div>
                    <div class="include-row"><i class="bi bi-phone-fill"></i> {{ __('front.course_inc_devices') }}</div>
                    @if($courseExams->isNotEmpty())
                    <div class="include-row"><i class="bi bi-clipboard-check-fill"></i> {{ __('front.course_inc_final_exam', ['count' => $courseExams->count()]) }}</div>
                    @endif
                    @if($lessonTotal > 0)
                    <div class="include-row"><i class="bi bi-collection-play-fill"></i> {{ __('front.course_inc_lessons', ['count' => $lessonTotal]) }}</div>
                    @endif
                    <div class="include-row"><i class="bi bi-award-fill"></i> {{ __('front.course_sidebar_cert') }}</div>
                </div>
                @endif

                {{-- Teacher Info --}}
                @if($course->teacher)
                <div class="mt-4 pt-3" style="border-top:1.5px solid var(--z-border);text-align:center">
                    <div class="t-photo-ph" style="width:56px;height:56px;font-size:1.3rem;margin-bottom:.6rem">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div style="font-weight:700;color:var(--z-primary);font-size:.95rem">{{ $course->teacher->name }}</div>
                    @if($course->teacher->specialization)
                    <div style="font-size:.8rem;color:var(--z-text-muted);margin-bottom:.6rem">{{ $course->teacher->specialization }}</div>
                    @endif
                    <a href="{{ route('teachers.show', $course->teacher->id) }}"
                       class="btn-z btn-z-outline btn-z-sm">{{ __('front.teacher_view_profile_btn') }}</a>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
