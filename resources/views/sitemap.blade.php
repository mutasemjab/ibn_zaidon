<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

    {{-- ══ Static pages ═══════════════════════════════════════════════════ --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('courses.index') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('exams.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- ══ Root categories (الصفوف الرئيسية / التوجيهي) ════════════════════ --}}
    @foreach($categories as $cat)
    <url>
        <loc>{{ route('categories.show', $cat->id) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

    {{-- ══ All sub-categories ══════════════════════════════════════════════ --}}
    @foreach($allCategories->whereNotNull('parent_id') as $cat)
    <url>
        <loc>{{ route('categories.show', $cat->id) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- ══ Published courses ═══════════════════════════════════════════════ --}}
    @foreach($courses as $course)
    <url>
        <loc>{{ route('courses.show', $course->id) }}</loc>
        <lastmod>{{ $course->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

</urlset>
