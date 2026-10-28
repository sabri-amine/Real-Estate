@extends('layouts.app')
@section('content')
<script>
function confirmDeleteProperty(propertyId) {
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
            document.getElementById('deletePropertyForm' + propertyId).submit();
        }
    });
}
</script>
<div class="container-xxl py-5" style="background-color: #F8FAFC; min-height: 100vh;">
    <div class="container">
        <!-- Profile Header -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="bg-white rounded-4 shadow-sm overflow-hidden" style="border: 1px solid #E5E7EB;">
                    <div class="row g-0">
                        <!-- Profile Image Section -->
                        <div class="col-lg-4 d-flex align-items-center justify-content-center p-5" style="background: linear-gradient(135deg, #1A365D 0%, #2C5282 100%);">
                            <div class="text-center">
                                <div class="position-relative d-inline-block mb-4">
                                    @if ($user->image)
                                        <img src="{{ asset('storage/users/' . $user->image) }}"
                                             alt="{{ $user->name }}"
                                             class="rounded-circle border-4"
                                             style="width: 150px; height: 150px; object-fit: cover; border-color: white; box-shadow: 0 8px 24px rgba(0,0,0,0.2);">
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center border-4"
                                             style="width: 150px; height: 150px; background-color: #E2E8F0; border-color: white; box-shadow: 0 8px 24px rgba(0,0,0,0.2);">
                                            <i class="fas fa-user" style="font-size: 50px; color: #A0AEC0;"></i>
                                        </div>
                                    @endif
                                    <button class="position-absolute bottom-0 end-0 btn btn-light rounded-circle shadow"
                                            style="width: 40px; height: 40px; border: none;"
                                            onclick="window.location.href='{{ route('profile.edit', $user->id) }}'">
                                        <i class="fas fa-camera" style="color: #1A365D; font-size: 14px;"></i>
                                    </button>
                                </div>
                                <h4 class="text-white fw-bold mb-2">{{ $user->name }}</h4>
                                <p class="text-white mb-0" style="opacity: 0.9;">{{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- Profile Info Section -->
                        <div class="col-lg-8 p-5">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h2 class="fw-bold mb-2" style="color: #1A365D; font-size: 28px;">My Profile</h2>
                                    <p style="color: #718096;">Manage your account and properties</p>
                                </div>
                                <a href="{{ route('profile.edit', $user->id) }}"
                                   class="btn btn-primary rounded-pill px-4 py-2 fw-semibold"
                                   style="background-color: #1A365D; border: none; box-shadow: 0 4px 12px rgba(26, 54, 93, 0.2);">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </a>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #F7FAFC;">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 45px; height: 45px; background-color: #EBF8FF;">
                                            <i class="fas fa-user-tag" style="color: #3182CE; font-size: 18px;"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold" style="color: #2D3748; font-size: 14px;">Role</p>
                                            <p class="mb-0" style="color: #718096; font-size: 13px;">
                                                @if ($user->roles->count() > 0)
                                                    {{ $user->roles->first()->name }}
                                                @else
                                                    User
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #F7FAFC;">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 45px; height: 45px; background-color: #EBF8FF;">
                                            <i class="fas fa-calendar-alt" style="color: #3182CE; font-size: 18px;"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold" style="color: #2D3748; font-size: 14px;">Member Since</p>
                                            <p class="mb-0" style="color: #718096; font-size: 13px;">
                                                {{ $user->created_at ? $user->created_at->format('F Y') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #F7FAFC;">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 45px; height: 45px; background-color: #FAF5FF;">
                                            <i class="fas fa-home" style="color: #805AD5; font-size: 18px;"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold" style="color: #2D3748; font-size: 14px;">Total Properties</p>
                                            <p class="mb-0" style="color: #718096; font-size: 13px;">{{ $pubs->count() }} properties</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background-color: #F7FAFC;">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 45px; height: 45px; background-color: #F0FFF4;">
                                            <i class="fas fa-envelope" style="color: #38A169; font-size: 18px;"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold" style="color: #2D3748; font-size: 14px;">Email</p>
                                            <p class="mb-0" style="color: #718096; font-size: 13px;">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-10">
                <div class="bg-white rounded-4 shadow-sm p-2" style="border: 1px solid #E5E7EB;">
                    <ul class="nav nav-pills nav-fill gap-2" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active rounded-3 px-4 py-3 fw-semibold"
                                    id="properties-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#properties"
                                    type="button"
                                    role="tab"
                                    style="background-color: #1A365D; color: white; border: none;">
                                <i class="fas fa-building me-2"></i>My Properties
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link rounded-3 px-4 py-3 fw-semibold"
                                    id="info-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#info"
                                    type="button"
                                    role="tab"
                                    style="color: #4A5568; border: none;">
                                <i class="fas fa-user me-2"></i>Personal Info
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="tab-content" id="profileTabsContent">
                    <!-- My Properties Tab -->
                    <div class="tab-pane fade show active" id="properties" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold mb-0" style="color: #1A365D;">My Properties</h4>
                            <a href="{{ route('createproperties') }}"
                               class="btn btn-primary rounded-pill px-4 py-2 fw-semibold"
                               style="background-color: #1A365D; border: none;">
                                <i class="fas fa-plus me-2"></i>Add Property
                            </a>
                        </div>

                        @if ($pubs->total() > 0)
                            <div class="row g-4">
                                @foreach ($pubs as $pub)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="bg-white rounded-4 overflow-hidden shadow-sm property-card"
                                             style="border: 1px solid #E5E7EB; transition: all 0.3s ease;">
                                            <div class="position-relative" style="height: 220px;">
                                                @if ($pub->images->count() > 0)
                                                    <img class="img-fluid w-100 h-100"
                                                         src="{{ asset('images/' . $pub->images->first()->image_path) }}"
                                                         alt="{{ $pub->name }}"
                                                         style="object-fit: cover;">
                                                @else
                                                    <img class="img-fluid w-100 h-100"
                                                         src="{{ asset('img/generic.jpg') }}"
                                                         alt="{{ $pub->name }}"
                                                         style="object-fit: cover;">
                                                @endif

                                                @if ($pub->listingType->name == 'sell')
                                                    <span class="position-absolute top-3 left-3 px-3 py-2 rounded-pill text-white fw-bold"
                                                          style="background-color: #1A365D; font-size: 12px;">
                                                        For Sale
                                                    </span>
                                                @else
                                                    <span class="position-absolute top-3 left-3 px-3 py-2 rounded-pill text-white fw-bold"
                                                          style="background-color: #F57C00; font-size: 12px;">
                                                        For Rent
                                                    </span>
                                                @endif

                                                @if ($pub->status === 'pending')
                                                    <span class="position-absolute top-3 right-3 px-3 py-2 rounded-pill text-white fw-bold"
                                                          style="background-color: #F59E0B; font-size: 12px;">
                                                        <i class="fas fa-clock me-1"></i>En attente
                                                    </span>
                                                @elseif ($pub->status === 'approved')
                                                    <span class="position-absolute top-3 right-3 px-3 py-2 rounded-pill text-white fw-bold"
                                                          style="background-color: #10B981; font-size: 12px;">
                                                        <i class="fas fa-check me-1"></i>Validé
                                                    </span>
                                                @elseif ($pub->status === 'rejected')
                                                    <span class="position-absolute top-3 right-3 px-3 py-2 rounded-pill text-white fw-bold"
                                                          style="background-color: #EF4444; font-size: 12px;">
                                                        <i class="fas fa-times me-1"></i>Rejeté
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="p-4">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h5 class="fw-bold mb-0" style="color: #1A365D; font-size: 16px;">
                                                        {{ Str::limit($pub->name, 30) }}
                                                    </h5>
                                                    <span class="fw-bold" style="color: #1A365D; font-size: 18px;">
                                                        ${{ number_format($pub->price, 2) }}
                                                    </span>
                                                </div>
                                                <p class="mb-3" style="color: #718096; font-size: 13px;">
                                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $pub->city }}, {{ $pub->address }}
                                                </p>
                                                <div class="d-flex gap-3 mb-3" style="color: #4A5568; font-size: 12px;">
                                                    <span><i class="fas fa-bed me-1"></i>{{ $pub->bedrooms }} bed</span>
                                                    <span><i class="fas fa-bath me-1"></i>{{ $pub->bathrooms }} bath</span>
                                                    <span><i class="fas fa-ruler-combined me-1"></i>{{ $pub->size }} sqft</span>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('properties.show', $pub->id) }}"
                                                       class="btn btn-outline-primary btn-sm flex-fill rounded-3 py-2 fw-semibold"
                                                       style="border-color: #1A365D; color: #1A365D;">
                                                        View
                                                    </a>
                                                    <a href="{{ route('editproperty', $pub->id) }}"
                                                       class="btn btn-primary btn-sm flex-fill rounded-3 py-2 fw-semibold"
                                                       style="background-color: #1A365D; border: none;">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('deleteproperty', $pub->id) }}"
                                                          method="POST"
                                                          class="d-inline"
                                                          id="deletePropertyForm{{ $pub->id }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="button"
                                                                onclick="confirmDeleteProperty({{ $pub->id }})"
                                                                class="btn btn-outline-danger btn-sm rounded-3 py-2 px-3"
                                                                style="border-color: #E53E3E; color: #E53E3E;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-5">
                                <nav aria-label="Property pagination">
                                    <ul class="pagination mb-0">
                                        {{-- Previous Button --}}
                                        @if ($pubs->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link rounded-3" style="background-color: #F7FAFC; border-color: #E5E7EB; color: #CBD5E0;">
                                                    <i class="fas fa-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link rounded-3" href="{{ $pubs->previousPageUrl() }}" style="border-color: #E5E7EB; color: #1A365D;">
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Page Numbers --}}
                                        @foreach ($pubs->getUrlRange(1, $pubs->lastPage()) as $page => $url)
                                            @if ($page == $pubs->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link rounded-3" style="background-color: #1A365D; border-color: #1A365D; color: white;">
                                                        {{ $page }}
                                                    </span>
                                                </li>
                                            @elseif ($url)
                                                <li class="page-item">
                                                    <a class="page-link rounded-3" href="{{ $url }}" style="border-color: #E5E7EB; color: #4A5568;">
                                                        {{ $page }}
                                                    </a>
                                                </li>
                                            @else
                                                <li class="page-item disabled">
                                                    <span class="page-link rounded-3" style="background-color: #F7FAFC; border-color: #E5E7EB; color: #CBD5E0;">
                                                        {{ $page }}
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Button --}}
                                        @if ($pubs->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link rounded-3" href="{{ $pubs->nextPageUrl() }}" style="border-color: #E5E7EB; color: #1A365D;">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link rounded-3" style="background-color: #F7FAFC; border-color: #E5E7EB; color: #CBD5E0;">
                                                    <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>

                            <!-- Page Info -->
                            <div class="text-center mt-3">
                                <p class="mb-0" style="color: #718096; font-size: 13px;">
                                    Showing {{ $pubs->firstItem() ?? 0 }} to {{ $pubs->lastItem() ?? 0 }} of {{ $pubs->total() }} properties
                                </p>
                            </div>
                        @else
                            <div class="bg-white rounded-4 p-5 text-center shadow-sm" style="border: 1px solid #E5E7EB;">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4"
                                     style="width: 100px; height: 100px; background-color: #F7FAFC;">
                                    <i class="fas fa-home" style="font-size: 40px; color: #CBD5E0;"></i>
                                </div>
                                <h4 class="fw-bold mb-3" style="color: #2D3748;">No Properties Yet</h4>
                                <p class="mb-4" style="color: #718096;">You haven't listed any properties yet. Start by creating your first property.</p>
                                <a href="{{ route('createproperties') }}"
                                   class="btn btn-primary rounded-pill px-5 py-3 fw-semibold"
                                   style="background-color: #1A365D; border: none;">
                                    <i class="fas fa-plus me-2"></i>Create Property
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Personal Info Tab -->
                    <div class="tab-pane fade" id="info" role="tabpanel">
                        <div class="bg-white rounded-4 p-5 shadow-sm" style="border: 1px solid #E5E7EB;">
                            <h4 class="fw-bold mb-4" style="color: #1A365D;">Personal Information</h4>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #2D3748;">Full Name</label>
                                    <p class="p-3 rounded-3 mb-0" style="background-color: #F7FAFC; color: #4A5568;">
                                        {{ $user->name }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #2D3748;">Email Address</label>
                                    <p class="p-3 rounded-3 mb-0" style="background-color: #F7FAFC; color: #4A5568;">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #2D3748;">Role</label>
                                    <p class="p-3 rounded-3 mb-0" style="background-color: #F7FAFC; color: #4A5568;">
                                        @if ($user->roles->count() > 0)
                                            {{ $user->roles->first()->name }}
                                        @else
                                            User
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold" style="color: #2D3748;">Member Since</label>
                                    <p class="p-3 rounded-3 mb-0" style="background-color: #F7FAFC; color: #4A5568;">
                                        {{ $user->created_at ? $user->created_at->format('F d, Y') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('profile.edit', $user->id) }}"
                                   class="btn btn-primary rounded-pill px-5 py-3 fw-semibold"
                                   style="background-color: #1A365D; border: none;">
                                    <i class="fas fa-edit me-2"></i>Edit Information
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.property-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.nav-link:not(.active):hover {
    background-color: #F7FAFC !important;
    color: #1A365D !important;
}

.nav-link.active {
    background-color: #1A365D !important;
    color: white !important;
}

.rounded-4 {
    border-radius: 16px;
}

.rounded-3 {
    border-radius: 12px;
}

.rounded-pill {
    border-radius: 50px;
}

.shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

/* Custom Pagination Styles */
.pagination {
    gap: 8px;
}

.pagination .page-link {
    color: #1A365D;
    border: 1px solid #E5E7EB;
    padding: 10px 16px;
    font-weight: 500;
    transition: all 0.3s ease;
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.pagination .page-link:hover {
    background-color: #1A365D;
    color: white;
    border-color: #1A365D;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(26, 54, 93, 0.2);
}

.pagination .page-item.active .page-link {
    background-color: #1A365D;
    border-color: #1A365D;
    color: white;
    box-shadow: 0 4px 8px rgba(26, 54, 93, 0.2);
}

.pagination .page-item.disabled .page-link {
    color: #CBD5E0;
    border-color: #E5E7EB;
    background-color: #F7FAFC;
    cursor: not-allowed;
}

/* Responsive adjustments */
@media (max-width: 991px) {
    .col-lg-4.p-5 {
        padding: 3rem !important;
    }
}

@media (max-width: 767px) {
    .col-lg-4.p-5 {
        padding: 2rem !important;
    }

    .col-lg-8.p-5 {
        padding: 2rem !important;
    }

    .pagination .page-link {
        padding: 8px 12px;
        font-size: 14px;
    }
}
</style>
@endsection
