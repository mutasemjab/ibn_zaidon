@extends('front.layouts.app')
@section('title', $exam->title.' — ابن زيدون')

@section('content')

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-3">
            <a href="{{ route('home') }}">الرئيسية</a>
            <span class="sep">/</span>
            <a href="{{ route('exams.index') }}">الامتحانات</a>
            <span class="sep">/</span>
            <span>{{ Str::limit($exam->title, 40) }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0">{{ $exam->title }}</h1>
        @if($exam->description)
        <p style="color:rgba(255,255,255,.72);margin:.6rem 0 0;font-size:.93rem;max-width:600px">
            {{ Str::limit($exam->description, 180) }}
        </p>
        @endif
    </div>
</div>

<div class="container py-5">
    <div class="row g-5 justify-content-center">
        <div class="col-lg-7">

            {{-- Exam Info Card --}}
            <div class="contact-card mb-4">
                <div class="row g-3 text-center mb-4">
                    @if($exam->questions()->count())
                    <div class="col-4">
                        <div style="background:rgba(11,61,145,.06);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-primary)">{{ $exam->questions()->count() }}</div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)">سؤال</div>
                        </div>
                    </div>
                    @endif
                    @if($exam->duration_minutes)
                    <div class="col-4">
                        <div style="background:rgba(245,166,35,.08);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-highlight)">{{ $exam->duration_minutes }}</div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)">دقيقة</div>
                        </div>
                    </div>
                    @endif
                    @if($exam->average_success_rate)
                    <div class="col-4">
                        <div style="background:rgba(40,167,69,.06);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-success)">{{ $exam->average_success_rate }}%</div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)">متوسط النجاح</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    @if($exam->subject)
                    <div class="d-flex align-items-center gap-2 mb-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-book-fill" style="color:var(--z-primary)"></i>
                        <span>المادة: <strong style="color:var(--z-text)">{{ $exam->subject->name_ar ?? $exam->subject->name }}</strong></span>
                    </div>
                    @endif
                    @if($exam->academic_year)
                    <div class="d-flex align-items-center gap-2 mb-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-calendar3" style="color:var(--z-primary)"></i>
                        <span>السنة الدراسية: <strong style="color:var(--z-text)">{{ $exam->academic_year }}</strong></span>
                    </div>
                    @endif
                    @if($exam->pass_marks)
                    <div class="d-flex align-items-center gap-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-check-circle-fill" style="color:var(--z-success)"></i>
                        <span>درجة النجاح: <strong style="color:var(--z-text)">{{ $exam->pass_marks }}</strong></span>
                    </div>
                    @endif
                </div>

                <div class="p-3 mb-4" style="background:rgba(245,166,35,.07);border:1px solid rgba(245,166,35,.2);border-radius:var(--z-radius)">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-info-circle-fill mt-1" style="color:var(--z-highlight);flex-shrink:0"></i>
                        <div style="font-size:.87rem;color:var(--z-text-muted)">
                            بمجرد بدء الامتحان لن تتمكن من إيقافه. تأكد من جاهزيتك وأن لديك وقتاً كافياً.
                            @if($exam->duration_minutes)
                                مدة الامتحان <strong style="color:var(--z-primary)">{{ $exam->duration_minutes }} دقيقة</strong>.
                            @endif
                        </div>
                    </div>
                </div>

                @auth('student')
                <a href="{{ route('exams.take', $exam->id) }}"
                   class="btn-z btn-z-primary btn-z-lg btn-z-block">
                    <i class="bi bi-play-circle-fill"></i>
                    ابدأ الامتحان الآن
                </a>
                @else
                <div class="text-center">
                    <p style="color:var(--z-text-muted);font-size:.9rem;margin-bottom:1rem">
                        يجب تسجيل الدخول لبدء الامتحان
                    </p>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="{{ route('student.login') }}" class="btn-z btn-z-primary btn-z-lg">
                            <i class="bi bi-box-arrow-in-right"></i> تسجيل الدخول
                        </a>
                        <a href="{{ route('student.register') }}" class="btn-z btn-z-outline btn-z-lg">
                            <i class="bi bi-person-plus"></i> إنشاء حساب
                        </a>
                    </div>
                </div>
                @endauth
            </div>

            <div class="text-center">
                <a href="{{ route('exams.index') }}" style="color:var(--z-text-muted);font-size:.88rem">
                    <i class="bi bi-arrow-right me-1"></i> العودة لقائمة الامتحانات
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
