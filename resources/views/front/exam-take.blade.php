@extends('front.layouts.app')
@section('title', $exam->title)

@section('content')
@php $letters = __('front.option_letters'); @endphp

<div style="background:var(--z-section-bg);min-height:calc(100vh - var(--navbar-h));padding:2rem 0">
    <div class="container">
        <div class="row g-4">

            {{-- Sidebar: Timer & Progress --}}
            <div class="col-lg-3 col-md-4">

                {{-- Timer --}}
                @if($exam->duration_minutes)
                <div class="exam-timer-box" id="examTimerBox">
                    <div class="timer-lbl mb-1"><i class="bi bi-clock-fill me-1"></i>{{ __('front.exam_time_left') }}</div>
                    <div class="timer-num" id="timerDisplay">
                        {{ str_pad($exam->duration_minutes, 2, '0', STR_PAD_LEFT) }}:00
                    </div>
                    <span id="examTimerData" data-seconds="{{ $exam->duration_minutes * 60 }}" hidden></span>
                    <div style="font-size:.75rem;color:var(--z-text-muted);margin-top:.4rem">{{ __('front.exam_min_sec') }}</div>
                </div>
                @endif

                {{-- Progress --}}
                <div style="background:#fff;border-radius:var(--z-radius-lg);padding:1.2rem;border:1.5px solid var(--z-border)">
                    <h6 style="color:var(--z-primary);font-weight:700;margin-bottom:1rem;font-size:.9rem">{{ __('front.exam_progress') }}</h6>
                    <div style="display:flex;flex-direction:column;gap:.5rem" id="questionNav">
                        @foreach($questions as $i => $question)
                        <a href="#q-{{ $question->id }}"
                           style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:var(--z-text-muted);text-decoration:none;padding:.35rem .6rem;border-radius:7px;border:1px solid var(--z-border);transition:var(--z-tr)"
                           id="nav-q-{{ $question->id }}"
                           onmouseover="this.style.borderColor='var(--z-accent)'"
                           onmouseout="this.style.borderColor='var(--z-border)'">
                            <span style="width:22px;height:22px;border-radius:50%;background:var(--z-section-bg);display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:700;flex-shrink:0">{{ $i + 1 }}</span>
                            <span>{{ __('front.exam_question_n', ['n' => $i + 1]) }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Questions --}}
            <div class="col-lg-9 col-md-8">
                <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                    <div>
                        <h4 style="color:var(--z-primary);font-weight:800;margin:0">{{ $exam->title }}</h4>
                        <span style="font-size:.85rem;color:var(--z-text-muted)">{{ $questions->count() }} {{ __('front.questions') }}</span>
                    </div>
                    <div style="background:rgba(245,166,35,.1);border:1px solid rgba(245,166,35,.25);border-radius:var(--z-radius);padding:.5rem 1rem;font-size:.85rem;font-weight:600;color:var(--z-primary)">
                        <i class="bi bi-shield-check-fill me-1" style="color:var(--z-success)"></i>
                        {{ __('front.exam_autosaved') }}
                    </div>
                </div>

                <form id="examForm" method="POST" action="{{ route('exams.submit', $exam->id) }}">
                    @csrf

                    @foreach($questions as $i => $question)
                    <div class="q-card" id="q-{{ $question->id }}">
                        <span class="q-num">{{ __('front.exam_question_of', ['n' => $i + 1, 'total' => $questions->count()]) }}</span>
                        @if($question->marks > 1)
                        <span style="float:inline-end;font-size:.75rem;background:rgba(11,61,145,.08);color:var(--z-primary);padding:.15rem .5rem;border-radius:50px">{{ __('front.exam_marks', ['n' => $question->marks]) }}</span>
                        @endif
                        <div class="q-text">{{ $question->question_text }}</div>

                        @foreach($question->options as $j => $option)
                        <label class="opt-lbl">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}">
                            <span class="opt-marker">{{ $letters[$j] ?? ($j + 1) }}</span>
                            <span>{{ $option->option_text }}</span>
                        </label>
                        @endforeach
                    </div>
                    @endforeach

                    <input type="hidden" name="time_taken_seconds" value="0">

                    <div style="background:#fff;border-radius:var(--z-radius-lg);padding:1.5rem;border:1.5px solid var(--z-border);margin-top:1rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem">
                        <div>
                            <div style="font-size:.88rem;color:var(--z-text-muted)">
                                <i class="bi bi-info-circle me-1"></i>
                                {{ __('front.exam_check_answers') }}
                            </div>
                        </div>
                        <button type="submit" class="btn-z btn-z-success btn-z-lg"
                                onclick="return confirm(@js(__('front.exam_confirm_submit')))">
                            <i class="bi bi-send-check-fill"></i>
                            {{ __('front.exam_submit') }}
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
// Highlight nav items when answering
document.querySelectorAll('.opt-lbl input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function () {
        const qId = this.name.match(/\[(\d+)\]/)?.[1];
        if (qId) {
            const navLink = document.getElementById('nav-q-' + qId);
            if (navLink) {
                navLink.style.background = 'rgba(40,167,69,.08)';
                navLink.style.borderColor = 'var(--z-success)';
                navLink.style.color = 'var(--z-success)';
            }
        }
    });
});
</script>
@endpush
@endsection
