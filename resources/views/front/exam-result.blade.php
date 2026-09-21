@extends('front.layouts.app')
@section('title', __('front.exam_result_title'))

@section('content')
@php $letters = __('front.option_letters'); @endphp

<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <a href="{{ route('exams.index') }}">{{ __('front.nav_exams') }}</a>
            <span class="sep">/</span>
            <span>{{ __('front.exam_result_crumb') }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0">
            <i class="bi bi-bar-chart-fill me-2"></i>{{ __('front.exam_result_title') }}
        </h1>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center g-5">

        {{-- Score Summary --}}
        <div class="col-lg-4">
            <div class="contact-card text-center">
                <div class="result-circle {{ $attempt->is_passed ? 'pass' : 'fail' }} mb-4">
                    <div class="result-pct" style="color:{{ $attempt->is_passed ? 'var(--z-success)' : '#dc3545' }}">
                        {{ $attempt->percentage }}%
                    </div>
                    @if($attempt->is_passed)
                        <div class="result-pass-lbl mt-1"><i class="bi bi-check-circle-fill me-1"></i>{{ __('front.exam_passed') }}</div>
                    @else
                        <div class="result-fail-lbl mt-1"><i class="bi bi-x-circle-fill me-1"></i>{{ __('front.exam_failed') }}</div>
                    @endif
                </div>

                <h4 style="color:var(--z-primary);font-weight:800;margin-bottom:.5rem">{{ $exam->title }}</h4>

                <div class="row g-3 mt-2">
                    <div class="col-6">
                        <div style="background:rgba(40,167,69,.08);border-radius:var(--z-radius);padding:.75rem">
                            <div style="font-size:1.3rem;font-weight:800;color:var(--z-success)">{{ $attempt->score }}</div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)">{{ __('front.exam_score') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:rgba(11,61,145,.06);border-radius:var(--z-radius);padding:.75rem">
                            <div style="font-size:1.3rem;font-weight:800;color:var(--z-primary)">{{ $attempt->total_marks }}</div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)">{{ __('front.exam_total_marks') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:rgba(40,167,69,.06);border-radius:var(--z-radius);padding:.75rem">
                            <div style="font-size:1.3rem;font-weight:800;color:var(--z-success)">
                                {{ $attempt->answers->where('is_correct', true)->count() }}
                            </div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)">{{ __('front.exam_correct_answers') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:rgba(220,53,69,.06);border-radius:var(--z-radius);padding:.75rem">
                            <div style="font-size:1.3rem;font-weight:800;color:#dc3545">
                                {{ $attempt->answers->where('is_correct', false)->count() }}
                            </div>
                            <div style="font-size:.75rem;color:var(--z-text-muted)">{{ __('front.exam_wrong_answers') }}</div>
                        </div>
                    </div>
                </div>

                @if($attempt->time_taken_seconds)
                <div class="mt-3" style="font-size:.85rem;color:var(--z-text-muted)">
                    <i class="bi bi-clock me-1"></i>
                    {{ __('front.exam_time_taken') }}: {{ gmdate('i:s', $attempt->time_taken_seconds) }}
                </div>
                @endif

                <div class="d-flex flex-column gap-2 mt-4">
                    <a href="{{ route('exams.index') }}" class="btn-z btn-z-primary btn-z-block">
                        <i class="bi bi-grid-3x3-gap"></i> {{ __('front.exam_other_exams') }}
                    </a>
                    <a href="{{ route('exams.show', $exam->id) }}" class="btn-z btn-z-outline btn-z-block">
                        <i class="bi bi-arrow-repeat"></i> {{ __('front.exam_retry') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Question Review --}}
        <div class="col-lg-8">
            <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:1.25rem">
                <i class="bi bi-eye-fill me-2"></i>{{ __('front.exam_review') }}
            </h5>

            @foreach($exam->questions as $i => $question)
            @php
                $answer = $attempt->answers->firstWhere('question_id', $question->id);
                $isCorrect = $answer && $answer->is_correct;
                $correctOption = $question->options->firstWhere('is_correct', true);
                $selectedOption = $answer?->selectedOption;
            @endphp
            <div class="q-card" style="border-color:{{ $isCorrect ? 'rgba(40,167,69,.3)' : 'rgba(220,53,69,.3)' }};
                                        background:{{ $isCorrect ? 'rgba(40,167,69,.02)' : 'rgba(220,53,69,.02)' }}">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="q-num">{{ __('front.exam_question_n', ['n' => $i + 1]) }}</span>
                    @if($isCorrect)
                        <span style="color:var(--z-success);font-size:.82rem;font-weight:700"><i class="bi bi-check-circle-fill me-1"></i>{{ __('front.exam_correct') }}</span>
                    @else
                        <span style="color:#dc3545;font-size:.82rem;font-weight:700"><i class="bi bi-x-circle-fill me-1"></i>{{ __('front.exam_wrong') }}</span>
                    @endif
                </div>
                <div class="q-text">{{ $question->question_text }}</div>

                @foreach($question->options as $j => $option)
                @php
                    $isSelected  = $selectedOption && $selectedOption->id === $option->id;
                    $isCorrectOpt = $option->is_correct;
                    $cls = '';
                    if ($isCorrectOpt) $cls = 'correct';
                    elseif ($isSelected && !$isCorrectOpt) $cls = 'wrong';
                @endphp
                <label class="opt-lbl {{ $cls }}" style="cursor:default">
                    <span class="opt-marker" style="{{ $isCorrectOpt ? 'border-color:var(--z-success);background:var(--z-success);color:#fff' : ($cls==='wrong' ? 'border-color:#dc3545;background:#dc3545;color:#fff' : '') }}">
                        {{ $letters[$j] ?? ($j+1) }}
                    </span>
                    <span>{{ $option->option_text }}</span>
                    @if($isCorrectOpt)
                        <i class="bi bi-check-circle-fill ms-auto" style="color:var(--z-success)"></i>
                    @elseif($isSelected && !$isCorrectOpt)
                        <i class="bi bi-x-circle-fill ms-auto" style="color:#dc3545"></i>
                    @endif
                </label>
                @endforeach

                @if(!$isCorrect && $question->explanation)
                <div style="margin-top:.75rem;padding:.75rem;background:rgba(30,107,214,.06);border-radius:8px;border-inline-start:3px solid var(--z-accent)">
                    <div style="font-size:.8rem;font-weight:700;color:var(--z-accent);margin-bottom:.3rem">
                        <i class="bi bi-lightbulb-fill me-1"></i>{{ __('front.exam_explanation') }}
                    </div>
                    <div style="font-size:.85rem;color:var(--z-text)">{{ $question->explanation }}</div>
                </div>
                @endif
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
