@php
    use App\Models\Category;
    use App\Models\SiteSetting;

    $locale   = app()->getLocale();
    $dir      = $locale === 'ar' ? 'rtl' : 'ltr';
    $ogLocale = $locale === 'ar' ? 'ar_JO' : 'en_US';

    // ── Everything below comes from the admin panel (Site Settings), with lang-file fallbacks ──
    $siteName    = SiteSetting::val('site_name')        ?: __('front.site_name');
    $siteTagline = SiteSetting::val('site_tagline')     ?: __('front.site_tagline');
    $metaDesc    = SiteSetting::val('meta_description') ?: __('front.meta_description');
    $metaKeys    = SiteSetting::val('meta_keywords')    ?: __('front.meta_keywords');
    $address     = SiteSetting::val('contact_address');

    $pageTitle = trim($__env->yieldContent('title'));
    $fullTitle = $pageTitle !== '' ? $pageTitle . ' | ' . $siteName : $siteName . ' | ' . $siteTagline;

    $sameAs = array_values(array_filter(array_map(
        fn ($k) => SiteSetting::raw($k),
        ['social_facebook', 'social_instagram', 'social_youtube', 'social_twitter', 'social_tiktok', 'social_snapchat']
    )));

    $topCategories = Category::whereNull('parent_id')->get();

    $orgLd = array_filter([
        '@type'         => ['EducationalOrganization', 'Organization'],
        '@id'           => url('/') . '/#organization',
        'name'          => $siteName,
        'alternateName' => array_values(array_unique(array_filter([
            SiteSetting::val('site_name', 'ar'),
            SiteSetting::val('site_name', 'en'),
        ]))),
        'url'           => url('/'),
        'logo'          => ['@type' => 'ImageObject', 'url' => asset('assets_front/images/logo.png')],
        'image'         => asset('assets_front/images/og-cover.jpg'),
        'description'   => SiteSetting::val('about_description') ?: $metaDesc,
        'address'       => $address ? ['@type' => 'PostalAddress', 'streetAddress' => $address, 'addressCountry' => 'JO'] : null,
        'areaServed'    => ['@type' => 'Country', 'name' => 'Jordan'],
        'hasOfferCatalog' => $topCategories->isEmpty() ? null : [
            '@type'           => 'OfferCatalog',
            'name'            => __('front.nav_courses'),
            'itemListElement' => $topCategories->map(fn ($c) => ['@type' => 'OfferCatalog', 'name' => $c->name])->all(),
        ],
        'sameAs'        => $sameAs ?: null,
    ]);

    $siteLd = [
        '@type'       => 'WebSite',
        '@id'         => url('/') . '/#website',
        'url'         => url('/'),
        'name'        => $siteName,
        'description' => $metaDesc,
        'publisher'   => ['@id' => url('/') . '/#organization'],
        'inLanguage'  => $locale,
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => ['@type' => 'EntryPoint', 'urlTemplate' => route('courses.index') . '?q={search_term_string}'],
            'query-input' => 'required name=search_term_string',
        ],
    ];

    $ld = ['@context' => 'https://schema.org', '@graph' => [$orgLd, $siteLd]];
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ══ Title ═══════════════════════════════════════════════════════════ --}}
    @hasSection('seo_title')
        <title>@yield('seo_title')</title>
    @else
        <title>{{ $fullTitle }}</title>
    @endif

    {{-- ══ Core Meta ════════════════════════════════════════════════════════ --}}
    <meta name="description" content="@yield('meta_desc', $metaDesc)">
    <meta name="keywords"    content="@yield('meta_keywords', $metaKeys)">
    <meta name="robots"      content="@yield('meta_robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">
    <meta name="author"      content="{{ $siteName }}">
    <meta name="geo.region"  content="JO">
    @if($address)
        <meta name="geo.placename" content="{{ $address }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ══ Open Graph ═══════════════════════════════════════════════════════ --}}
    <meta property="og:type"         content="@yield('og_type', 'website')">
    <meta property="og:site_name"    content="{{ $siteName }}">
    <meta property="og:title"        content="{{ $pageTitle !== '' ? $pageTitle : $siteName }}">
    <meta property="og:description"  content="@yield('meta_desc', $metaDesc)">
    <meta property="og:url"          content="{{ url()->current() }}">
    <meta property="og:image"        content="@yield('og_image', asset('assets_front/images/og-cover.jpg'))">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt"    content="{{ $siteName }}">
    <meta property="og:locale"       content="{{ $ogLocale }}">

    {{-- ══ Twitter Card ════════════════════════════════════════════════════ --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $pageTitle !== '' ? $pageTitle : $siteName }}">
    <meta name="twitter:description" content="@yield('meta_desc', $metaDesc)">
    <meta name="twitter:image"       content="@yield('og_image', asset('assets_front/images/og-cover.jpg'))">

    {{-- ══ JSON-LD: EducationalOrganization + WebSite (all pages) ══════════ --}}
    <script type="application/ld+json">{!! json_encode($ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>

    {{-- Page-specific JSON-LD (BreadcrumbList, Course, FAQ…) --}}
    @stack('json_ld')

    {{-- ══ Bootstrap 5.3 RTL/LTR ═══════════════════════════════════════════ --}}
    @if($dir === 'rtl')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('assets_front/css/style.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

{{-- Navbar --}}
@include('front.includes.navbar')

{{-- Flash Messages --}}
@if(session('activation_success'))
    <div class="container pt-3">
        <div class="z-flash flash-success">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span>{{ session('activation_success') }}</span>
        </div>
    </div>
@endif
@if(session('activation_error'))
    <div class="container pt-3">
        <div class="z-flash flash-error">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>{{ session('activation_error') }}</span>
        </div>
    </div>
@endif
@if(session('cart_added'))
    <div class="container pt-3">
        <div class="z-flash flash-info">
            <i class="bi bi-cart-check-fill fs-5"></i>
            <span>{{ __('front.flash_cart_added', ['name' => session('cart_added')]) }}</span>
        </div>
    </div>
@endif
@if(session('register_success'))
    <div class="container pt-3">
        <div class="z-flash flash-success">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span>{{ session('register_success') }}</span>
        </div>
    </div>
@endif
@if(session('contact_success'))
    <div class="container pt-3">
        <div class="z-flash flash-success">
            <i class="bi bi-envelope-check-fill fs-5"></i>
            <span>{{ __('front.flash_contact_sent') }}</span>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="container pt-3">
        <div class="z-flash flash-error">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

{{-- Main Content --}}
@yield('content')

{{-- Footer --}}
@include('front.includes.footer')

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- Brand JS --}}
<script src="{{ asset('assets_front/js/app.js') }}"></script>

@stack('scripts')
</body>
</html>
