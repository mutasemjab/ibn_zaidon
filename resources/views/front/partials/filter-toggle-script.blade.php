@push('scripts')
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
@endpush
