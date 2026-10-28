@extends('layouts.admin')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<!-- Admin Properties Management -->
<div>
<script>
function confirmApprove(propertyId) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: 'Voulez-vous vraiment approuver cette propriété ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirmer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('approveForm' + propertyId).submit();
        }
    });
}

function confirmPending(propertyId) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: 'Voulez-vous vraiment remettre cette propriété en attente ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirmer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#dc3545',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('pendingForm' + propertyId).submit();
        }
    });
}

function confirmDelete(propertyId) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: 'Cette action est irréversible. Voulez-vous vraiment supprimer cette propriété ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Supprimer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm' + propertyId).submit();
        }
    });
}
</script>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #17324D; font-size: 32px;">Manage Properties</h1>
            <p class="text-muted mb-0">Review, approve, or reject property listings</p>
        </div>
    </div>

        <!-- Status Filter -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-3">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.properties') }}" class="btn btn-sm rounded-2 {{ request('status') === null ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('status') === null ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                        All
                    </a>
                    <a href="{{ route('admin.properties', ['status' => 'pending']) }}" class="btn btn-sm rounded-2 {{ request('status') === 'pending' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('status') === 'pending' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                        Pending
                    </a>
                    <a href="{{ route('admin.properties', ['status' => 'approved']) }}" class="btn btn-sm rounded-2 {{ request('status') === 'approved' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('status') === 'approved' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                        Approved
                    </a>
                    <a href="{{ route('admin.properties', ['status' => 'rejected']) }}" class="btn btn-sm rounded-2 {{ request('status') === 'rejected' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('status') === 'rejected' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                        Rejected
                    </a>
                </div>
            </div>
        </div>

        <!-- Properties Table -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #F5F7FA;">
                            <tr>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Property</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Owner</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Category</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Type</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Price</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Status</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($properties->count() > 0)
                                @foreach($properties as $property)
                                <tr>
                                    <td class="py-3 px-4">
                                        <div>
                                            <h6 class="fw-bold mb-0" style="color: #202B38;">{{ $property->name }}</h6>
                                            <small class="text-muted">{{ $property->city }}, {{ $property->address }}</small>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span style="color: #6B7280;">{{ $property->owner->name ?? 'N/A' }}</span>
                                        <br>
                                        <small class="text-muted">{{ $property->owner->email ?? 'N/A' }}</small>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="badge bg-light text-secondary" style="border: 1px solid #E5E7EB;">
                                            {{ $property->category->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="badge bg-light text-secondary" style="border: 1px solid #E5E7EB;">
                                            {{ $property->listingType->name ?? 'N/A' }}
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
                                            @if($property->rejection_reason)
                                                <small class="d-block text-muted mt-1" style="font-size: 11px;">{{ Str::limit($property->rejection_reason, 50) }}</small>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('properties.show', $property->id) }}" class="btn btn-sm btn-outline-dark rounded-2" style="border-color: #E5E7EB; color: #6B7280;" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($property->status === 'pending')
                                                <form action="{{ route('admin.properties.approve', $property->id) }}" method="POST" class="d-inline" id="approveForm{{ $property->id }}">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-success rounded-2" title="Approve" onclick="confirmApprove({{ $property->id }})">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-sm btn-danger rounded-2" title="Reject" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $property->id }}">
                                                    <i class="fas fa-times"></i>
                                                </button>

                                                <!-- Rejection Modal -->
                                                <div class="modal fade" id="rejectModal{{ $property->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-bold" style="color: #17324D;">Reject Property</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p class="text-muted mb-3">Please provide a reason for rejecting this property:</p>
                                                                    <div class="mb-3">
                                                                        <label for="rejection_reason{{ $property->id }}" class="form-label fw-semibold" style="color: #17324D;">Rejection Reason (Optional)</label>
                                                                        <textarea class="form-control" id="rejection_reason{{ $property->id }}" name="rejection_reason" rows="3" placeholder="Enter the reason for rejection..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary rounded-2" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger rounded-2">Reject Property</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($property->status === 'approved')
                                                <button type="button" class="btn btn-sm btn-danger rounded-2" title="Reject" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $property->id }}">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <form action="{{ route('admin.properties.pending', $property->id) }}" method="POST" class="d-inline" id="pendingForm{{ $property->id }}">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-warning rounded-2" title="Set to Pending" onclick="confirmPending({{ $property->id }})">
                                                        <i class="fas fa-clock"></i>
                                                    </button>
                                                </form>

                                                <!-- Rejection Modal for Approved Property -->
                                                <div class="modal fade" id="rejectModal{{ $property->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-bold" style="color: #17324D;">Reject Property</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p class="text-muted mb-3">This property is currently approved. Please provide a reason for rejecting it:</p>
                                                                    <div class="mb-3">
                                                                        <label for="rejection_reason{{ $property->id }}" class="form-label fw-semibold" style="color: #17324D;">Rejection Reason (Optional)</label>
                                                                        <textarea class="form-control" id="rejection_reason{{ $property->id }}" name="rejection_reason" rows="3" placeholder="Enter the reason for rejection..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary rounded-2" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger rounded-2">Reject Property</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($property->status === 'rejected')
                                                <form action="{{ route('admin.properties.pending', $property->id) }}" method="POST" class="d-inline" id="pendingForm{{ $property->id }}">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-warning rounded-2" title="Set to Pending" onclick="confirmPending({{ $property->id }})">
                                                        <i class="fas fa-clock"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.properties.delete', $property->id) }}" method="POST" class="d-inline" id="deleteForm{{ $property->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-2" title="Delete" onclick="confirmDelete({{ $property->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="py-5 text-center text-muted">
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
