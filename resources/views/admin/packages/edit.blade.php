@extends('admin.layouts.app')
@section('title', __('messages.edit_package'))

@section('content')

@php $selectedIds = old('course_ids', $package->courses->pluck('id')->all()); @endphp

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.edit_package') }}</h1>
        <p class="page-sub">{{ $package->title_ar }}</p>
    </div>
    <a href="{{ route('admin.packages.index') }}" class="btn-outline-sm">
        <i class="bi bi-arrow-left"></i> {{ __('messages.Back') }}
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger mb-3">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')

<div class="row g-3">

    {{-- Main Info --}}
    <div class="col-12 col-xl-8">
        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title">{{ __('messages.package_info') }}</h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.title_ar') }} <span class="text-danger">*</span></label>
                        <input type="text" name="title_ar" value="{{ old('title_ar', $package->title_ar) }}" class="form-control @error('title_ar') is-invalid @enderror" dir="rtl" required>
                        @error('title_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.title_en') }}</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $package->title_en) }}" class="form-control @error('title_en') is-invalid @enderror">
                        @error('title_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.description_ar') }}</label>
                        <textarea name="description_ar" rows="3" class="form-control" dir="rtl">{{ old('description_ar', $package->description_ar) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.description_en') }}</label>
                        <textarea name="description_en" rows="3" class="form-control">{{ old('description_en', $package->description_en) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title">{{ __('messages.eligible_courses') }}</h2></div>
            <div class="panel-card-body">
                <select name="course_ids[]" class="form-select @error('course_ids') is-invalid @enderror" multiple required>
                    @foreach($courses as $group => $groupCourses)
                        <optgroup label="{{ $group }}">
                            @foreach($groupCourses as $course)
                                <option value="{{ $course->id }}" @selected(in_array($course->id, $selectedIds))>
                                    {{ $course->title_en ?: $course->title_ar }} — {{ number_format($course->price, 2) }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @error('course_ids')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                @error('course_ids.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                <small class="text-muted d-block mt-1">{{ __('messages.eligible_courses_hint') }}</small>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-12 col-xl-4">

        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title">{{ __('messages.publish') }}</h2></div>
            <div class="panel-card-body">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ __('messages.published') }}</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_featured">{{ __('messages.featured') }}</label>
                </div>
                <button type="submit" class="btn-primary-sm w-100 mt-3 justify-content-center">
                    <i class="bi bi-save"></i> {{ __('messages.save_package') }}
                </button>
            </div>
        </div>

        <div class="panel-card mb-3">
            <div class="panel-card-header"><h2 class="panel-card-title">{{ __('messages.package') }}</h2></div>
            <div class="panel-card-body">
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.pick_count') }} <span class="text-danger">*</span></label>
                    <input type="number" name="pick_count" value="{{ old('pick_count', $package->pick_count) }}" min="1" max="20"
                           class="form-control @error('pick_count') is-invalid @enderror" required>
                    @error('pick_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <small class="text-muted">{{ __('messages.pick_count_hint') }}</small>
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label">{{ __('messages.price') }} <span class="text-danger">*</span></label>
                        <input type="number" name="price" value="{{ old('price', $package->price) }}" min="0" step="0.01"
                               class="form-control @error('price') is-invalid @enderror" required>
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">{{ __('messages.old_price_usd') }}</label>
                        <input type="number" name="old_price" value="{{ old('old_price', $package->old_price) }}" min="0" step="0.01" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ __('messages.sort_order_label') }}</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $package->sort_order) }}" min="0" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title">{{ __('messages.thumbnail') }}</h2></div>
            <div class="panel-card-body">
                @if($package->image)
                    <img src="{{ asset('assets/uploads/packages/'.$package->image) }}" class="img-fluid rounded mb-2" alt="">
                @endif
                <input type="file" name="image" accept="image/*" class="form-control">
            </div>
        </div>

    </div>
</div>

</form>
@endsection
