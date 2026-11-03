@extends('admin.layouts.app')
@section('title', __('messages.static_pages'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.static_pages') }}</h1>
        <p class="page-sub">{{ __('messages.static_pages_sub') }}</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="panel-card">
    <div class="panel-card-body p-0">
        <div style="overflow-x:auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.page_slug') }}</th>
                        <th>{{ __('messages.title_ar') }}</th>
                        <th>{{ __('messages.title_en') }}</th>
                        <th>{{ __('messages.page_last_updated') }}</th>
                        <th>{{ __('messages.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td><code>{{ $page->slug }}</code></td>
                        <td>{{ $page->title_ar }}</td>
                        <td>{{ $page->title_en ?: '—' }}</td>
                        <td style="color:var(--muted)">{{ $page->updated_at?->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn-outline-sm" style="padding:4px 8px" title="{{ __('messages.Edit') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4" style="color:var(--muted)">—</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
