@extends('front.layouts.app')
@section('title', __('front.packages_page_title'))

@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <span>{{ __('front.packages_breadcrumb') }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2rem);margin:0">
            <i class="bi bi-boxes me-2"></i>{{ __('front.packages_page_title') }}
        </h1>
        <p style="color:rgba(255,255,255,.7);margin:.5rem 0 0;font-size:.95rem">
            {{ __('front.packages_page_desc') }}
        </p>
    </div>
</div>

<div class="container py-5">

    @if(session('cart_added'))
    <div class="z-flash flash-info mb-4"><i class="bi bi-cart-check-fill fs-5"></i><span>{{ __('front.flash_cart_added', ['name' => session('cart_added')]) }}</span></div>
    @endif
    @if(session('error'))
    <div class="z-flash flash-error mb-4"><i class="bi bi-exclamation-circle-fill fs-5"></i><span>{{ session('error') }}</span></div>
    @endif

    @if($packages->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-boxes" style="font-size:4rem;color:var(--z-border)"></i>
        <h5 style="color:var(--z-text-muted);margin-top:1rem">{{ __('front.packages_no_packages') }}</h5>
    </div>
    @else
    <div class="row g-4">
        @foreach($packages as $package)
        @php
            $pct = $package->discount_percentage;
        @endphp
        <div class="col-md-6 col-lg-4">
            <div class="course-card h-100 d-flex flex-column">
                <div class="course-thumb-ph">
                    @if($package->image)
                        <img src="{{ asset('assets/uploads/packages/'.$package->image) }}" alt="" style="width:100%;height:100%;object-fit:cover">
                    @else
                        <i class="bi bi-boxes"></i>
                    @endif
                </div>
                <div class="course-body flex-grow-1">
                    <div class="course-tags">
                        @if($package->is_featured)
                            <span class="tag tag-popular">{{ __('front.packages_featured') }}</span>
                        @endif
                        @if($pct > 0)
                            <span class="tag" style="background:rgba(40,167,69,.12);color:var(--z-success)">{{ __('front.packages_save', ['pct' => $pct]) }}</span>
                        @endif
                    </div>
                    <div class="course-title">{{ $package->title }}</div>
                    @if($package->description)
                        <p style="font-size:.85rem;color:var(--z-text-muted);margin-top:.4rem">{{ Str::limit($package->description, 90) }}</p>
                    @endif
                    <div style="font-size:.82rem;color:var(--z-primary);font-weight:600;margin-top:.5rem">
                        <i class="bi bi-check2-square me-1"></i>
                        {{ __('front.packages_pick_count', ['count' => $package->pick_count]) }}
                        <span style="color:var(--z-text-muted);font-weight:400">
                            ({{ __('front.packages_courses_count', ['count' => $package->courses_count]) }})
                        </span>
                    </div>
                </div>
                <div class="course-foot">
                    <span class="price-tag">
                        {{ number_format($package->price, 2) }} {{ __('front.currency') }}
                        @if($package->old_price)
                            <span style="text-decoration:line-through;color:var(--z-text-muted);font-size:.78rem;font-weight:400">
                                {{ number_format($package->old_price, 2) }}
                            </span>
                        @endif
                    </span>
                </div>
                <div class="px-3 pb-3">
                    <a href="{{ route('packages.show', $package->id) }}" class="btn-z btn-z-primary btn-z-sm btn-z-block">
                        <i class="bi bi-eye"></i> {{ __('front.packages_view_btn') }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Custom bundle CTA --}}
    <div class="mt-5 p-4 text-center" style="background:var(--z-section-bg);border-radius:var(--z-radius-lg)">
        <h5 style="color:var(--z-primary);font-weight:700">{{ __('front.packages_custom_title') }}</h5>
        <p style="color:var(--z-text-muted);font-size:.9rem;max-width:480px;margin:.5rem auto 1.25rem">{{ __('front.packages_custom_desc') }}</p>
        <a href="{{ route('home') }}#contact" class="btn-z btn-z-outline">
            <i class="bi bi-chat-dots"></i> {{ __('front.packages_custom_cta') }}
        </a>
    </div>

</div>
@endsection
