@extends('front.layouts.app')
@section('title', __('front.auth_register_title'))

@section('content')
@php $siteName = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name'); @endphp
<div class="auth-wrap">
    <div class="auth-card" style="max-width:520px">
        <div class="auth-logo">
            <a href="{{ route('home') }}" style="text-decoration:none">
                <div style="width:56px;height:56px;background:var(--z-primary);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;font-size:1.5rem;font-weight:900;color:#fff">{{ mb_substr($siteName, 0, 1) }}</div>
                <h2>{{ __('front.auth_create_account') }}</h2>
            </a>
            <p>{{ __('front.auth_register_subtitle', ['site' => $siteName]) }}</p>
        </div>

        @if($errors->any())
        <div class="z-flash flash-error mb-4">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>{{ __('front.auth_form_errors') }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('student.register.post') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label class="z-label">{{ __('front.auth_full_name') }} <span class="text-danger">*</span></label>
                <input type="text" name="name"
                       class="z-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       value="{{ old('name') }}" placeholder="{{ __('front.auth_full_name_ph') }}" required>
                @error('name')<span class="z-error">{{ $message }}</span>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="z-label">{{ __('front.auth_phone_label') }} <span class="text-danger">*</span></label>
                    <input type="tel" name="phone"
                           class="z-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                           value="{{ old('phone') }}" placeholder="{{ __('front.auth_phone_ph') }}" dir="ltr" required>
                    @error('phone')<span class="z-error">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label class="z-label">{{ __('front.auth_national_id') }}</label>
                    <input type="text" name="national_id"
                           class="z-input {{ $errors->has('national_id') ? 'is-invalid' : '' }}"
                           value="{{ old('national_id') }}" placeholder="{{ __('front.auth_national_id_ph') }}" dir="ltr">
                    @error('national_id')<span class="z-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="z-label">{{ __('front.auth_email_label') }}</label>
                <input type="email" name="email"
                       class="z-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ old('email') }}" placeholder="example@email.com" dir="ltr">
                @error('email')<span class="z-error">{{ $message }}</span>@enderror
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="z-label">{{ __('front.auth_password_label') }} <span class="text-danger">*</span></label>
                    <input type="password" name="password"
                           class="z-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="{{ __('front.auth_password_ph') }}" dir="ltr" required>
                    @error('password')<span class="z-error">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label class="z-label">{{ __('front.auth_confirm_password') }} <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation"
                           class="z-input"
                           placeholder="{{ __('front.auth_confirm_ph') }}" dir="ltr" required>
                </div>
            </div>

            <div class="d-flex align-items-start gap-2 mb-4">
                <input type="checkbox" name="terms" id="terms"
                       class="form-check-input mt-1 {{ $errors->has('terms') ? 'is-invalid' : '' }}"
                       style="width:18px;height:18px;flex-shrink:0" required>
                <label for="terms" style="font-size:.86rem;color:var(--z-text-muted);cursor:pointer;line-height:1.5">
                    {{ __('front.auth_agree') }}
                    <a href="#" style="color:var(--z-accent)">{{ __('front.auth_terms_link') }}</a>
                    {{ __('front.auth_and') }}
                    <a href="#" style="color:var(--z-accent)">{{ __('front.auth_privacy_link') }}</a>
                    {{ __('front.auth_agree_suffix', ['site' => $siteName]) }}
                </label>
                @error('terms')<span class="z-error w-100">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                <i class="bi bi-person-check-fill"></i>
                {{ __('front.auth_register_btn') }}
            </button>
        </form>

        <div class="divider-text mt-4"><span>{{ __('front.auth_have_account') }}</span></div>

        <a href="{{ route('student.login') }}" class="btn-z btn-z-outline btn-z-block">
            <i class="bi bi-box-arrow-in-right"></i>
            {{ __('front.auth_sign_in_link') }}
        </a>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}" style="font-size:.85rem;color:var(--z-text-muted)">
                <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>{{ __('front.auth_back_home') }}
            </a>
        </div>
    </div>
</div>
@endsection
