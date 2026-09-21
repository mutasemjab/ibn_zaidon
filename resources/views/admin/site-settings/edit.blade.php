@extends('admin.layouts.app')
@section('title', __('messages.site_settings'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.site_settings') }}</h1>
        <p class="page-sub">{{ __('messages.site_settings_sub') }}</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif

@if($errors->any())
    <div class="alert alert-danger mb-3">{{ $errors->first() }}</div>
@endif

@php $loc = app()->getLocale(); @endphp


{{-- App Store price visibility toggle --}}
{{-- Website mode toggle --}}
@php
    $wm          = \App\Models\SiteSetting::raw('website_mode');
    $websiteMode = ($wm === '0') ? '0' : '1';
    $showPrice   = \App\Models\SiteSetting::raw('show_price') ?: '1';
@endphp
<div class="panel-card mb-4">
    <div class="panel-card-header">
        <h2 class="panel-card-title"><i class="bi bi-globe2 me-2"></i>وضع الموقع الإلكتروني</h2>
    </div>
    <div class="panel-card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="fw-semibold">تشغيل / إيقاف الموقع للزوار</div>
                <small class="text-muted">عند الإيقاف، يُعرض للزوار صفحة Landing Page فقط (بانر + من نحن + رابط App Store)</small>
            </div>
            <form action="{{ route('admin.site-settings.toggle-website') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-{{ $websiteMode === '1' ? 'success' : 'warning' }} d-flex align-items-center gap-2">
                    <i class="bi bi-{{ $websiteMode === '1' ? 'globe' : 'globe2' }}"></i>
                    {{ $websiteMode === '1' ? 'مفتوح — الموقع يعمل' : 'Landing Page فقط' }}
                </button>
            </form>
        </div>
    </div>
</div>

<div class="panel-card mb-4">
    <div class="panel-card-header">
        <h2 class="panel-card-title"><i class="bi bi-phone me-2"></i>إعدادات تطبيق الجوال</h2>
    </div>
    <div class="panel-card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="fw-semibold">إظهار / إخفاء السعر في App Store</div>
                <small class="text-muted">التطبيق سيُخفي أسعار الدورات عند إيقاف هذا الخيار</small>
            </div>
            <form action="{{ route('admin.site-settings.toggle-price') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-{{ $showPrice === '1' ? 'success' : 'secondary' }} d-flex align-items-center gap-2">
                    <i class="bi bi-{{ $showPrice === '1' ? 'eye' : 'eye-slash' }}"></i>
                    {{ $showPrice === '1' ? 'مفعّل — السعر ظاهر' : 'معطّل — السعر مخفي' }}
                </button>
            </form>
        </div>
    </div>
</div>

<form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    {{-- TABS NAV (generated from App\Support\SiteSettingsSchema) --}}
    <ul class="nav nav-tabs mb-4" id="settingsTabs">
        @foreach($tabs as $tabKey => $tab)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-{{ $tabKey }}">
                    <i class="bi {{ $tab['icon'] }}"></i> {{ $tab['title'][$loc] ?? $tab['title']['en'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach($tabs as $tabKey => $tab)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $tabKey }}">
                @foreach($tab['sections'] as $section)
                    <div class="panel-card mb-3">
                        <div class="panel-card-header">
                            <h2 class="panel-card-title">{{ $section['title'][$loc] ?? $section['title']['en'] }}</h2>
                        </div>
                        <div class="panel-card-body">
                            <div class="row g-3">
                                @foreach($section['fields'] as $f)
                                    @include('admin.site-settings._field', ['f' => $f, 'settings' => $settings, 'loc' => $loc])
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>{{-- end tab-content --}}

    <div class="mt-4">
        <button type="submit" class="btn-primary-sm" style="padding:12px 32px">
            <i class="bi bi-save"></i> {{ __('messages.save_changes') }}
        </button>
    </div>
</form>

@endsection
