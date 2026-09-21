@extends('front.layouts.app')
@section('seo_title', $category->name_ar . ' | أكاديمية ابن زيدون التعليمية')
@section('meta_desc', 'تصفّح دورات '.$category->name_ar.' في أكاديمية ابن زيدون التعليمية — دورات تفاعلية بإشراف نخبة المعلمين الأردنيين. سجّل الآن وابدأ التعلم!')

@push('json_ld')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "الرئيسية", "item": "{{ url('/') }}" }
    @if($category->parent)
    ,{ "@type": "ListItem", "position": 2, "name": "{{ $category->parent->name_ar }}", "item": "{{ route('categories.show', $category->parent_id) }}" }
    ,{ "@type": "ListItem", "position": 3, "name": "{{ $category->name_ar }}", "item": "{{ url()->current() }}" }
    @else
    ,{ "@type": "ListItem", "position": 2, "name": "{{ $category->name_ar }}", "item": "{{ url()->current() }}" }
    @endif
  ]
}
</script>
@endpush

@section('content')

{{-- Page Header --}}
<div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
    <div class="container">
        <div class="z-breadcrumb mb-2">
            <a href="{{ route('home') }}">الرئيسية</a>
            @if($category->parent)
                <span class="sep">/</span>
                @if($category->parent->parent_id)
                    <a href="{{ route('categories.show', $category->parent->parent_id) }}">{{ $category->parent->parent->name_ar ?? '' }}</a>
                    <span class="sep">/</span>
                @endif
                <a href="{{ route('categories.show', $category->parent_id) }}">{{ $category->parent->name_ar }}</a>
            @endif
            <span class="sep">/</span>
            <span>{{ $category->name_ar }}</span>
        </div>
        <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0">
            @if($category->icon)<i class="bi {{ $category->icon }} me-2"></i>@endif
            {{ $category->name_ar }}
        </h1>
    </div>
</div>

<div class="container py-5">

@php
    $hasChildren   = $category->children->isNotEmpty();
    $hasSubjects   = $category->subjects->isNotEmpty();

    // Check if all children are semester-type (contain "الفصل")
    $isSemesterBased = $hasChildren && $category->children->every(
        fn($c) => str_contains($c->name_ar, 'الفصل')
    );

    // Collect subjects grouped by semester (for grade pages)
    $semesterGroups = collect();
    if ($isSemesterBased) {
        foreach ($category->children as $sem) {
            $semesterGroups->push([
                'id'       => $sem->id,
                'name'     => $sem->name_ar,
                'subjects' => $sem->subjects,
            ]);
        }
    }
    $allSemesterSubjects = $semesterGroups->flatMap(fn($g) => $g['subjects']->map(fn($s) => array_merge($s->toArray(), ['_sem_id' => $g['id'], '_sem_name' => $g['name']])));
@endphp

