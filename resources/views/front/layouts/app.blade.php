@php $dir = app()->getLocale() === 'ar' ? 'rtl' : 'ltr'; @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $dir }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ══ Title ═══════════════════════════════════════════════════════════ --}}
    @hasSection('seo_title')
        <title>@yield('seo_title')</title>
    @else
        <title>@yield('title', 'أكاديمية ابن زيدون التعليمية') | منصة تعليم إلكتروني في الأردن</title>
    @endif

    {{-- ══ Core Meta ════════════════════════════════════════════════════════ --}}
    <meta name="description"
          content="@yield('meta_desc', 'أكاديمية ابن زيدون التعليمية — منصة تعليم إلكتروني رائدة في الأردن. دورات تفاعلية للمرحلة الأساسية (الصفوف 1-10) والتوجيهي، امتحانات ذكية، وأوراق عمل احترافية بإشراف نخبة المعلمين الأردنيين.')">
    <meta name="keywords"
          content="@yield('meta_keywords', 'أكاديمية ابن زيدون, دورات تعليمية أردن, منصة تعليمية أردن, توجيهي أردن, دروس توجيهي أونلاين, كورسات المرحلة الأساسية, تعليم إلكتروني الأردن, دورات الصف العاشر, امتحانات التوجيهي, دروس خصوصية اونلاين الأردن, أفضل منصة تعليمية أردنية, ابن زيدون التعليمية')">
    <meta name="robots"
          content="@yield('meta_robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">
    <meta name="author"  content="أكاديمية ابن زيدون التعليمية">
    <meta name="geo.region"    content="JO">
    <meta name="geo.placename" content="عمّان، الأردن">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ══ Open Graph ═══════════════════════════════════════════════════════ --}}
    <meta property="og:type"         content="@yield('og_type', 'website')">
    <meta property="og:site_name"    content="أكاديمية ابن زيدون التعليمية">
    <meta property="og:title"        content="@yield('title', 'أكاديمية ابن زيدون التعليمية')">
    <meta property="og:description"  content="@yield('meta_desc', 'منصة تعليم إلكتروني رائدة في الأردن للمرحلة الأساسية والتوجيهي')">
    <meta property="og:url"          content="{{ url()->current() }}">
    <meta property="og:image"        content="@yield('og_image', asset('assets_front/images/og-cover.jpg'))">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt"    content="أكاديمية ابن زيدون التعليمية">
    <meta property="og:locale"       content="ar_JO">

    {{-- ══ Twitter Card ════════════════════════════════════════════════════ --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="@yield('title', 'أكاديمية ابن زيدون التعليمية')">
    <meta name="twitter:description" content="@yield('meta_desc', 'منصة تعليم إلكتروني رائدة في الأردن')">
    <meta name="twitter:image"       content="@yield('og_image', asset('assets_front/images/og-cover.jpg'))">

    {{-- ══ JSON-LD: EducationalOrganization + WebSite (كل الصفحات) ════════ --}}
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": ["EducationalOrganization","Organization"],
          "@id": "{{ url('/') }}/#organization",
          "name": "أكاديمية ابن زيدون التعليمية",
          "alternateName": ["Ibn Zaidon Educational Academy","ابن زيدون التعليمية","أكاديمية ابن زيدون"],
          "url": "{{ url('/') }}",
          "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('assets_front/images/logo.png') }}",
            "width": 200, "height": 60
          },
          "image": "{{ asset('assets_front/images/og-cover.jpg') }}",
          "description": "أكاديمية ابن زيدون التعليمية منصة تعليم إلكتروني أردنية متخصصة في تقديم دورات تفاعلية للمرحلة الأساسية (الصفوف 1-10) والتوجيهي، امتحانات ذكية، وأوراق عمل احترافية بإشراف نخبة المعلمين المتميزين في الأردن.",
          "address": {
            "@type": "PostalAddress",
            "addressCountry": "JO",
            "addressLocality": "عمّان",
            "addressRegion": "الأردن"
          },
          "areaServed": {
            "@type": "Country",
            "name": "Jordan",
            "sameAs": "https://www.wikidata.org/wiki/Q810"
          },
          "knowsAbout": [
            "تعليم المرحلة الأساسية الأردنية","التوجيهي الأردني",
            "الرياضيات","الفيزياء","الكيمياء","الأحياء",
            "اللغة العربية","اللغة الإنجليزية","التاريخ","الجغرافيا"
          ],
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "الدورات التعليمية",
            "itemListElement": [
              { "@type": "OfferCatalog", "name": "دورات المرحلة الأساسية — الصفوف 1 إلى 10" },
              { "@type": "OfferCatalog", "name": "دورات اول ثانوي" },
              { "@type": "OfferCatalog", "name": "دورات التوجيهي — ثاني ثانوي" }
            ]
          },
          "sameAs": []
        },
        {
          "@type": "WebSite",
          "@id": "{{ url('/') }}/#website",
          "url": "{{ url('/') }}",
          "name": "أكاديمية ابن زيدون التعليمية",
          "alternateName": "Ibn Zaidon Academy",
          "description": "منصة تعليم إلكتروني رائدة في الأردن للمرحلة الأساسية والتوجيهي",
          "publisher": { "@id": "{{ url('/') }}/#organization" },
          "inLanguage": "ar",
          "potentialAction": {
            "@type": "SearchAction",
            "target": {
              "@type": "EntryPoint",
              "urlTemplate": "{{ url('/courses') }}?q={search_term_string}"
            },
            "query-input": "required name=search_term_string"
          }
        }
      ]
    }
    </script>

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
@include('front.partials.navbar')

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
            <span>تمت إضافة "{{ session('cart_added') }}" إلى سلة التسوق.</span>
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
            <span>تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.</span>
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
@include('front.partials.footer')

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- Brand JS --}}
<script src="{{ asset('assets_front/js/app.js') }}"></script>

@stack('scripts')
</body>
</html>
