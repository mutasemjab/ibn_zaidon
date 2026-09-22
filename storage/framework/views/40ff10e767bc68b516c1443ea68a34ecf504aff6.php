<?php
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
?>

<footer class="z-footer">
    <div class="container">
        <div class="row g-5">

            
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <h3><span style="color:var(--z-highlight)"><?php echo e(mb_substr($siteName, 0, 1)); ?></span> <?php echo e($siteName); ?></h3>
                    <p><?php echo e($footerDesc); ?></p>
                    <div class="social-links mt-3">
                        <?php if($fb): ?><a href="<?php echo e($fb); ?>" class="social-link" aria-label="Facebook" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a><?php endif; ?>
                        <?php if($yt): ?><a href="<?php echo e($yt); ?>" class="social-link" aria-label="YouTube" target="_blank" rel="noopener"><i class="bi bi-youtube"></i></a><?php endif; ?>
                        <?php if($ig): ?><a href="<?php echo e($ig); ?>" class="social-link" aria-label="Instagram" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a><?php endif; ?>
                        <?php if($wa): ?><a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $wa)); ?>" class="social-link" aria-label="WhatsApp" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a><?php endif; ?>
                        <?php if($tg): ?><a href="<?php echo e($tg); ?>" class="social-link" aria-label="TikTok" target="_blank" rel="noopener"><i class="bi bi-tiktok"></i></a><?php endif; ?>
                        
                        <?php if(!$fb && !$yt && !$ig && !$wa && !$tg): ?>
                            <a href="#" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                            <a href="#" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-link" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="footer-head"><?php echo e(__('front.footer_quick_links')); ?></h6>
                <a href="<?php echo e(route('home')); ?>" class="footer-link"><?php echo e(__('front.footer_home_link')); ?></a>
                <a href="<?php echo e(route('home')); ?>#about" class="footer-link"><?php echo e(__('front.footer_about_link')); ?></a>
                <a href="<?php echo e(route('courses.index')); ?>" class="footer-link"><?php echo e(__('front.footer_courses_link')); ?></a>
                <a href="<?php echo e(route('exams.index')); ?>" class="footer-link"><?php echo e(__('front.footer_exams_link')); ?></a>
                <a href="<?php echo e(route('home')); ?>#teachers" class="footer-link"><?php echo e(__('front.footer_teachers_link')); ?></a>
                <a href="<?php echo e(route('home')); ?>#contact" class="footer-link"><?php echo e(__('front.footer_contact_link')); ?></a>
            </div>

            
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="footer-head"><?php echo e(__('front.footer_services_col')); ?></h6>
                <a href="<?php echo e(route('home')); ?>#services" class="footer-link"><?php echo e(__('front.footer_worksheets_link')); ?></a>
                <a href="<?php echo e(route('home')); ?>#services" class="footer-link"><?php echo e(__('front.footer_prev_q_link')); ?></a>
                <a href="<?php echo e(route('home')); ?>#services" class="footer-link"><?php echo e(__('front.footer_qbank_link')); ?></a>
                <a href="<?php echo e(route('home')); ?>#services" class="footer-link"><?php echo e(__('front.footer_card_sales_link')); ?></a>
                <a href="<?php echo e(route('home')); ?>#services" class="footer-link"><?php echo e(__('front.footer_live_courses_link')); ?></a>
            </div>

            
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-head"><?php echo e(__('front.footer_contact_col')); ?></h6>
                <?php if($address): ?>
                <div class="d-flex align-items-start gap-2 mb-2">
                    <i class="bi bi-geo-alt text-warning mt-1"></i>
                    <span style="font-size:.86rem; color:rgba(255,255,255,.6)"><?php echo e($address); ?></span>
                </div>
                <?php endif; ?>
                <?php if($phone): ?>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-telephone text-warning"></i>
                    <a href="tel:<?php echo e($phone); ?>" class="footer-link p-0" dir="ltr"><?php echo e($phone); ?></a>
                </div>
                <?php endif; ?>
                <?php if($email): ?>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-envelope text-warning"></i>
                    <a href="mailto:<?php echo e($email); ?>" class="footer-link p-0"><?php echo e($email); ?></a>
                </div>
                <?php endif; ?>
                <?php if($hours): ?>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-clock text-warning"></i>
                    <span style="font-size:.86rem; color:rgba(255,255,255,.6)"><?php echo e($hours); ?></span>
                </div>
                <?php endif; ?>
            </div>

        </div>

        <div class="footer-bottom">
            <span><?php echo e(str_replace(':year', date('Y'), __('front.footer_copyright'))); ?></span>
            <div class="pay-logos">
                <span class="pay-logo"><?php echo e(__('front.pay_visa')); ?></span>
                <span class="pay-logo"><?php echo e(__('front.pay_mc')); ?></span>
                <span class="pay-logo"><?php echo e(__('front.pay_cliq')); ?></span>
                <span class="pay-logo"><?php echo e(__('front.pay_cash')); ?></span>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\includes\footer.blade.php ENDPATH**/ ?>