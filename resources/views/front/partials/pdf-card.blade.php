<div class="pdf-card {{ $colorClass ?? '' }}">
    <div class="pdf-card-icon">
        <i class="bi {{ $icon ?? 'bi-file-earmark-pdf' }}"></i>
    </div>
    <div class="pdf-card-body">
        @if($tag ?? null)
            <span class="pdf-tag">{{ $tag }}</span>
        @endif
        <h6 class="pdf-title">{{ $title }}</h6>
        @if(($subject ?? null) || ($year ?? null))
        <div class="pdf-meta">
            @if($subject ?? null)
                <span><i class="bi bi-book"></i> {{ $subject }}</span>
            @endif
            @if($year ?? null)
                <span><i class="bi bi-calendar3"></i> {{ $year }}</span>
            @endif
        </div>
        @endif
        @if($pages ?? null)
            <div class="pdf-pages"><i class="bi bi-file-text"></i> {{ $pages }} {{ __('front.pdf_pages_label') }}</div>
        @endif
    </div>
    <div class="pdf-card-foot">
        <a href="{{ $pdfUrl }}" target="_blank" class="btn-z btn-z-primary btn-z-sm btn-z-block">
            <i class="bi bi-download"></i> {{ __('front.pdf_download_btn') }}
        </a>
    </div>
</div>
