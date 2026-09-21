@php
    use App\Models\SiteSetting;
    $siteName   = SiteSetting::val('site_name')        ?: __('front.site_name');
    $footerDesc = SiteSetting::val('footer_description');
    $phone      = SiteSetting::raw('contact_phone');
    $email      = SiteSetting::raw('contact_email');
    $hours      = SiteSetting::val('contact_hours');
    $address    = SiteSetting::val('contact_address');
    $fb         = SiteSetting::raw('social_facebook');
    $yt         = SiteSetting::raw('social_youtube');
    $ig         = SiteSetting::raw('social_instagram');
    $wa         = SiteSetting::raw('social_whatsapp');
    $tg         = SiteSetting::raw('social_tiktok');
@endphp

<footer class="z-footer">
    <div class="container">
        <div class="row g-5">

            {{-- Brand --}}
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <h3><span style="color:var(--z-highlight)">{{ mb_substr($siteName, 0, 1) }}</span> {{ $siteName }}</h3>
                    <p>{{ $footerDesc }}</p>
                    <div class="social-links mt-3">
                        @if($fb)<a href="{{ $fb }}" class="social-link" aria-label="Facebook" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>@endif
                        @if($yt)<a href="{{ $yt }}" class="social-link" aria-label="YouTube" target="_blank" rel="noopener"><i class="bi bi-youtube"></i></a>@endif
                        @if($ig)<a href="{{ $ig }}" class="social-link" aria-label="Instagram" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>@endif
                        @if($wa)<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa) }}" class="social-link" aria-label="WhatsApp" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a>@endif
                        @if($tg)<a href="{{ $tg }}" class="social-link" aria-label="TikTok" target="_blank" rel="noopener"><i class="bi bi-tiktok"></i></a>@endif
                        {{-- Show placeholder icons when no social links set yet --}}
                        @if(!$fb && !$yt && !$ig && !$wa && !$tg)
                            <a href="#" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                            <a href="#" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-link" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="footer-head">{{ __('front.footer_quick_links') }}</h6>
                <a href="{{ route('home') }}" class="footer-link">{{ __('front.footer_home_link') }}</a>
                <a href="{{ route('home') }}#about" class="footer-link">{{ __('front.footer_about_link') }}</a>
                <a href="{{ route('courses.index') }}" class="footer-link">{{ __('front.footer_courses_link') }}</a>
                <a href="{{ route('exams.index') }}" class="footer-link">{{ __('front.footer_exams_link') }}</a>
                <a href="{{ route('home') }}#teachers" class="footer-link">{{ __('front.footer_teachers_link') }}</a>
                <a href="{{ route('home') }}#contact" class="footer-link">{{ __('front.footer_contact_link') }}</a>
            </div>

            {{-- Services --}}
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="footer-head">{{ __('front.footer_services_col') }}</h6>
                <a href="{{ route('home') }}#services" class="footer-link">{{ __('front.footer_worksheets_link') }}</a>
                <a href="{{ route('home') }}#services" class="footer-link">{{ __('front.footer_prev_q_link') }}</a>
                <a href="{{ route('home') }}#services" class="footer-link">{{ __('front.footer_qbank_link') }}</a>
                <a href="{{ route('home') }}#services" class="footer-link">{{ __('front.footer_card_sales_link') }}</a>
                <a href="{{ route('home') }}#services" class="footer-link">{{ __('front.footer_live_courses_link') }}</a>
            </div>

            {{-- Contact --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-head">{{ __('front.footer_contact_col') }}</h6>
                @if($address)
                <div class="d-flex align-items-start gap-2 mb-2">
                    <i class="bi bi-geo-alt text-warning mt-1"></i>
                    <span style="font-size:.86rem; color:rgba(255,255,255,.6)">{{ $address }}</span>
                </div>
                @endif
                @if($phone)
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-telephone text-warning"></i>
                    <a href="tel:{{ $phone }}" class="footer-link p-0" dir="ltr">{{ $phone }}</a>
                </div>
                @endif
                @if($email)
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-envelope text-warning"></i>
                    <a href="mailto:{{ $email }}" class="footer-link p-0">{{ $email }}</a>
                </div>
                @endif
                @if($hours)
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clock text-warning"></i>
                    <span style="font-size:.86rem; color:rgba(255,255,255,.6)">{{ $hours }}</span>
                </div>
                @endif
            </div>

        </div>

        <div class="footer-bottom">
            <span>{{ str_replace(':year', date('Y'), __('front.footer_copyright')) }}</span>
            <div class="pay-logos">
                <span class="pay-logo">{{ __('front.pay_visa') }}</span>
                <span class="pay-logo">{{ __('front.pay_mc') }}</span>
                <span class="pay-logo">{{ __('front.pay_cliq') }}</span>
                <span class="pay-logo">{{ __('front.pay_cash') }}</span>
            </div>
        </div>
    </div>
</footer>
