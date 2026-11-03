@extends('front.layouts.app')
@section('title', $package->title)

@section('content')

<div style="background:linear-gradient(135deg,var(--z-primary),var(--z-accent));padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">{{ __('front.home') }}</a>
            <span class="sep">/</span>
            <a href="{{ route('packages.index') }}">{{ __('front.packages_breadcrumb') }}</a>
            <span class="sep">/</span>
            <span>{{ Str::limit($package->title, 40) }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0">{{ $package->title }}</h1>
        @if($package->description)
        <p style="color:rgba(255,255,255,.75);margin:.6rem 0 0;font-size:.93rem;max-width:640px">{{ $package->description }}</p>
        @endif
        <div style="margin-top:1rem;display:flex;gap:.75rem;flex-wrap:wrap;align-items:center">
            <span style="background:rgba(255,255,255,.15);color:#fff;padding:.35rem 1rem;border-radius:50px;font-size:.85rem;font-weight:700">
                {{ number_format($package->price, 2) }} {{ __('front.currency') }}
            </span>
            @if($package->old_price)
                <span style="color:rgba(255,255,255,.6);text-decoration:line-through;font-size:.85rem">{{ number_format($package->old_price, 2) }} {{ __('front.currency') }}</span>
            @endif
            <span style="background:rgba(255,200,61,.2);color:var(--z-highlight);padding:.35rem 1rem;border-radius:50px;font-size:.82rem;font-weight:700">
                <i class="bi bi-check2-square me-1"></i>{{ __('front.packages_pick_count', ['count' => $package->pick_count]) }}
            </span>
        </div>
    </div>
</div>

<div class="container py-5">

    @if(session('error'))
    <div class="z-flash flash-error mb-4"><i class="bi bi-exclamation-circle-fill fs-5"></i><span>{{ session('error') }}</span></div>
    @endif

    <h5 style="color:var(--z-primary);font-weight:700;margin-bottom:.25rem">{{ __('front.packages_pool_title') }}</h5>
    <p style="color:var(--z-text-muted);font-size:.88rem;margin-bottom:1.5rem">{{ __('front.packages_pick_hint', ['count' => $package->pick_count]) }}</p>

    <form id="packageForm" action="{{ route('cart.add-package', $package->id) }}" method="POST">
        @csrf

        <div class="row g-4 mb-4">
            @foreach($package->courses as $course)
            <div class="col-md-6 col-lg-4">
                <label class="course-card h-100 d-flex flex-column pkg-option" style="cursor:pointer;margin:0;display:flex" for="pkg-course-{{ $course->id }}">
                    <input type="checkbox" class="pkg-checkbox" id="pkg-course-{{ $course->id }}"
                           name="course_ids[]" value="{{ $course->id }}" style="position:absolute;opacity:0;pointer-events:none">
                    <div class="course-thumb-ph"><i class="bi bi-play-circle"></i></div>
                    <div class="course-body flex-grow-1">
                        <div class="course-title">{{ $course->title }}</div>
                        <div class="course-teacher">
                            <div class="av-xs"><i class="bi bi-person-fill"></i></div>
                            <span>{{ $course->teacher->name ?? __('front.teacher_fallback') }}</span>
                        </div>
                        @if($course->category)
                        <div style="font-size:.78rem;color:var(--z-text-muted);margin-top:.3rem">
                            <i class="bi bi-tag-fill me-1" style="color:var(--z-highlight)"></i>{{ $course->category->name }}
                        </div>
                        @endif
                    </div>
                    <div class="course-foot">
                        <span class="price-tag">{{ __('front.packages_price_each') }}: {{ number_format($course->price, 2) }} {{ __('front.currency') }}</span>
                        <span class="pkg-check-ico" style="width:26px;height:26px;border-radius:50%;border:2px solid var(--z-border);display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0">
                            <i class="bi bi-check-lg" style="font-size:.85rem;visibility:hidden"></i>
                        </span>
                    </div>
                </label>
            </div>
            @endforeach
        </div>

        {{-- Sticky selection bar --}}
        <div style="position:sticky;bottom:0;background:#fff;border:1.5px solid var(--z-border);border-radius:var(--z-radius-lg);box-shadow:var(--z-shadow-lg);padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;z-index:5">
            <span id="pkgSelectedCount" style="font-weight:700;color:var(--z-primary)">
                {{ __('front.packages_selected_of', ['selected' => 0, 'count' => $package->pick_count]) }}
            </span>
            <button type="submit" id="pkgSubmitBtn" class="btn-z btn-z-primary" disabled>
                <i class="bi bi-cart-plus-fill"></i> {{ __('front.packages_add_cart') }}
            </button>
        </div>
    </form>

</div>

@push('styles')
<style>
    .pkg-option { transition: var(--z-tr); border-width: 1.5px; }
    .pkg-option.pkg-selected { border-color: var(--z-accent); box-shadow: 0 0 0 3px rgba(123,47,247,.12); }
    .pkg-option.pkg-selected .pkg-check-ico { background: var(--z-accent); border-color: var(--z-accent); }
    .pkg-option.pkg-selected .pkg-check-ico i { visibility: visible !important; }
</style>
@endpush

@push('scripts')
<script>
(function () {
    const pickCount = {{ (int) $package->pick_count }};
    const checkboxes = Array.from(document.querySelectorAll('.pkg-checkbox'));
    const counter = document.getElementById('pkgSelectedCount');
    const submitBtn = document.getElementById('pkgSubmitBtn');
    const template = @json(__('front.packages_selected_of', ['selected' => '__N__', 'count' => '__T__']));

    function refresh() {
        const selected = checkboxes.filter(c => c.checked).length;
        counter.textContent = template.replace('__N__', selected).replace('__T__', pickCount);
        submitBtn.disabled = selected !== pickCount;
        checkboxes.forEach(cb => {
            cb.closest('.pkg-option').classList.toggle('pkg-selected', cb.checked);
            cb.disabled = !cb.checked && selected >= pickCount;
        });
    }

    checkboxes.forEach(cb => cb.addEventListener('change', refresh));
    refresh();
})();
</script>
@endpush
@endsection
