@extends('front.layouts.app')
@section('title', __('front.shopping_cart'))

@section('content')
@php $isRtl = app()->getLocale() === 'ar'; @endphp

<div style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <span>{{ __('front.shopping_cart') }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,1.9rem);margin:0">
            <i class="bi bi-cart3 me-2"></i>{{ __('front.shopping_cart') }}
        </h1>
    </div>
</div>

<div class="container py-5">

    @if(session('cart_removed'))
    <div class="z-flash flash-info"><i class="bi bi-info-circle-fill fs-5"></i><span>{{ __('front.cart_removed_msg') }}</span></div>
    @endif

    @if(empty($items))
    {{-- Empty Cart --}}
    <div class="text-center py-5">
        <div style="font-size:5rem;color:var(--z-border);margin-bottom:1.5rem">🛒</div>
        <h4 style="color:var(--z-primary);font-weight:700">{{ __('front.cart_empty_title') }}</h4>
        <p style="color:var(--z-text-muted);max-width:360px;margin:.75rem auto 1.75rem">{{ __('front.cart_empty_desc') }}</p>
        <a href="{{ route('courses.index') }}" class="btn-z btn-z-primary btn-z-lg">
            <i class="bi bi-search"></i> {{ __('front.browse_courses') }}
        </a>
    </div>
    @else
    <div class="row g-4">

        {{-- Cart Items --}}
        <div class="col-lg-8">
            <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">
                {{ trans_choice('front.cart_items', count($items), ['count' => count($items)]) }}
            </h5>

            @foreach($items as $item)
            @if($item['type'] === 'package')
            {{-- Package line: one bundled row, priced once --}}
            <div class="cart-item" style="align-items:flex-start;border-color:var(--z-accent);background:rgba(123,47,247,.03)">
                <div class="cart-thumb" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--z-accent),var(--z-primary));border-radius:8px">
                    <i class="bi bi-boxes" style="color:rgba(255,255,255,.6);font-size:1.5rem"></i>
                </div>
                <div style="flex:1;min-width:0">
                    <div class="cart-title">
                        <span class="pill" style="background:rgba(123,47,247,.1);color:var(--z-accent);font-size:.68rem;padding:.1rem .5rem;border-radius:50px;margin-inline-end:.4rem">{{ __('front.packages_breadcrumb') }}</span>
                        {{ $item['package']->title }}
                    </div>
                    <div class="cart-sub">
                        {{ $item['courses']->pluck('title')->implode(' · ') }}
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="cart-price">{{ number_format($item['price'], 2) }} {{ __('front.currency') }}</span>
                    <form method="POST" action="{{ route('cart.remove-package', $item['package']->id) }}">
                        @csrf
                        <button type="submit" class="btn-rm" title="{{ __('front.cart_package_remove') }}">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="cart-item">
                <div class="cart-thumb" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:8px">
                    <i class="bi bi-play-circle" style="color:rgba(255,255,255,.4);font-size:1.5rem"></i>
                </div>
                <div style="flex:1;min-width:0">
                    <div class="cart-title">{{ $item['course']->title }}</div>
                    <div class="cart-sub">
                        <i class="bi bi-person-fill me-1"></i>{{ $item['course']->teacher->name ?? __('front.teacher_fallback') }}
                        @if($item['course']->category)
                        &nbsp;·&nbsp;<i class="bi bi-tag me-1"></i>{{ $item['course']->category->name }}
                        @endif
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="cart-price">
                        {{ $item['price'] > 0 ? number_format($item['price'],2).' '.__('front.currency') : __('front.courses_free') }}
                    </span>
                    <form method="POST" action="{{ route('cart.remove', $item['course']->id) }}">
                        @csrf
                        <button type="submit" class="btn-rm" title="{{ __('front.cart_remove') }}">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        {{-- Summary --}}
        <div class="col-lg-4">
            <div class="cart-summary">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">{{ __('front.order_summary') }}</h5>
                <div class="sum-row"><span>{{ __('front.subtotal') }}</span><span>{{ number_format($subtotal, 2) }} {{ __('front.currency') }}</span></div>
                @if($discount > 0)
                <div class="sum-row" style="color:var(--z-success)"><span>{{ __('front.discount') }}</span><span>- {{ number_format($discount, 2) }} {{ __('front.currency') }}</span></div>
                @endif
                <div class="sum-row sum-total"><span>{{ __('front.total') }}</span><span>{{ number_format($total, 2) }} {{ __('front.currency') }}</span></div>
                <div class="mt-4">
                    @auth('student')
                    <a href="{{ route('cart.checkout') }}" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                        <i class="bi bi-credit-card-fill"></i> {{ __('front.checkout_pay') }}
                    </a>
                    @else
                    <a href="{{ route('student.login') }}" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                        <i class="bi bi-person-fill"></i> {{ __('front.cart_login_continue') }}
                    </a>
                    @endauth
                    <a href="{{ route('courses.index') }}" class="btn-z btn-z-outline btn-z-block mt-2">
                        <i class="bi bi-arrow-{{ $isRtl ? 'right' : 'left' }}"></i> {{ __('front.continue_shopping') }}
                    </a>
                </div>
                <div class="mt-3 text-center" style="font-size:.8rem;color:var(--z-text-muted)">
                    <i class="bi bi-shield-check-fill me-1" style="color:var(--z-success)"></i>
                    {{ __('front.cart_secure_note') }}
                </div>
            </div>
        </div>

    </div>
    @endif
</div>
@endsection
