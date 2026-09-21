@php $cartCount = count(session('cart', [])); @endphp

<nav class="z-navbar">
    <div class="container z-nav-wrap">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="z-brand">
            <span class="z-brand-icon">ز</span>
            <span>{{ \App\Models\SiteSetting::val('site_name') ?: __('front.site_name') }}</span>
        </a>

        {{-- Desktop Links --}}
        <ul class="z-nav-links">
            <li><a href="{{ route('home') }}#hero"
                   class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('front.nav_home') }}</a></li>
            <li><a href="{{ route('home') }}#about">{{ __('front.nav_about') }}</a></li>
            <li><a href="{{ route('courses.index') }}"
                   class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">{{ __('front.nav_courses') }}</a></li>
            <li><a href="{{ route('home') }}#services">{{ __('front.nav_services') }}</a></li>
            <li><a href="{{ route('home') }}#teachers">{{ __('front.nav_teachers') }}</a></li>
            <li><a href="{{ route('home') }}#contact">{{ __('front.nav_contact') }}</a></li>
            <li class="exam-link">
                <a href="{{ route('exams.index') }}"
                   class="{{ request()->routeIs('exams.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check me-1"></i>{{ __('front.nav_exams') }}
                </a>
            </li>
        </ul>

        {{-- Actions --}}
        <div class="z-nav-actions">

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="cart-btn" title="{{ __('front.nav_cart') }}">
                <i class="bi bi-cart3"></i>
                @if($cartCount > 0)
                    <span class="cart-count">{{ $cartCount }}</span>
                @endif
            </a>

            {{-- Auth --}}
            @auth('student')
                <div class="dropdown">
                    <button class="btn-z btn-z-ghost btn-z-sm dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                        <span class="d-none d-md-inline">{{ auth('student')->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('home') }}">
                            <i class="bi bi-house me-2"></i>{{ __('front.nav_profile') }}
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('student.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>{{ __('front.nav_logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('student.login') }}" class="btn-z btn-z-ghost btn-z-sm">
                    <i class="bi bi-person"></i>
                    <span class="d-none d-sm-inline">{{ __('front.nav_login') }}</span>
                </a>
                <a href="{{ route('student.register') }}" class="btn-z btn-z-accent btn-z-sm">
                    <i class="bi bi-person-plus"></i>
                    <span class="d-none d-sm-inline">{{ __('front.nav_register') }}</span>
                </a>
            @endauth

            {{-- Mobile Toggle --}}
            <button class="z-mobile-toggle" id="mobileToggle" aria-label="{{ __('front.nav_open_menu') }}">
                <span></span><span></span><span></span>
            </button>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="z-mobile-menu" id="mobileMenu">
        <ul class="z-nav-links mb-3">
            <li><a href="{{ route('home') }}">{{ __('front.nav_home') }}</a></li>
            <li><a href="{{ route('home') }}#about">{{ __('front.nav_about') }}</a></li>
            <li><a href="{{ route('courses.index') }}">{{ __('front.nav_courses') }}</a></li>
            <li><a href="{{ route('home') }}#services">{{ __('front.nav_services') }}</a></li>
            <li><a href="{{ route('home') }}#teachers">{{ __('front.nav_teachers') }}</a></li>
            <li><a href="{{ route('home') }}#contact">{{ __('front.nav_contact') }}</a></li>
            <li class="exam-link"><a href="{{ route('exams.index') }}">{{ __('front.nav_exams') }}</a></li>
        </ul>
        <div class="z-nav-actions border-top border-white border-opacity-10 pt-3 mt-2">
            @auth('student')
                <span class="text-white-50 small me-2">{{ auth('student')->user()->name }}</span>
                <form method="POST" action="{{ route('student.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-z btn-z-danger btn-z-sm">{{ __('front.nav_logout') }}</button>
                </form>
            @else
                <a href="{{ route('student.login') }}" class="btn-z btn-z-ghost btn-z-sm me-1">{{ __('front.nav_login') }}</a>
                <a href="{{ route('student.register') }}" class="btn-z btn-z-accent btn-z-sm">{{ __('front.nav_register') }}</a>
            @endauth
        </div>
    </div>
</nav>
