@extends('layouts.admin')

@section('content')
<!-- Admin Listing Types Management -->
<div>
<script>
function confirmDeleteListingType(listingTypeId) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: 'Cette action est irréversible. Voulez-vous vraiment supprimer ce type d\'annonce ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Supprimer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteListingTypeForm' + listingTypeId).submit();
        }
    });
}
</script>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #17324D; font-size: 32px;">Listing Types</h1>
            <p class="text-muted mb-0">Manage property listing types (Sale, Rent, etc.)</p>
        </div>
        <a href="{{ route('admin.listing-types.create') }}" class="btn rounded-2" style="background-color: #17324D; color: #FFFFFF;">
            <i class="fas fa-plus me-2"></i>Add New Type
        </a>
    </div>

        <!-- Listing Types Table -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #F5F7FA;">
                            <tr>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">ID</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Name</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Properties Count</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Created At</th>
                                <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($listingTypes->count() > 0)
                                @foreach($listingTypes as $listingType)
                                <tr>
                                    <td class="py-3 px-4">
                                        <span class="fw-bold" style="color: #202B38;">#{{ $listingType->id }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <h6 class="fw-bold mb-0" style="color: #202B38;">{{ $listingType->name }}</h6>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="badge bg-light text-secondary" style="border: 1px solid #E5E7EB;">
                                            {{ $listingType->properties()->count() }} Properties
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <small class="text-muted">{{ $listingType->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.listing-types.edit', $listingType->id) }}" class="btn btn-sm btn-outline-dark rounded-2" style="border-color: #E5E7EB; color: #6B7280;" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.listing-types.destroy', $listingType->id) }}" method="POST" class="d-inline" id="deleteListingTypeForm{{ $listingType->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-2" title="Delete" onclick="confirmDeleteListingType({{ $listingType->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="py-5 text-center text-muted">
                                        No listing types found
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
