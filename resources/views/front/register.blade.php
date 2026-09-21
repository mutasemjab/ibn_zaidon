@extends('front.layouts.app')
@section('title', 'إنشاء حساب — ابن زيدون')

@section('content')
<div class="auth-wrap">
    <div class="auth-card" style="max-width:520px">
        <div class="auth-logo">
            <a href="{{ route('home') }}" style="text-decoration:none">
                <div style="width:56px;height:56px;background:var(--z-primary);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto .75rem;font-size:1.5rem;font-weight:900;color:#fff">ز</div>
                <h2>إنشاء حساب جديد</h2>
            </a>
            <p>انضم إلى آلاف الطلاب في أكاديمية ابن زيدون التعليمية</p>
        </div>

        @if($errors->any())
        <div class="z-flash flash-error mb-4">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>يرجى مراجعة الأخطاء أدناه</span>
        </div>
        @endif

        <form method="POST" action="{{ route('student.register.post') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label class="z-label">الاسم الكامل <span class="text-danger">*</span></label>
                <input type="text" name="name"
                       class="z-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       value="{{ old('name') }}" placeholder="محمد أحمد" required>
                @error('name')<span class="z-error">{{ $message }}</span>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="z-label">رقم الهاتف <span class="text-danger">*</span></label>
                    <input type="tel" name="phone"
                           class="z-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                           value="{{ old('phone') }}" placeholder="07X XXX XXXX" dir="ltr" required>
                    @error('phone')<span class="z-error">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label class="z-label">الرقم الوطني</label>
                    <input type="text" name="national_id"
                           class="z-input {{ $errors->has('national_id') ? 'is-invalid' : '' }}"
                           value="{{ old('national_id') }}" placeholder="XXXXXXXXXX" dir="ltr">
                    @error('national_id')<span class="z-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="z-label">البريد الإلكتروني</label>
                <input type="email" name="email"
                       class="z-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ old('email') }}" placeholder="example@email.com" dir="ltr">
                @error('email')<span class="z-error">{{ $message }}</span>@enderror
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="z-label">كلمة المرور <span class="text-danger">*</span></label>
                    <input type="password" name="password"
                           class="z-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="8 أحرف على الأقل" dir="ltr" required>
                    @error('password')<span class="z-error">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-6">
                    <label class="z-label">تأكيد كلمة المرور <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation"
                           class="z-input"
                           placeholder="أعد كتابة كلمة المرور" dir="ltr" required>
                </div>
            </div>

            <div class="d-flex align-items-start gap-2 mb-4">
                <input type="checkbox" name="terms" id="terms"
                       class="form-check-input mt-1 {{ $errors->has('terms') ? 'is-invalid' : '' }}"
                       style="width:18px;height:18px;flex-shrink:0" required>
                <label for="terms" style="font-size:.86rem;color:var(--z-text-muted);cursor:pointer;line-height:1.5">
                    أوافق على
                    <a href="#" style="color:var(--z-accent)">الشروط والأحكام</a>
                    و
                    <a href="#" style="color:var(--z-accent)">سياسة الخصوصية</a>
                    لأكاديمية ابن زيدون التعليمية
                </label>
                @error('terms')<span class="z-error w-100">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="btn-z btn-z-primary btn-z-lg btn-z-block">
                <i class="bi bi-person-check-fill"></i>
                إنشاء الحساب
            </button>
        </form>

        <div class="divider-text mt-4"><span>لديك حساب بالفعل؟</span></div>

        <a href="{{ route('student.login') }}" class="btn-z btn-z-outline btn-z-block">
            <i class="bi bi-box-arrow-in-right"></i>
            تسجيل الدخول
        </a>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}" style="font-size:.85rem;color:var(--z-text-muted)">
                <i class="bi bi-arrow-right me-1"></i>العودة للرئيسية
            </a>
        </div>
    </div>
</div>
@endsection
