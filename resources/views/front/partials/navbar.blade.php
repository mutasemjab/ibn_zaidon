@php
    $cartCount = count(session('cart', []));
@endphp

<nav class="z-navbar">
    <div class="container z-nav-wrap">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="z-brand">
            <span class="z-brand-icon">ز</span>
            <span>أكاديمية ابن زيدون التعليمية</span>
        </a>

        {{-- Desktop Links --}}
        <ul class="z-nav-links">
            <li><a href="{{ route('home') }}#hero"
                   class="{{ request()->routeIs('home') ? 'active' : '' }}">الرئيسية</a></li>
            <li><a href="{{ route('home') }}#about">من نحن</a></li>
            <li><a href="{{ route('courses.index') }}"
                   class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">الدورات</a></li>
            <li><a href="{{ route('home') }}#services">خدماتنا</a></li>
            <li><a href="{{ route('home') }}#teachers">المعلمون</a></li>
            <li><a href="{{ route('home') }}#contact">تواصل معنا</a></li>
            <li class="exam-link">
                <a href="{{ route('exams.index') }}"
                   class="{{ request()->routeIs('exams.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check me-1"></i>الامتحانات
                </a>
            </li>
        </ul>

        {{-- Actions --}}
        <div class="z-nav-actions">

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="cart-btn" title="سلة التسوق">
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
                            <i class="bi bi-house me-2"></i>الرئيسية
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('student.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>تسجيل الخروج
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('student.login') }}" class="btn-z btn-z-ghost btn-z-sm">
                    <i class="bi bi-person"></i>
                    <span class="d-none d-sm-inline">تسجيل الدخول</span>
                </a>
                <a href="{{ route('student.register') }}" class="btn-z btn-z-accent btn-z-sm">
                    <i class="bi bi-person-plus"></i>
                    <span class="d-none d-sm-inline">إنشاء حساب</span>
                </a>
            @endauth

            {{-- Mobile Toggle --}}
            <button class="z-mobile-toggle" id="mobileToggle" aria-label="القائمة">
                <span></span><span></span><span></span>
            </button>

        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="z-mobile-menu" id="mobileMenu">
        <ul class="z-nav-links mb-3">
            <li><a href="{{ route('home') }}">الرئيسية</a></li>
            <li><a href="{{ route('home') }}#about">من نحن</a></li>
            <li><a href="{{ route('courses.index') }}">الدورات</a></li>
            <li><a href="{{ route('home') }}#services">خدماتنا</a></li>
            <li><a href="{{ route('home') }}#teachers">المعلمون</a></li>
            <li><a href="{{ route('home') }}#contact">تواصل معنا</a></li>
            <li class="exam-link"><a href="{{ route('exams.index') }}">الامتحانات</a></li>
        </ul>
        <div class="z-nav-actions border-top border-white border-opacity-10 pt-3 mt-2">
            @auth('student')
                <span class="text-white-50 small me-2">{{ auth('student')->user()->name }}</span>
                <form method="POST" action="{{ route('student.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-z btn-z-danger btn-z-sm">تسجيل الخروج</button>
                </form>
            @else
                <a href="{{ route('student.login') }}" class="btn-z btn-z-ghost btn-z-sm me-1">تسجيل الدخول</a>
                <a href="{{ route('student.register') }}" class="btn-z btn-z-accent btn-z-sm">إنشاء حساب</a>
            @endauth
        </div>
    </div>
</nav>
