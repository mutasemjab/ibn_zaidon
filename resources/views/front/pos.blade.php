@extends('front.layouts.app')
@section('title', __('front.pos_page_header'))

@section('content')

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <span>{{ __('front.pos_page_header') }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2rem);margin:0">
            <i class="bi bi-shop me-2"></i>{{ __('front.pos_page_header') }}
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
                <form method="GET" action="{{ route('pos.index') }}">
                    <div class="mb-3">
                        <label class="z-label">{{ __('front.search') }}</label>
                        <input type="text" name="q" class="z-input" value="{{ request('q') }}" placeholder="{{ __('front.courses_search_ph') }}">
                    </div>
                    <div class="mb-4">
                        <label class="z-label">{{ __('front.pos_city_label') }}</label>
                        <select name="city" class="z-select z-input">
                            <option value="">{{ __('front.pos_all_cities') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-search"></i> {{ __('front.courses_apply_filter') }}
                    </button>
                    @if(request()->hasAny(['q','city']))
                        <a href="{{ route('pos.index') }}" class="btn-z btn-z-outline btn-z-block mt-2">
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
                    <strong style="color:var(--z-primary)">{{ $items->total() }}</strong> {{ __('front.pos_count_suffix') }}
                </span>
            </div>

            @if($items->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-shop" style="font-size:4rem;color:var(--z-border)"></i>
                    <h5 style="color:var(--z-text-muted);margin-top:1rem">{{ __('front.pos_no_results') }}</h5>
                </div>
            @else
                <div class="row g-4">
                    @foreach($items as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="pdf-card pdf-card-orange">
                            <div class="pdf-card-icon">
                                <i class="bi bi-shop-window"></i>
                            </div>
                            <div class="pdf-card-body">
                                @if($item->city)
                                    <span class="pdf-tag">{{ $item->city->name }}</span>
                                @endif
                                <h6 class="pdf-title">{{ $item->name }}</h6>
                                <div class="pdf-meta">
                                    <span><i class="bi bi-telephone-fill"></i> {{ $item->phone }}</span>
                                </div>
                            </div>
                            <div class="pdf-card-foot">
                                @if($item->google_map_link)
                                    <a href="{{ $item->google_map_link }}" target="_blank" rel="noopener"
                                       class="btn-z btn-z-primary btn-z-sm btn-z-block">
                                        <i class="bi bi-geo-alt-fill"></i> {{ __('front.pos_map_btn') }}
                                    </a>
                                @else
                                    <span class="btn-z btn-z-outline btn-z-sm btn-z-block" style="cursor:default;opacity:.6">
                                        <i class="bi bi-telephone"></i> {{ $item->phone }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($items->hasPages())
                    @php $isRtl = app()->getLocale() === 'ar'; @endphp
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
