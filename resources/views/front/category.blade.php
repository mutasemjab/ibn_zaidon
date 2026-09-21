@extends('front.layouts.app')
@php
    $siteName = \App\Models\SiteSetting::val('site_name') ?: __('front.site_name');
    $isRtl    = app()->getLocale() === 'ar';
@endphp
@section('seo_title', $category->name . ' | ' . $siteName)
@section('meta_desc', __('front.cat_meta_desc', ['name' => $category->name, 'site' => $siteName]))

@push('json_ld')
    @php
        $crumbs = [['name' => __('front.home'), 'item' => url('/')]];
        if ($category->parent) {
            $crumbs[] = ['name' => $category->parent->name, 'item' => route('categories.show', $category->parent_id)];
        }
        $crumbs[] = ['name' => $category->name, 'item' => url()->current()];
        $breadcrumbLd = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => collect($crumbs)->values()->map(fn ($c, $i) => [
                '@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['name'], 'item' => $c['item'],
            ])->all(),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($breadcrumbLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')

    {{-- Page Header --}}
    <div style="background:linear-gradient(135deg,var(--z-primary),#1a4ab0);padding:2.5rem 0">
        <div class="container">
            <div class="z-breadcrumb mb-2">
                <a href="{{ route('home') }}">{{ __('front.home') }}</a>
                @if ($category->parent)
                    <span class="sep">/</span>
                    @if ($category->parent->parent_id)
                        <a
                            href="{{ route('categories.show', $category->parent->parent_id) }}">{{ $category->parent->parent->name ?? '' }}</a>
                        <span class="sep">/</span>
                    @endif
                    <a href="{{ route('categories.show', $category->parent_id) }}">{{ $category->parent->name }}</a>
                @endif
                <span class="sep">/</span>
                <span>{{ $category->name }}</span>
            </div>
            <h1 style="color:#fff;font-size:clamp(1.4rem,3vw,2rem);margin:0">
                @if ($category->icon)
                    <i class="bi {{ $category->icon }} me-2"></i>
                @endif
                {{ $category->name }}
            </h1>
        </div>
    </div>

    <div class="container py-5">

        @php
            $hasChildren = $category->children->isNotEmpty();
            $hasSubjects = $category->subjects->isNotEmpty();

            // Semester-type children are detected on the stored Arabic name ("الفصل"), regardless of UI language
            $isSemesterBased = $hasChildren && $category->children->every(fn($c) => str_contains($c->name_ar, 'الفصل'));

            // Collect subjects grouped by semester (for grade pages)
            $semesterGroups = collect();
            if ($isSemesterBased) {
                foreach ($category->children as $sem) {
                    $semesterGroups->push([
                        'id' => $sem->id,
                        'name' => $sem->name,
                        'subjects' => $sem->subjects,
                    ]);
                }
            }
            $allSemesterSubjects = $semesterGroups->flatMap(
                fn($g) => $g['subjects']->map(
                    fn($s) => array_merge($s->toArray(), [
                        'name' => $s->name,
                        '_sem_id' => $g['id'],
                        '_sem_name' => $g['name'],
                    ]),
                ),
            );
        @endphp

        {{-- ══════════ CASE 1: Grade page — semester tabs + subjects ══════════ --}}
        @if ($isSemesterBased)

            @if ($allSemesterSubjects->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-journal-x" style="font-size:4rem;color:var(--z-border)"></i>
                    <h5 style="color:var(--z-text-muted);margin-top:1rem">{{ __('front.cat_page_no_subjects') }}</h5>
                </div>
            @else
                {{-- Semester filter tabs --}}
                <div class="mb-4 d-flex gap-2 flex-wrap" id="semTabs">
                    <button class="btn-z btn-z-primary btn-z-sm sem-btn active" data-sem="all">{{ __('front.cat_sem_all') }}</button>
                    @foreach ($semesterGroups as $sem)
                        <button class="btn-z btn-z-outline btn-z-sm sem-btn" data-sem="{{ $sem['id'] }}">
                            <i class="bi bi-{{ $loop->index === 0 ? '1' : '2' }}-circle"></i>
                            {{ $sem['name'] }}
                        </button>
                    @endforeach
                </div>

                <div class="row g-4" id="subjectsGrid">
                    @foreach ($allSemesterSubjects as $subject)
                        <div class="col-lg-3 col-md-4 col-6 subj-item" data-sem="{{ $subject['_sem_id'] }}">
                            <a href="{{ route('courses.index', ['subject' => $subject['id']]) }}" class="cat-card">
                                <div class="cat-icon">
                                    @if (!empty($subject['icon']))
                                    <i class="bi {{ $subject['icon'] }}"></i>@else📚
                                    @endif
                                </div>
                                <h5>{{ $subject['name'] }}</h5>
                                <span class="cat-count">{{ $subject['courses_count'] ?? 0 }} {{ __('front.cat_courses_count') }}</span>
                                <small
                                    style="color:var(--z-text-muted);font-size:.75rem;margin-top:.25rem;display:block">{{ $subject['_sem_name'] }}</small>
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
                @foreach ($category->children as $child)
                    <div class="col-lg-3 col-md-4 col-6 anim-fade-up anim-d{{ min($loop->index + 1, 4) }}">
                        <a href="{{ route('categories.show', $child->id) }}" class="cat-card">
                            <div class="cat-icon">
                                @if ($child->icon)
                                <i class="bi {{ $child->icon }}" style="font-size:2rem"></i>@else📚
                                @endif
                            </div>
                            <h5>{{ $child->name }}</h5>
                            @php
                                $subCount = $child->subjects->count();
                                $childCount = $child->children->count();
                                // Count subjects inside children (for semester categories)
                                $nestedSubCount = $child->children->sum(fn($c) => $c->subjects->count());
                            @endphp
                            @if ($subCount > 0)
                                <span class="cat-count">{{ $subCount }} {{ __('front.cat_subjects_count') }}</span>
                            @elseif($nestedSubCount > 0)
                                <span class="cat-count">{{ $nestedSubCount }} {{ __('front.cat_subjects_count') }}</span>
                            @elseif($childCount > 0)
                                <span class="cat-count">{{ $childCount }} {{ __('front.cat_category_count') }}</span>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- ══════════ CASE 3: Category with direct subjects ══════════ --}}
        @elseif($hasSubjects)
            <div class="row g-4">
                @foreach ($category->subjects as $subject)
                    <div class="col-lg-3 col-md-4 col-6 anim-fade-up anim-d{{ min($loop->index + 1, 4) }}">
                        <a href="{{ route('courses.index', ['subject' => $subject->id]) }}" class="cat-card">
                            <div class="cat-icon">
                                @if ($subject->icon)
                                <i class="bi {{ $subject->icon }}"></i>@else📚
                                @endif
                            </div>
                            <h5>{{ $subject->name }}</h5>
                            <span class="cat-count">{{ $subject->courses_count ?? 0 }} {{ __('front.cat_courses_count') }}</span>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- ══════════ Empty ══════════ --}}
        @else
            <div class="text-center py-5">
                <i class="bi bi-folder2-open" style="font-size:4rem;color:var(--z-border)"></i>
                <h5 style="color:var(--z-text-muted);margin-top:1rem">{{ __('front.cat_page_empty') }}</h5>
                <a href="{{ route('home') }}" class="btn-z btn-z-outline mt-3">{{ __('front.cat_back_home') }}</a>
            </div>
        @endif

    </div>
@endsection
