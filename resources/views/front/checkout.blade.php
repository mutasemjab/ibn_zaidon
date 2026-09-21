@extends('front.layouts.app')
@section('title', __('front.checkout_pay'))

@section('content')
@php
    $cur        = __('front.currency');
    $cartTotal  = number_format(collect($courses)->sum('price'), 2);
    $cliqAlias  = \App\Models\SiteSetting::raw('cliq_alias');
@endphp

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <a href="{{ route('cart.index') }}">{{ __('front.shopping_cart') }}</a>
            <span class="sep">/</span>
            <span>{{ __('front.checkout_pay') }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,1.9rem);margin:0">
            <i class="bi bi-credit-card-fill me-2"></i>{{ __('front.checkout_pay') }}
        </h1>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5 justify-content-center">

        {{-- Payment Form --}}
        <div class="col-lg-7">
            <div class="contact-card">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.5rem">
                    <i class="bi bi-wallet2 me-2"></i>{{ __('front.checkout_choose_method') }}
                </h5>

                {{-- Activation Error --}}
                @if(session('activation_error'))
                <div class="z-flash flash-error"><i class="bi bi-exclamation-circle-fill fs-5"></i><span>{{ session('activation_error') }}</span></div>
                @endif

                {{-- Payment Tabs --}}
                <div class="pay-tabs">
                    <button class="pay-tab active" data-target="pay-cash">
                        <i class="bi bi-cash-stack me-1"></i>{{ __('front.pay_tab_cash') }}
                    </button>
                    <button class="pay-tab" data-target="pay-cliq">
                        <i class="bi bi-phone me-1"></i>{{ __('front.pay_cliq') }}
                    </button>
                    <button class="pay-tab" data-target="pay-card">
                        <i class="bi bi-credit-card-2-front me-1"></i>{{ __('front.pay_tab_card') }}
                    </button>
                </div>

                {{-- Cash Panel --}}
                <div class="pay-panel active" id="pay-cash">
                    <div style="background:var(--z-section-bg);border-radius:var(--z-radius);padding:1.5rem;text-align:center;margin-bottom:1.25rem">
                        <div style="font-size:2.5rem;margin-bottom:.75rem">💵</div>
                        <h6 style="color:var(--z-primary);font-weight:700">{{ __('front.pay_cash_title') }}</h6>
                        <p style="color:var(--z-text-muted);font-size:.88rem;max-width:380px;margin:.5rem auto 0">
                            {{ __('front.pay_cash_desc') }}
                        </p>
                    </div>
                    <a href="{{ route('home') }}#contact" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-pin-map-fill"></i> {{ __('front.pay_cash_btn') }}
                    </a>
                </div>

                {{-- CliQ Panel --}}
                <div class="pay-panel" id="pay-cliq">
                    <div class="cliq-box mb-4">
                        <div style="font-size:.85rem;color:var(--z-text-muted);margin-bottom:.5rem">{{ __('front.pay_cliq_id') }}</div>
                        @if($cliqAlias)
                        <div class="cliq-alias">{{ $cliqAlias }}</div>
                        @endif
                        <div class="cliq-qr"><i class="bi bi-qr-code" style="font-size:2.5rem;opacity:.4"></i></div>
                        <p style="font-size:.82rem;color:var(--z-text-muted);margin:0">
                            {{ __('front.pay_cliq_steps') }}<br>
                            {{ __('front.amount') }}: <strong style="color:var(--z-primary)">{{ $cartTotal }} {{ $cur }}</strong>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="z-label">{{ __('front.pay_cliq_ref_label') }} <span class="text-danger">*</span></label>
                        <input type="text" class="z-input" placeholder="{{ __('front.pay_cliq_ref_ph') }}" dir="ltr">
                        <span style="font-size:.8rem;color:var(--z-text-muted);margin-top:.35rem;display:block">
                            {{ __('front.pay_cliq_ref_hint') }}
                        </span>
                    </div>
                    <p style="font-size:.82rem;color:var(--z-text-muted);background:rgba(245,166,35,.07);border:1px solid rgba(245,166,35,.2);border-radius:8px;padding:.75rem">
                        <i class="bi bi-info-circle-fill me-1" style="color:var(--z-highlight)"></i>
                        {{ __('front.pay_cliq_note') }}
                    </p>
                    <button type="button" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-send-fill"></i> {{ __('front.pay_cliq_btn') }}
                    </button>
                </div>

                {{-- Card Code Panel --}}
                <div class="pay-panel" id="pay-card">
                    <form method="POST" action="{{ route('cart.activate') }}">
                        @csrf
                        <div style="text-align:center;margin-bottom:1.5rem">
                            <div style="font-size:3rem;margin-bottom:.75rem">🎫</div>
                            <h6 style="color:var(--z-primary);font-weight:700">{{ __('front.pay_card_title') }}</h6>
                            <p style="color:var(--z-text-muted);font-size:.87rem;max-width:360px;margin:.35rem auto 0">
                                {{ __('front.pay_card_desc') }}
                            </p>
                        </div>

                        @error('card_number')
                        <div class="z-flash flash-error mb-3">
                            <i class="bi bi-exclamation-circle-fill"></i><span>{{ $message }}</span>
                        </div>
                        @enderror

                        <div class="mb-4">
                            <label class="z-label">{{ __('front.pay_card_label') }} <span class="text-danger">*</span></label>
                            <input type="text" name="card_number"
                                   class="z-input code-input {{ $errors->has('card_number') ? 'is-invalid' : '' }}"
                                   placeholder="XXXX-XXXX-XXXX-XXXX"
                                   value="{{ old('card_number') }}"
                                   autocomplete="off" dir="ltr" required>
                            @error('card_number')<span class="z-error">{{ $message }}</span>@enderror
                            <span style="font-size:.8rem;color:var(--z-text-muted);margin-top:.35rem;display:block">
                                <i class="bi bi-info-circle me-1"></i>
                                {{ __('front.pay_card_hint') }}
                            </span>
                        </div>

                        <button type="submit" class="btn-z btn-z-success btn-z-lg btn-z-block">
                            <i class="bi bi-key-fill"></i> {{ __('front.pay_card_btn') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-5">
            <div class="cart-summary">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">{{ __('front.order_summary') }}</h5>

                @foreach($courses as $course)
                <div style="display:flex;align-items:center;gap:.75rem;padding:.6rem 0;border-bottom:1px solid var(--z-border)">
                    <div style="width:40px;height:30px;background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:6px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi bi-play-fill" style="color:rgba(255,255,255,.5);font-size:.7rem"></i>
                    </div>
                    <span style="flex:1;font-size:.87rem;font-weight:600">{{ Str::limit($course->title, 35) }}</span>
                    <span style="font-weight:700;color:var(--z-primary);font-size:.9rem;white-space:nowrap">
                        {{ ($course->price??0)>0 ? number_format($course->price,2).' '.$cur : __('front.courses_free') }}
                    </span>
                </div>
                @endforeach

                <div class="sum-row mt-2"><span>{{ __('front.subtotal') }}</span><span>{{ $cartTotal }} {{ $cur }}</span></div>
                <div class="sum-row sum-total"><span>{{ __('front.total') }}</span><span>{{ $cartTotal }} {{ $cur }}</span></div>

                <div class="mt-3 d-flex align-items-center gap-2" style="font-size:.8rem;color:var(--z-text-muted)">
                    <i class="bi bi-shield-fill-check" style="color:var(--z-success)"></i>
                    {{ __('front.pay_secure_note') }}
                </div>
                <div class="mt-2 d-flex align-items-center gap-2" style="font-size:.8rem;color:var(--z-text-muted)">
                    <i class="bi bi-infinity" style="color:var(--z-accent)"></i>
                    {{ __('front.pay_unlimited_note') }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
