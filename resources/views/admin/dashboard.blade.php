@extends('layouts.admin')

@section('content')
<!-- Admin Dashboard -->
<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #17324D; font-size: 32px;">Admin Dashboard</h1>
            <p class="text-muted mb-0">Manage properties, categories, and listing types</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 p-4 h-100" style="border-left: 4px solid #17324D;">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-home" style="font-size: 32px; color: #17324D;"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0" style="color: #17324D;">{{ $stats['total_properties'] }}</h3>
                        <p class="text-muted mb-0" style="font-size: 14px;">Total Properties</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 p-4 h-100" style="border-left: 4px solid #F59E0B;">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-clock" style="font-size: 32px; color: #F59E0B;"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0" style="color: #F59E0B;">{{ $stats['pending_properties'] }}</h3>
                        <p class="text-muted mb-0" style="font-size: 14px;">Pending Approval</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 p-4 h-100" style="border-left: 4px solid #10B981;">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-check-circle" style="font-size: 32px; color: #10B981;"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0" style="color: #10B981;">{{ $stats['approved_properties'] }}</h3>
                        <p class="text-muted mb-0" style="font-size: 14px;">Approved</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 p-4 h-100" style="border-left: 4px solid #EF4444;">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-times-circle" style="font-size: 32px; color: #EF4444;"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0" style="color: #EF4444;">{{ $stats['rejected_properties'] }}</h3>
                        <p class="text-muted mb-0" style="font-size: 14px;">Rejected</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h5 class="fw-bold mb-3" style="color: #17324D;">Quick Actions</h5>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.properties') }}" class="btn btn-sm rounded-2" style="background-color: #17324D; color: #FFFFFF;">
                        <i class="fas fa-list me-2"></i>Manage Properties
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-dark rounded-2" style="border-color: #17324D; color: #17324D;">
                        <i class="fas fa-tags me-2"></i>Categories
                    </a>
                    <a href="{{ route('admin.listing-types.index') }}" class="btn btn-sm btn-outline-dark rounded-2" style="border-color: #17324D; color: #17324D;">
                        <i class="fas fa-layer-group me-2"></i>Listing Types
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h5 class="fw-bold mb-3" style="color: #17324D;">System Stats</h5>
                <div class="d-flex justify-content-around">
                    <div class="text-center">
                        <h4 class="fw-bold mb-0" style="color: #315C7D;">{{ $stats['total_categories'] }}</h4>
                        <p class="text-muted mb-0" style="font-size: 13px;">Categories</p>
                    </div>
                    <div class="text-center">
                        <h4 class="fw-bold mb-0" style="color: #315C7D;">{{ $stats['total_listing_types'] }}</h4>
                        <p class="text-muted mb-0" style="font-size: 13px;">Listing Types</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Properties -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="fw-bold mb-0" style="color: #17324D;">Recent Properties</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #F5F7FA;">
                        <tr>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Property</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Owner</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Category</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Price</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Status</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($recentProperties->count() > 0)
                            @foreach($recentProperties as $property)
                            <tr>
                                <td class="py-3 px-4">
                                    <div>
                                        <h6 class="fw-bold mb-0" style="color: #202B38;">{{ $property->name }}</h6>
                                        <small class="text-muted">{{ $property->city }}</small>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span style="color: #6B7280;">{{ $property->owner->name ?? 'N/A' }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="badge bg-light text-secondary" style="border: 1px solid #E5E7EB;">
                                        {{ $property->category->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="fw-bold" style="color: #17324D;">${{ number_format($property->price, 2) }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    @if($property->status === 'pending')
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-1">Pending</span>
                                    @elseif($property->status === 'approved')
                                        <span class="badge bg-success rounded-pill px-3 py-1">Approved</span>
                                    @elseif($property->status === 'rejected')
                                        <span class="badge bg-danger rounded-pill px-3 py-1">Rejected</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('properties.show', $property->id) }}" class="btn btn-sm btn-outline-dark rounded-2" style="border-color: #E5E7EB; color: #6B7280;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="py-5 text-center text-muted">
                                    No properties found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
