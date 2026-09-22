<div class="pdf-card <?php echo e($colorClass ?? ''); ?>">
    <div class="pdf-card-icon">
        <i class="bi <?php echo e($icon ?? 'bi-file-earmark-pdf'); ?>"></i>
    </div>
    <div class="pdf-card-body">
        <?php if($tag ?? null): ?>
            <span class="pdf-tag"><?php echo e($tag); ?></span>
        <?php endif; ?>
        <h6 class="pdf-title"><?php echo e($title); ?></h6>
        <?php if(($subject ?? null) || ($year ?? null)): ?>
        <div class="pdf-meta">
            <?php if($subject ?? null): ?>
                <span><i class="bi bi-book"></i> <?php echo e($subject); ?></span>
            <?php endif; ?>
            <?php if($year ?? null): ?>
                <span><i class="bi bi-calendar3"></i> <?php echo e($year); ?></span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if($pages ?? null): ?>
            <div class="pdf-pages"><i class="bi bi-file-text"></i> <?php echo e($pages); ?> <?php echo e(__('front.pdf_pages_label')); ?></div>
        <?php endif; ?>
    </div>
    <div class="pdf-card-foot">
        <a href="<?php echo e($pdfUrl); ?>" target="_blank" class="btn-z btn-z-primary btn-z-sm btn-z-block">
            <i class="bi bi-download"></i> <?php echo e(__('front.pdf_download_btn')); ?>

        </a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\partials\pdf-card.blade.php ENDPATH**/ ?>