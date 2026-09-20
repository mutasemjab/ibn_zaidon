@php $dir = app()->getLocale() === 'ar' ? 'rtl' : 'ltr'; @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'زيدون للتعليم') — منصة تعليمية متكاملة</title>
    <meta name="description" content="@yield('meta_desc', 'منصة زيدون التعليمية — دورات، امتحانات، وأوراق عمل للمرحلة الأساسية والتوجيهي')">

    {{-- Bootstrap 5.3 RTL/LTR --}}
    @if($dir === 'rtl')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Brand CSS --}}
    <link href="{{ asset('assets_front/css/style.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

{{-- Navbar --}}
@include('front.partials.navbar')

{{-- Flash Messages --}}
@if(session('activation_success'))
    <div class="container pt-3">
        <div class="z-flash flash-success">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span>{{ session('activation_success') }}</span>
        </div>
    </div>
@endif
@if(session('activation_error'))
    <div class="container pt-3">
        <div class="z-flash flash-error">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>{{ session('activation_error') }}</span>
        </div>
    </div>
@endif
@if(session('cart_added'))
    <div class="container pt-3">
        <div class="z-flash flash-info">
            <i class="bi bi-cart-check-fill fs-5"></i>
            <span>تمت إضافة "{{ session('cart_added') }}" إلى سلة التسوق.</span>
        </div>
    </div>
@endif
@if(session('register_success'))
    <div class="container pt-3">
        <div class="z-flash flash-success">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span>{{ session('register_success') }}</span>
        </div>
    </div>
@endif
@if(session('contact_success'))
    <div class="container pt-3">
        <div class="z-flash flash-success">
            <i class="bi bi-envelope-check-fill fs-5"></i>
            <span>تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.</span>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="container pt-3">
        <div class="z-flash flash-error">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

{{-- Main Content --}}
@yield('content')

{{-- Footer --}}
@include('front.partials.footer')

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- Brand JS --}}
<script src="{{ asset('assets_front/js/app.js') }}"></script>

@stack('scripts')
</body>
</html>
