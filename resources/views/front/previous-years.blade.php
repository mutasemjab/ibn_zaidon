@extends('front.layouts.app')
@section('title', __('front.py_page_header'))

@section('content')
@php $isRtl = app()->getLocale() === 'ar'; @endphp

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <span>{{ __('front.py_page_header') }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2rem);margin:0">
            <i class="bi bi-calendar-check me-2"></i>{{ __('front.py_page_header') }}
        </h1>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">

        {{-- Sidebar --}}
        <div class="col-lg-3">
            <button class="mobile-filter-toggle" id="filterToggle">
                <i class="bi bi-funnel-fill"></i> {{ __('front.courses_filter_title') }}
                <i class="bi bi-chevron-down ms-auto" id="filterChevron"></i>
            </button>
            <div class="courses-sidebar" id="coursesSidebar">
                <h6 style="font-weight:700;color:var(--z-primary);margin-bottom:1.25rem;display:flex;align-items:center;gap:.5rem">
                    <i class="bi bi-funnel-fill"></i> {{ __('front.courses_filter_title') }}
                </h6>
                <form method="GET" action="{{ route('previous-years.index') }}">
                    <div class="mb-3">
                        <label class="z-label">{{ __('front.search') }}</label>
                        <input type="text" name="q" class="z-input" value="{{ request('q') }}" placeholder="{{ __('front.courses_search_ph') }}">
                    </div>
                    <div class="mb-3">
                        <label class="z-label">{{ __('front.filter_subject_label') }}</label>
                        <select name="subject" class="z-select z-input">
                            <option value="">{{ __('front.filter_all_subjects') }}</option>
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}" {{ request('subject') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="z-label">{{ __('front.py_filter_year') }}</label>
                        <select name="year" class="z-select z-input">
                            <option value="">{{ __('front.py_all_years') }}</option>
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-search"></i> {{ __('front.courses_apply_filter') }}
                    </button>
                    @if(request()->hasAny(['q','subject','year']))
                        <a href="{{ route('previous-years.index') }}" class="btn-z btn-z-outline btn-z-block mt-2">
                            <i class="bi bi-x-circle"></i> {{ __('front.courses_clear_filter') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Grid --}}
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                <span style="color:var(--z-text-muted);font-size:.9rem">
                    <strong style="color:var(--z-primary)">{{ $items->total() }}</strong> {{ __('front.py_count_suffix') }}
                </span>
            </div>

            @if($items->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size:4rem;color:var(--z-border)"></i>
                    <h5 style="color:var(--z-text-muted);margin-top:1rem">{{ __('front.py_no_results') }}</h5>
                </div>
            @else
                <div class="row g-4">
                    @foreach($items as $item)
                    <div class="col-md-6 col-lg-4">
                        @include('front.partials.pdf-card', [
                            'title'      => $item->title,
                            'tag'        => $item->tag,
                            'subject'    => $item->subject?->name,
                            'year'       => $item->year,
                            'pages'      => $item->pages,
                            'pdfUrl'     => asset('assets/uploads/previousYearExam/' . $item->pdf_file),
                            'icon'       => 'bi-calendar-check',
                            'colorClass' => 'pdf-card-blue',
                        ])
                    </div>
                    @endforeach
                </div>
                @if($items->hasPages())
                    <nav class="z-pagination mt-4">
                        @if($items->onFirstPage())
                            <span class="z-page-link disabled"><i class="bi bi-chevron-{{ $isRtl ? 'right' : 'left' }}"></i></span>
                        @else
                            <a href="{{ $items->previousPageUrl() }}" class="z-page-link"><i class="bi bi-chevron-{{ $isRtl ? 'right' : 'left' }}"></i></a>
                        @endif
                        @foreach($items->getUrlRange(max(1,$items->currentPage()-2), min($items->lastPage(),$items->currentPage()+2)) as $page => $url)
                            <a href="{{ $url }}" class="z-page-link {{ $page == $items->currentPage() ? 'current' : '' }}">{{ $page }}</a>
                        @endforeach
                        @if($items->hasMorePages())
                            <a href="{{ $items->nextPageUrl() }}" class="z-page-link"><i class="bi bi-chevron-{{ $isRtl ? 'left' : 'right' }}"></i></a>
                        @else
                            <span class="z-page-link disabled"><i class="bi bi-chevron-{{ $isRtl ? 'left' : 'right' }}"></i></span>
                        @endif
                    </nav>
                @endif
            @endif
        </div>
    </div>
</div>
@include('front.partials.filter-toggle-script')
@endsection
