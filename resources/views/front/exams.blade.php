@extends('front.layouts.app')
@section('title', __('front.nav_exams'))

@section('content')
@php
    $isRtl    = app()->getLocale() === 'ar';
    $prevIcon = $isRtl ? 'chevron-right' : 'chevron-left';
    $nextIcon = $isRtl ? 'chevron-left'  : 'chevron-right';
@endphp

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <span>{{ __('front.nav_exams') }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.5rem,3vw,2rem);margin:0">
            <i class="bi bi-clipboard-check-fill me-2"></i>{{ __('front.exams_page_header') }}
        </h1>
        <p style="color:rgba(255,255,255,.7);margin:.5rem 0 0;font-size:.95rem">
            {{ __('front.exams_page_sub') }}
        </p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">

        {{-- Exams Grid --}}
        <div class="col-lg-8">
            {{-- Type Filter --}}
            <div class="d-flex gap-2 flex-wrap mb-4">
                <a href="{{ route('exams.index') }}"
                   class="btn-z btn-z-sm {{ !request('type') ? 'btn-z-primary' : 'btn-z-outline' }}">
                    {{ __('front.courses_filter_all_tag') }}
                </a>
                <a href="{{ route('exams.index', ['type'=>'practice']) }}"
                   class="btn-z btn-z-sm {{ request('type')==='practice' ? 'btn-z-primary' : 'btn-z-outline' }}">
                    <i class="bi bi-pencil-square"></i> {{ __('front.exams_filter_practice') }}
                </a>
                <a href="{{ route('exams.index', ['type'=>'previous_years']) }}"
                   class="btn-z btn-z-sm {{ request('type')==='previous_years' ? 'btn-z-primary' : 'btn-z-outline' }}">
                    <i class="bi bi-calendar-check"></i> {{ __('front.exam_type_previous') }}
                </a>
                <a href="{{ route('exams.index', ['type'=>'question_bank']) }}"
                   class="btn-z btn-z-sm {{ request('type')==='question_bank' ? 'btn-z-primary' : 'btn-z-outline' }}">
                    <i class="bi bi-database-check"></i> {{ __('front.exam_type_bank') }}
                </a>
            </div>

            <div class="row g-4">
                @forelse($exams as $exam)
                <div class="col-md-6">
                    <div class="exam-card">
                        @php
                            $typeMap = [
                                'practice'      => ['pill-practice', __('front.exam_type_practice')],
                                'previous_years'=> ['pill-prev',     __('front.exam_type_previous')],
                                'question_bank' => ['pill-bank',     __('front.exam_type_bank')],
                            ];
                            [$pillClass, $pillLabel] = $typeMap[$exam->exam_type ?? ''] ?? ['pill-practice', __('front.exam_label')];
                        @endphp
                        <span class="exam-pill {{ $pillClass }}">{{ $pillLabel }}</span>
                        <h5 style="font-size:.97rem;font-weight:700;color:var(--z-text);margin-bottom:.5rem">
                            {{ $exam->title }}
                        </h5>
                        @if($exam->academic_year)
                        <div style="font-size:.8rem;color:var(--z-text-muted);margin-bottom:.5rem">
                            <i class="bi bi-calendar3 me-1"></i>{{ __('front.exam_generation', ['year' => $exam->academic_year]) }}
                        </div>
                        @endif
                        <div class="d-flex flex-wrap gap-2 mt-auto">
                            @if($exam->questions_count ?? null)
                            <span style="font-size:.78rem;color:var(--z-text-muted)">
                                <i class="bi bi-question-circle me-1"></i>{{ $exam->questions_count }} {{ __('front.questions') }}
                            </span>
                            @endif
                            @if($exam->duration_minutes)
                            <span style="font-size:.78rem;color:var(--z-text-muted)">
                                <i class="bi bi-clock me-1"></i>{{ $exam->duration_minutes }} {{ __('front.exams_minutes') }}
                            </span>
                            @endif
                            <span style="font-size:.78rem;color:var(--z-text-muted)">
                                <i class="bi bi-people me-1"></i>{{ number_format($exam->total_attempts ?? 0) }}
                            </span>
                        </div>
                        <a href="{{ route('exams.show', $exam->id) }}"
                           class="btn-z btn-z-primary btn-z-sm btn-z-block mt-3">
                            <i class="bi bi-eye"></i> {{ __('front.exams_view_btn') }}
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-clipboard-x" style="font-size:4rem;color:var(--z-border)"></i>
                    <h5 style="color:var(--z-text-muted);margin-top:1rem">{{ __('front.exams_no_exams') }}</h5>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($exams->hasPages())
            <nav class="z-pagination mt-4">
                @if($exams->onFirstPage())
                    <span class="z-page-link disabled"><i class="bi bi-{{ $prevIcon }}"></i></span>
                @else
                    <a href="{{ $exams->previousPageUrl() }}" class="z-page-link"><i class="bi bi-{{ $prevIcon }}"></i></a>
                @endif
                @foreach($exams->getUrlRange(max(1,$exams->currentPage()-2), min($exams->lastPage(),$exams->currentPage()+2)) as $page => $url)
                    <a href="{{ $url }}" class="z-page-link {{ $page==$exams->currentPage()?'current':'' }}">{{ $page }}</a>
                @endforeach
                @if($exams->hasMorePages())
                    <a href="{{ $exams->nextPageUrl() }}" class="z-page-link"><i class="bi bi-{{ $nextIcon }}"></i></a>
                @else
                    <span class="z-page-link disabled"><i class="bi bi-{{ $nextIcon }}"></i></span>
                @endif
            </nav>
            @endif
        </div>

        {{-- Leaderboard Sidebar --}}
        <div class="col-lg-4">
            <div class="lb-card">
                <div class="lb-head">
                    <i class="bi bi-trophy-fill text-warning fs-5"></i>
                    <h5>{{ __('front.exams_week_champions') }}</h5>
                </div>
                @forelse($leaderboard as $i => $entry)
                <div class="lb-row">
                    <div class="lb-pos {{ $i===0?'pos-1':($i===1?'pos-2':($i===2?'pos-3':'pos-n')) }}">
                        @if($i < 3){{ ['🥇','🥈','🥉'][$i] }}@else{{ $i+1 }}@endif
                    </div>
                    <div>
                        <div class="lb-name">{{ $entry->student->name ?? __('front.lb_student_fallback') }}</div>
                        <div style="font-size:.75rem;color:var(--z-text-muted)">{{ $entry->exam->title ?? '' }}</div>
                    </div>
                    <span class="lb-pct">{{ $entry->percentage }}%</span>
                </div>
                @empty
                <div style="padding:1.5rem;text-align:center;color:var(--z-text-muted);font-size:.88rem">
                    <i class="bi bi-trophy" style="font-size:2rem;opacity:.3;display:block;margin-bottom:.75rem"></i>
                    {{ __('front.exams_lb_empty') }}<br>{{ __('front.exams_lb_empty2') }}
                </div>
                @endforelse
            </div>

            <div class="mt-4 p-4" style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));border-radius:var(--z-radius-lg);color:#fff;text-align:center">
                <div style="font-size:2.5rem;margin-bottom:.75rem">🎯</div>
                <h5 style="color:#fff;font-weight:800">{{ __('front.exams_cta_title') }}</h5>
                <p style="color:rgba(255,255,255,.75);font-size:.88rem;margin-bottom:1.25rem">
                    {{ __('front.exams_cta_desc') }}
                </p>
                @guest('student')
                <a href="{{ route('student.register') }}" class="btn-z btn-z-accent btn-z-block">
                    <i class="bi bi-person-plus-fill"></i> {{ __('front.exams_cta_register') }}
                </a>
                @endguest
            </div>
        </div>

    </div>
</div>
@endsection
