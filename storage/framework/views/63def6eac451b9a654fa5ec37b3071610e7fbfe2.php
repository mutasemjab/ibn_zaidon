<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    var btn  = document.getElementById('filterToggle');
    var side = document.getElementById('coursesSidebar');
    var chev = document.getElementById('filterChevron');
    if (!btn || !side) return;
    btn.addEventListener('click', function () {
        var open = side.classList.toggle('open');
        chev.className = open ? 'bi bi-chevron-up ms-auto' : 'bi bi-chevron-down ms-auto';
    });
})();
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\front\partials\filter-toggle-script.blade.php ENDPATH**/ ?>