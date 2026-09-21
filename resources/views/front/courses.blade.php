@extends('front.layouts.app')
@section('title', __('front.courses_page_header'))

@section('content')
@php
    $isRtl    = app()->getLocale() === 'ar';
    $prevIcon = $isRtl ? 'chevron-right' : 'chevron-left';
    $nextIcon = $isRtl ? 'chevron-left'  : 'chevron-right';
    $hasSubject = isset($currentSubject) && $currentSubject;
@endphp

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            @if($hasSubject && $currentSubject->category)
                <span class="sep">/</span>
                <a href="{{ route('categories.show', $currentSubject->category_id) }}">{{ $currentSubject->category->name }}</a>
            @endif
            <span class="sep">/</span>
            <span>{{ $hasSubject ? $currentSubject->name : __('front.courses_page_breadcrumb') }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2rem);margin:0">
            {{ $hasSubject ? __('front.courses_of_subject', ['name' => $currentSubject->name]) : __('front.courses_page_header') }}
        </h1>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">

        {{-- Sidebar Filters --}}
        <div class="col-lg-3">
            <div style="background:#fff;border-radius:var(--z-radius-lg);padding:1.5rem;border:1.5px solid var(--z-border);position:sticky;top:calc(var(--navbar-h) + 1rem)">
                <h6 style="font-weight:700;color:var(--z-primary);margin-bottom:1.25rem;display:flex;align-items:center;gap:.5rem">
                    <i class="bi bi-funnel-fill"></i> {{ __('front.courses_filter_title') }}
                </h6>

                <form method="GET" action="{{ route('courses.index') }}">
                    {{-- Search --}}
                    <div class="mb-3">
                        <label class="z-label">{{ __('front.search') }}</label>
                        <div style="position:relative">
                            <input type="text" name="q" class="z-input" style="padding-inline-end:2.5rem"
                                   value="{{ request('q') }}" placeholder="{{ __('front.courses_search_ph') }}">
                            <i class="bi bi-search" style="position:absolute;top:50%;inset-inline-end:.85rem;transform:translateY(-50%);color:var(--z-text-muted)"></i>
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="z-label">{{ __('front.courses_category_label') }}</label>
                        <select name="category" class="z-select z-input">
                            <option value="">{{ __('front.courses_filter_all_cat') }}</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sort --}}
                    <div class="mb-4">
                        <label class="z-label">{{ __('front.courses_sort_label') }}</label>
                        <select name="sort" class="z-select z-input">
                            <option value="popular"   {{ request('sort','popular') === 'popular'   ? 'selected' : '' }}>{{ __('front.courses_sort_popular') }}</option>
                            <option value="newest"    {{ request('sort') === 'newest'    ? 'selected' : '' }}>{{ __('front.courses_sort_newest') }}</option>
                            <option value="top-rated" {{ request('sort') === 'top-rated' ? 'selected' : '' }}>{{ __('front.courses_sort_rated') }}</option>
                            <option value="cheap"     {{ request('sort') === 'cheap'     ? 'selected' : '' }}>{{ __('front.courses_sort_cheap') }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-search"></i> {{ __('front.courses_apply_filter') }}
                    </button>
                    @if(request()->hasAny(['q','category','sort']))
                    <a href="{{ route('courses.index') }}" class="btn-z btn-z-outline btn-z-block mt-2">
                        <i class="bi bi-x-circle"></i> {{ __('front.courses_clear_filter') }}
                    </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Course Grid --}}
        <div class="col-lg-9">

            {{-- Results count + active filters --}}
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                <span style="color:var(--z-text-muted);font-size:.9rem">
                    <strong style="color:var(--z-primary)">{{ $courses->total() }}</strong> {{ __('front.courses_available_suffix') }}
                </span>
                @if(request()->hasAny(['q','category']))
                <div class="d-flex gap-2 flex-wrap">
                    @if(request('q'))
                        <span style="background:rgba(30,107,214,.1);color:var(--z-accent);padding:.2rem .7rem;border-radius:50px;font-size:.8rem;font-weight:600">
                            {{ __('front.courses_search_tag') }} {{ request('q') }}
                        </span>
                    @endif
                </div>
                @endif
            </div>

            @forelse($courses as $course)
            @if($loop->first)
            <div class="row g-4">
            @endif
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-thumb-ph"><i class="bi bi-play-circle"></i></div>
                        <div class="course-body">
                            <div class="course-tags">
                                @if($course->average_rating >= 4.5)
                                    <span class="tag tag-popular">{{ __('front.courses_top_rated') }}</span>
                                @endif
                            </div>
                            <div class="course-title">{{ $course->title }}</div>
                            <div class="course-teacher">
                                <div class="av-xs"><i class="bi bi-person-fill"></i></div>
                                <span>{{ $course->teacher->name ?? __('front.teacher_fallback') }}</span>
                            </div>
                            @if($course->category)
                            <div style="font-size:.78rem;color:var(--z-text-muted);margin-top:.3rem">
                                <i class="bi bi-tag-fill me-1" style="color:var(--z-highlight)"></i>
                                {{ $course->category->name }}
                            </div>
                            @endif
                        </div>
                        <div class="course-foot">
                            <span class="price-tag {{ ($course->price??0)==0?'price-free':'' }}">
                                {{ ($course->price??0)>0 ? number_format($course->price,2).' '.__('front.currency') : __('front.courses_free') }}
                            </span>
                            <span class="enroll-ct">
                                <i class="bi bi-people-fill"></i>
                                {{ number_format($course->total_students??0) }}
                            </span>
                        </div>
                        <div class="px-3 pb-3">
                            <a href="{{ route('courses.show', $course->id) }}"
                               class="btn-z btn-z-primary btn-z-sm btn-z-block">
                                <i class="bi bi-eye"></i> {{ __('front.course_view_btn') }}
                            </a>
                        </div>
                    </div>
                </div>
            @if($loop->last)
            </div>
            @endif
            @empty
            <div class="text-center py-5">
                <i class="bi bi-search" style="font-size:4rem;color:var(--z-border)"></i>
                <h5 style="color:var(--z-text-muted);margin-top:1rem">{{ __('front.courses_no_results') }}</h5>
                <p style="color:var(--z-text-muted);font-size:.9rem">{{ __('front.courses_change_terms') }}</p>
                <a href="{{ route('courses.index') }}" class="btn-z btn-z-outline mt-2">{{ __('front.courses_view_all') }}</a>
            </div>
            @endforelse

            {{-- Pagination --}}
            @if($courses->hasPages())
            <nav class="z-pagination mt-4">
                @if($courses->onFirstPage())
                    <span class="z-page-link disabled"><i class="bi bi-{{ $prevIcon }}"></i></span>
                @else
                    <a href="{{ $courses->previousPageUrl() }}" class="z-page-link"><i class="bi bi-{{ $prevIcon }}"></i></a>
                @endif

                @foreach($courses->getUrlRange(max(1, $courses->currentPage()-2), min($courses->lastPage(), $courses->currentPage()+2)) as $page => $url)
                    <a href="{{ $url }}" class="z-page-link {{ $page == $courses->currentPage() ? 'current' : '' }}">{{ $page }}</a>
                @endforeach

                @if($courses->hasMorePages())
                    <a href="{{ $courses->nextPageUrl() }}" class="z-page-link"><i class="bi bi-{{ $nextIcon }}"></i></a>
                @else
                    <span class="z-page-link disabled"><i class="bi bi-{{ $nextIcon }}"></i></span>
                @endif
            </nav>
            @endif
        </div>
    </div>
</div>
@endsection
