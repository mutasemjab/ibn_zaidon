@extends('admin.layouts.app')
@section('title', __('messages.packages_title'))

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">{{ __('messages.packages_title') }}</h1>
        <p class="page-sub">{{ __('messages.manage_packages_desc') }}</p>
    </div>
    @can('package-add')
    <a href="{{ route('admin.packages.create') }}" class="btn-primary-sm">
        <i class="bi bi-plus-circle"></i> {{ __('messages.add_package') }}
    </a>
    @endcan
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-8">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="{{ __('messages.search_title_ph') }}">
            </div>
            <div class="col-12 col-md-2">
                <button type="submit" class="btn-primary-sm w-100"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="panel-card">
    <div class="panel-card-body p-0">
        <div style="overflow-x:auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('messages.package') }}</th>
                        <th>{{ __('messages.pick_count') }}</th>
                        <th>{{ __('messages.courses_count') }}</th>
                        <th>{{ __('messages.price') }}</th>
                        <th>{{ __('messages.Status') }}</th>
                        <th>{{ __('messages.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $package)
                    <tr>
                        <td style="color:var(--muted)">{{ $package->id }}</td>
                        <td>
                            <div style="font-weight:500">{{ Str::limit($package->title_en ?: $package->title_ar, 35) }}</div>
                            <div style="font-size:.72rem;color:var(--muted)">{{ $package->title_ar }}</div>
                        </td>
                        <td>{{ $package->pick_count }}</td>
                        <td>{{ $package->courses_count }}</td>
                        <td>
                            <span style="font-weight:600">{{ number_format($package->price, 2) }}</span>
                            @if($package->old_price)
                                <span style="text-decoration:line-through;color:var(--muted);font-size:.78rem">{{ number_format($package->old_price, 2) }}</span>
                            @endif
                        </td>
                        <td>
                            <span class="pill {{ $package->is_active ? 'pill-success' : 'pill-neutral' }}">
                                {{ $package->is_active ? __('messages.published') : __('messages.draft') }}
                            </span>
                            @if($package->is_featured)
                                <span class="pill pill-warning">{{ __('messages.featured') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                @can('package-edit')
                                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn-outline-sm" style="padding:4px 8px" title="{{ __('messages.Edit') }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @endcan
                                @can('package-delete')
                                <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST"
                                      onsubmit="return confirm('{{ __('messages.delete_package_confirm') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca" title="{{ __('messages.Delete') }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4" style="color:var(--muted)">{{ __('messages.no_packages_found') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $packages->withQueryString()->links() }}</div>
    </div>
</div>

@endsection
