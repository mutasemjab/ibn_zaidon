<footer class="z-footer">
    <div class="container">
        <div class="row g-5">

            {{-- Brand --}}
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <h3><span style="color:var(--z-highlight)">ز</span> زيدون التعليمية</h3>
                    <p>منصة تعليمية متكاملة تقدم دورات، امتحانات، وأوراق عمل للمرحلة الأساسية والتوجيهي في المملكة الأردنية الهاشمية.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="social-link" aria-label="فيسبوك"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link" aria-label="يوتيوب"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-link" aria-label="انستغرام"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link" aria-label="واتساب"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="social-link" aria-label="تيليغرام"><i class="bi bi-telegram"></i></a>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="footer-head">روابط سريعة</h6>
                <a href="{{ route('home') }}" class="footer-link">الرئيسية</a>
                <a href="{{ route('home') }}#about" class="footer-link">من نحن</a>
                <a href="{{ route('courses.index') }}" class="footer-link">الدورات التعليمية</a>
                <a href="{{ route('exams.index') }}" class="footer-link">الامتحانات</a>
                <a href="{{ route('home') }}#teachers" class="footer-link">المعلمون</a>
                <a href="{{ route('home') }}#contact" class="footer-link">تواصل معنا</a>
            </div>

            {{-- Services --}}
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="footer-head">خدماتنا</h6>
                <a href="{{ route('home') }}#services" class="footer-link">أوراق العمل</a>
                <a href="{{ route('home') }}#services" class="footer-link">أسئلة سنوات سابقة</a>
                <a href="{{ route('home') }}#services" class="footer-link">بنك الأسئلة</a>
                <a href="{{ route('home') }}#services" class="footer-link">نقاط بيع البطاقات</a>
                <a href="{{ route('home') }}#services" class="footer-link">الدورات المباشرة</a>
            </div>

            {{-- Contact --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-head">معلومات التواصل</h6>
                <div class="d-flex align-items-start gap-2 mb-2">
                    <i class="bi bi-geo-alt text-warning mt-1"></i>
                    <span style="font-size:.86rem; color:rgba(255,255,255,.6)">الأردن — عمّان، المملكة الأردنية الهاشمية</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-telephone text-warning"></i>
                    <a href="tel:+962XXXXXXXX" class="footer-link p-0" dir="ltr">+962 XX XXXX XXX</a>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-envelope text-warning"></i>
                    <a href="mailto:info@zaidon.jo" class="footer-link p-0">info@zaidon.jo</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clock text-warning"></i>
                    <span style="font-size:.86rem; color:rgba(255,255,255,.6)">السبت–الخميس، 8ص–6م</span>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} زيدون التعليمية. جميع الحقوق محفوظة.</span>
            <div class="pay-logos">
                <span class="pay-logo">VISA</span>
                <span class="pay-logo">MC</span>
                <span class="pay-logo">CliQ</span>
                <span class="pay-logo">CASH</span>
            </div>
        </div>
    </div>
</footer>
