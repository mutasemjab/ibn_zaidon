@extends('front.layouts.app')
@section('title', $exam->title)

@section('content')
@php
    $isRtl         = app()->getLocale() === 'ar';
    $questionCount = $exam->questions()->count();
@endphp

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-3">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <a href="{{ route('exams.index') }}">{{ __('front.nav_exams') }}</a>
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
                    @if($questionCount)
                    <div class="col-4">
                        <div style="background:rgba(11,61,145,.06);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-primary)">{{ $questionCount }}</div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)">{{ __('front.questions') }}</div>
                        </div>
                    </div>
                    @endif
                    @if($exam->duration_minutes)
                    <div class="col-4">
                        <div style="background:rgba(245,166,35,.08);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-highlight)">{{ $exam->duration_minutes }}</div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)">{{ __('front.exams_minutes') }}</div>
                        </div>
                    </div>
                    @endif
                    @if($exam->average_success_rate)
                    <div class="col-4">
                        <div style="background:rgba(40,167,69,.06);border-radius:var(--z-radius);padding:1rem">
                            <div style="font-size:1.6rem;font-weight:800;color:var(--z-success)">{{ $exam->average_success_rate }}%</div>
                            <div style="font-size:.8rem;color:var(--z-text-muted)">{{ __('front.exam_avg_success') }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mb-4">
                    @if($exam->subject)
                    <div class="d-flex align-items-center gap-2 mb-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-book-fill" style="color:var(--z-primary)"></i>
                        <span>{{ __('front.exam_subject_label') }} <strong style="color:var(--z-text)">{{ $exam->subject->name }}</strong></span>
                    </div>
                    @endif
                    @if($exam->academic_year)
                    <div class="d-flex align-items-center gap-2 mb-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-calendar3" style="color:var(--z-primary)"></i>
                        <span>{{ __('front.exam_year_label') }} <strong style="color:var(--z-text)">{{ $exam->academic_year }}</strong></span>
                    </div>
                    @endif
                    @if($exam->pass_marks)
                    <div class="d-flex align-items-center gap-2" style="font-size:.9rem;color:var(--z-text-muted)">
                        <i class="bi bi-check-circle-fill" style="color:var(--z-success)"></i>
                        <span>{{ __('front.exam_pass_marks') }} <strong style="color:var(--z-text)">{{ $exam->pass_marks }}</strong></span>
                    </div>
                    @endif
                </div>

                <div class="p-3 mb-4" style="background:rgba(245,166,35,.07);border:1px solid rgba(245,166,35,.2);border-radius:var(--z-radius)">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-info-circle-fill mt-1" style="color:var(--z-highlight);flex-shrink:0"></i>
                        <div style="font-size:.87rem;color:var(--z-text-muted)">
                            {{ __('front.exam_warning') }}
                            @if($exam->duration_minutes)
                                {!! __('front.exam_duration_note', ['minutes' => '<strong style="color:var(--z-primary)">'.e($exam->duration_minutes).'</strong>']) !!}
                            @endif
                        </div>
                    </div>
                </div>

                @auth('student')
                <a href="{{ route('exams.take', $exam->id) }}"
                   class="btn-z btn-z-primary btn-z-lg btn-z-block">
                    <i class="bi bi-play-circle-fill"></i>
                    {{ __('front.exam_start_now') }}
                </a>
                @else
                <div class="text-center">
                    <p style="color:var(--z-text-muted);font-size:.9rem;margin-bottom:1rem">
                        {{ __('front.exam_login_required') }}
                    </p>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="{{ route('student.login') }}" class="btn-z btn-z-primary btn-z-lg">
                            <i class="bi bi-box-arrow-in-right"></i> {{ __('front.auth_login_title') }}
                        </a>
                        <a href="{{ route('student.register') }}" class="btn-z btn-z-outline btn-z-lg">
                            <i class="bi bi-person-plus"></i> {{ __('front.auth_register_title') }}
                        </a>
                    </div>
                </div>
                @endauth
            </div>

            <div class="text-center">
                <a href="{{ route('exams.index') }}" style="color:var(--z-text-muted);font-size:.88rem">
                    <i class="bi bi-arrow-{{ $isRtl ? 'right' : 'left' }} me-1"></i> {{ __('front.exam_back_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