{{-- ══════════ CASE 1: Grade page — semester tabs + subjects ══════════ --}}
@if($isSemesterBased)

    @if($allSemesterSubjects->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-journal-x" style="font-size:4rem;color:var(--z-border)"></i>
            <h5 style="color:var(--z-text-muted);margin-top:1rem">لا توجد مواد في هذا الصف بعد</h5>
        </div>
    @else
        {{-- Semester filter tabs --}}
        <div class="mb-4 d-flex gap-2 flex-wrap" id="semTabs">
            <button class="btn-z btn-z-primary btn-z-sm sem-btn active" data-sem="all">الكل</button>
            @foreach($semesterGroups as $sem)
            <button class="btn-z btn-z-outline btn-z-sm sem-btn" data-sem="{{ $sem['id'] }}">
                <i class="bi bi-{{ $loop->index === 0 ? '1' : '2' }}-circle"></i>
                {{ $sem['name'] }}
            </button>
            @endforeach
        </div>

        <div class="row g-4" id="subjectsGrid">
            @foreach($allSemesterSubjects as $subject)
            <div class="col-lg-3 col-md-4 col-6 subj-item" data-sem="{{ $subject['_sem_id'] }}">
                <a href="{{ route('courses.index', ['subject' => $subject['id']]) }}" class="cat-card">
                    <div class="cat-icon">
                        @if(!empty($subject['icon']))<i class="bi {{ $subject['icon'] }}"></i>@else📚@endif
                    </div>
                    <h5>{{ $subject['name_ar'] }}</h5>
                    <span class="cat-count">{{ $subject['courses_count'] ?? 0 }} دورة</span>
                    <small style="color:var(--z-text-muted);font-size:.75rem;margin-top:.25rem;display:block">{{ $subject['_sem_name'] }}</small>
                </a>
            </div>
            @endforeach
        </div>

        <script>
        document.querySelectorAll('.sem-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.sem-btn').forEach(function(b) {
                    b.classList.remove('active');
                    b.classList.add('btn-z-outline');
                    b.classList.remove('btn-z-primary');
                });
                this.classList.add('active', 'btn-z-primary');
                this.classList.remove('btn-z-outline');
                var sem = this.dataset.sem;
                document.querySelectorAll('.subj-item').forEach(function(item) {
                    item.style.display = (sem === 'all' || item.dataset.sem === sem) ? '' : 'none';
                });
            });
        });
        </script>
    @endif

{{-- ══════════ CASE 2: Category with child categories ══════════ --}}
@elseif($hasChildren)

    <div class="row g-4">
        @foreach($category->children as $child)
        <div class="col-lg-3 col-md-4 col-6 anim-fade-up anim-d{{ min($loop->index + 1, 4) }}">
            <a href="{{ route('categories.show', $child->id) }}" class="cat-card">
                <div class="cat-icon">
                    @if($child->icon)<i class="bi {{ $child->icon }}" style="font-size:2rem"></i>@else📚@endif
                </div>
                <h5>{{ $child->name_ar }}</h5>
                @php
                    $subCount   = $child->subjects->count();
                    $childCount = $child->children->count();
                    // Count subjects inside children (for semester categories)
                    $nestedSubCount = $child->children->sum(fn($c) => $c->subjects->count());
                @endphp
                @if($subCount > 0)
                    <span class="cat-count">{{ $subCount }} مادة</span>
                @elseif($nestedSubCount > 0)
                    <span class="cat-count">{{ $nestedSubCount }} مادة</span>
                @elseif($childCount > 0)
                    <span class="cat-count">{{ $childCount }} تصنيف</span>
                @endif
            </a>
        </div>
        @endforeach
    </div>

{{-- ══════════ CASE 3: Category with direct subjects ══════════ --}}
@elseif($hasSubjects)

    <div class="row g-4">
        @foreach($category->subjects as $subject)
        <div class="col-lg-3 col-md-4 col-6 anim-fade-up anim-d{{ min($loop->index + 1, 4) }}">
            <a href="{{ route('courses.index', ['subject' => $subject->id]) }}" class="cat-card">
                <div class="cat-icon">
                    @if($subject->icon)<i class="bi {{ $subject->icon }}"></i>@else📚@endif
                </div>
                <h5>{{ $subject->name_ar }}</h5>
                <span class="cat-count">{{ $subject->courses_count ?? 0 }} دورة</span>
            </a>
        </div>
        @endforeach
    </div>

{{-- ══════════ Empty ══════════ --}}
@else
    <div class="text-center py-5">
        <i class="bi bi-folder2-open" style="font-size:4rem;color:var(--z-border)"></i>
        <h5 style="color:var(--z-text-muted);margin-top:1rem">لا يوجد محتوى في هذا التصنيف بعد</h5>
        <a href="{{ route('home') }}" class="btn-z btn-z-outline mt-3">العودة للرئيسية</a>
    </div>
@endif

</div>
@endsection
