@extends('front.layouts.app')
@section('title', __('front.auth_login_title'))

@section('content')
@php $siteName = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name'); @endphp
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-logo">
            <a href="{{ route('home') }}" style="text-decoration:none">
                <div style="width:56px;height:56px;background:var(--z-primary);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;font-size:1.5rem;font-weight:900;color:#fff">{{ mb_substr($siteName, 0, 1) }}</div>
                <h2>{{ $siteName }}</h2>
            </a>
            <p>{{ __('front.auth_login_subtitle') }}</p>
        </div>

        @if($errors->any())
        <div class="z-flash flash-error mb-4">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('student.login.post') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label class="z-label">{{ __('front.auth_phone_label') }}</label>
                <input type="tel" name="phone"
                       class="z-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                       value="{{ old('phone') }}"
                       placeholder="{{ __('front.auth_phone_ph') }}" required autofocus dir="ltr">
                @error('phone')<span class="z-error">{{ $message }}</span>@enderror
            </div>
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="z-label mb-0">{{ __('front.auth_password_label') }}</label>
                </div>
                <input type="password" name="password"
                       class="z-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="••••••••" required dir="ltr">
                @error('password')<span class="z-error">{{ $message }}</span>@enderror
            </div>
            <div class="d-flex align-items-center gap-2 mb-4">
                <input type="checkbox" name="remember" id="remember" class="form-check-input mt-0" style="width:18px;height:18px">
                <label for="remember" style="font-size:.88rem;color:var(--z-text-muted);cursor:pointer">{{ __('front.auth_remember') }}</label>
            </div>
            <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                <i class="bi bi-box-arrow-in-right"></i>
                {{ __('front.auth_login_title') }}
            </button>
        </form>

        <div class="divider-text mt-4">
            <span>{{ __('front.auth_no_account') }}</span>
        </div>

        <a href="{{ route('student.register') }}" class="btn-z btn-z-outline btn-z-block">
            <i class="bi bi-person-plus"></i>
            {{ __('front.auth_create_account') }}
        </a>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}" style="font-size:.85rem;color:var(--z-text-muted)">
                <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>{{ __('front.auth_back_home') }}
            </a>
        </div>
    </div>
</div>
@endsection
