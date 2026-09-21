@php
    $key   = $f['key'];
    $label = $f['label'][$loc] ?? $f['label']['en'];
    $hint  = $f['hint'][$loc] ?? null;
    $row   = $settings->get($key);
    $type  = $f['type'];
@endphp

@if($f['bilingual'])
    @foreach(['ar', 'en'] as $lang)
        @php
            $name = "{$key}_{$lang}";
            $val  = old($name, $lang === 'ar' ? $row?->value_ar : $row?->value_en);
            $dir  = $lang === 'ar' ? 'rtl' : 'ltr';
        @endphp
        <div class="col-md-6">
            <label class="form-label">{{ $label }} ({{ strtoupper($lang) }})</label>
            @if($type === 'textarea')
                <textarea name="{{ $name }}" dir="{{ $dir }}" rows="{{ $f['rows'] ?? 3 }}"
                          class="form-control @error($name) is-invalid @enderror">{{ $val }}</textarea>
            @else
                <input type="text" name="{{ $name }}" dir="{{ $dir }}" value="{{ $val }}"
                       class="form-control @error($name) is-invalid @enderror">
            @endif
            @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
            @if($hint)<small class="text-muted">{{ $hint }}</small>@endif
        </div>
    @endforeach
@else
    <div class="col-md-{{ $f['col'] ?? 6 }}">
        <label class="form-label">
            @if(!empty($f['icon']))<i class="bi {{ $f['icon'] }}"></i>@endif
            {{ $label }}
        </label>

        @if($type === 'image')
            <input type="file" name="{{ $key }}" accept="image/*"
                   class="form-control @error($key) is-invalid @enderror">
            @if($row?->value_ar)
                <img src="{{ asset('assets/uploads/site/' . $row->value_ar) }}" alt=""
                     class="mt-2" style="height:80px;border-radius:6px;object-fit:cover">
            @endif
            <small class="text-muted d-block">{{ __('messages.leave_empty_keep_file') }}</small>
        @else
            @php
                $htmlType = match ($type) { 'url' => 'url', 'email' => 'email', 'number' => 'number', default => 'text' };
                $val      = old($key, $row?->value_ar);
            @endphp
            <input type="{{ $htmlType }}" name="{{ $key }}" value="{{ $val }}"
                   @if($type === 'number') min="0" @endif
                   @if(!empty($f['placeholder'])) placeholder="{{ $f['placeholder'] }}" @elseif($type === 'url') placeholder="https://..." @endif
                   @if(in_array($type, ['url', 'email', 'number', 'icon'], true)) dir="ltr" @endif
                   class="form-control @error($key) is-invalid @enderror">
        @endif

        @error($key)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        @if($hint)<small class="text-muted d-block">{{ $hint }}</small>@endif
    </div>
@endif
