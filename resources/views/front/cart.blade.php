@extends('front.layouts.app')
@section('title', 'سلة التسوق — ابن زيدون')

@section('content')

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">الرئيسية</a>
            <span class="sep">/</span>
            <span>سلة التسوق</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,1.9rem);margin:0">
            <i class="bi bi-cart3 me-2"></i>سلة التسوق
        </h1>
    </div>
</div>

<div class="container py-5">

    @if(session('cart_removed'))
    <div class="z-flash flash-info"><i class="bi bi-info-circle-fill fs-5"></i><span>تمت إزالة الدورة من السلة.</span></div>
    @endif

    @if($courses->isEmpty())
    {{-- Empty Cart --}}
    <div class="text-center py-5">
        <div style="font-size:5rem;color:var(--z-border);margin-bottom:1.5rem">🛒</div>
        <h4 style="color:var(--z-primary);font-weight:700">سلتك فارغة!</h4>
        <p style="color:var(--z-text-muted);max-width:360px;margin:.75rem auto 1.75rem">لم تقم بإضافة أي دورة بعد. تصفّح الدورات المتاحة وأضف ما يناسبك.</p>
        <a href="{{ route('courses.index') }}" class="btn-z btn-z-primary btn-z-lg">
            <i class="bi bi-search"></i> تصفّح الدورات
        </a>
    </div>
    @else
    <div class="row g-4">

        {{-- Cart Items --}}
        <div class="col-lg-8">
            <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">
                {{ $courses->count() }} {{ $courses->count() == 1 ? 'دورة' : 'دورات' }} في السلة
            </h5>

            @foreach($courses as $course)
            <div class="cart-item">
                <div class="cart-thumb" style="display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:8px">
                    <i class="bi bi-play-circle" style="color:rgba(255,255,255,.4);font-size:1.5rem"></i>
                </div>
                <div style="flex:1;min-width:0">
                    <div class="cart-title">{{ $course->title_ar ?? $course->title }}</div>
                    <div class="cart-sub">
                        <i class="bi bi-person-fill me-1"></i>{{ $course->teacher->name ?? 'معلم ابن زيدون' }}
                        @if($course->category)
                        &nbsp;·&nbsp;<i class="bi bi-tag me-1"></i>{{ $course->category->name_ar ?? $course->category->name }}
                        @endif
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="cart-price">
                        {{ ($course->price??0)>0 ? number_format($course->price,2).' د.أ' : 'مجاني' }}
                    </span>
                    <form method="POST" action="{{ route('cart.remove', $course->id) }}">
                        @csrf
                        <button type="submit" class="btn-rm" title="إزالة من السلة">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Summary --}}
        <div class="col-lg-4">
            <div class="cart-summary">
                <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">ملخص الطلب</h5>
                <div class="sum-row"><span>المجموع الفرعي</span><span>{{ number_format($subtotal, 2) }} د.أ</span></div>
                @if($discount > 0)
                <div class="sum-row" style="color:var(--z-success)"><span>الخصم</span><span>- {{ number_format($discount, 2) }} د.أ</span></div>
                @endif
                <div class="sum-row sum-total"><span>الإجمالي</span><span>{{ number_format($total, 2) }} د.أ</span></div>
                <div class="mt-4">
                    @auth('student')
                    <a href="{{ route('cart.checkout') }}" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                        <i class="bi bi-credit-card-fill"></i> إتمام الدفع
                    </a>
                    @else
                    <a href="{{ route('student.login') }}" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                        <i class="bi bi-person-fill"></i> سجّل دخولك للمتابعة
                    </a>
                    @endauth
                    <a href="{{ route('courses.index') }}" class="btn-z btn-z-outline btn-z-block mt-2">
                        <i class="bi bi-arrow-right"></i> متابعة التسوق
                    </a>
                </div>
                <div class="mt-3 text-center" style="font-size:.8rem;color:var(--z-text-muted)">
                    <i class="bi bi-shield-check-fill me-1" style="color:var(--z-success)"></i>
                    دفع آمن ومشفّر بالكامل
                </div>
            </div>
        </div>

    </div>
    @endif
</div>
@endsection
