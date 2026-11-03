@extends('admin.layouts.app')
@section('title', __('messages.static_pages'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.static_pages') }}</h1>
        <p class="page-sub"><code>{{ $page->slug }}</code></p>
    </div>
    <a href="{{ route('admin.pages.index') }}" class="btn-outline-sm">
        <i class="bi bi-arrow-left"></i> {{ __('messages.Back') }}
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger mb-3">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
@csrf @method('PUT')

<div class="panel-card mb-3">
    <div class="panel-card-header"><h2 class="panel-card-title">{{ __('messages.page_title_ar') }} / {{ __('messages.page_title_en') }}</h2></div>
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">{{ __('messages.page_title_ar') }} <span class="text-danger">*</span></label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $page->title_ar) }}" class="form-control @error('title_ar') is-invalid @enderror" dir="rtl" required>
                @error('title_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">{{ __('messages.page_title_en') }}</label>
                <input type="text" name="title_en" value="{{ old('title_en', $page->title_en) }}" class="form-control @error('title_en') is-invalid @enderror">
                @error('title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="panel-card mb-3">
    <div class="panel-card-header"><h2 class="panel-card-title">{{ __('messages.page_body_ar') }}</h2></div>
    <div class="panel-card-body">
        <textarea name="body_ar" rows="12" class="form-control @error('body_ar') is-invalid @enderror" dir="rtl">{{ old('body_ar', $page->body_ar) }}</textarea>
        @error('body_ar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
</div>

<div class="panel-card mb-3">
    <div class="panel-card-header"><h2 class="panel-card-title">{{ __('messages.page_body_en') }}</h2></div>
    <div class="panel-card-body">
        <textarea name="body_en" rows="12" class="form-control @error('body_en') is-invalid @enderror">{{ old('body_en', $page->body_en) }}</textarea>
        @error('body_en')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
    </div>
</div>

<button type="submit" class="btn-primary-sm">
    <i class="bi bi-save"></i> {{ __('messages.Save') }}
</button>

</form>
@endsection
