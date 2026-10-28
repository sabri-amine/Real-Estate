@extends('layouts.app')

@section('content')
<script>
function confirmDeletePropertyShow(propertyId) {
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
            document.getElementById('deletePropertyFormShow' + propertyId).submit();
        }
    });
}
</script>
<div class="property-details-page" style="background-color: #FAFAFA; min-height: 100vh;">
    <!-- Breadcrumb -->
    <div class="container-fluid py-3" style="background-color: #FFFFFF; border-bottom: 1px solid #E5E5E5;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 14px;">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}" style="color: #1A365D; text-decoration: none;">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('properties.index') }}" style="color: #1A365D; text-decoration: none;">Properties</a></li>
                    <li class="breadcrumb-item active" style="color: #666666;">{{ $property->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Photo Gallery -->
                <div class="mb-5">
                    <div class="row g-2">
                        <!-- Main Photo -->
                        <div class="col-12">
                            <div class="position-relative overflow-hidden rounded-3" style="height: 500px;">
                                @if ($property->images->count() > 0)
                                    <img id="mainPhoto" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;" src="{{ asset('images/' . $property->images->first()->image_path) }}" alt="{{ $property->name }}">
                                @else
                                    <img id="mainPhoto" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;" src="{{ asset('img/generic.jpg') }}" alt="{{ $property->name }}">
                                @endif
                                <button class="btn btn-light position-absolute bottom-4 right-4 rounded-pill px-4 py-2 shadow" onclick="showAllPhotos()" style="background-color: rgba(255,255,255,0.95);">
                                    <i class="fas fa-images me-2"></i>View all photos
                                </button>
                            </div>
                        </div>
                        <!-- Secondary Photos -->
                        @if ($property->images->count() > 1)
                            <div class="col-12 mt-2">
                                <div class="row g-2">
                                    @foreach ($property->images->slice(1, 4) as $index => $image)
                                        <div class="col-3">
                                            <div class="position-relative overflow-hidden rounded-2" style="height: 120px; cursor: pointer;">
                                                <img class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;" src="{{ asset('images/' . $image->image_path) }}" alt="" onclick="changeMainPhoto('{{ asset('images/' . $image->image_path) }}')" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($property->images->count() > 5)
                                        <div class="col-3">
                                            <div class="position-relative overflow-hidden rounded-2 h-100" style="height: 120px; cursor: pointer; background-color: #1A365D;">
                                                <div class="d-flex align-items-center justify-content-center h-100">
                                                    <span class="text-white fw-bold">+{{ $property->images->count() - 5 }} more</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Property Header -->
                <div class="mb-5">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <h1 class="mb-2" style="font-size: 32px; font-weight: 600; color: #1A365D; line-height: 1.3;">{{ $property->name }}</h1>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fas fa-map-marker-alt" style="color: #1A365D;"></i>
                                <span style="color: #666666; font-size: 15px;">{{ $property->address }}, {{ $property->city }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge rounded-pill px-3 py-2" style="background-color: #F0F4F8; color: #1A365D; font-size: 13px;">
                                    <i class="fas fa-building me-1"></i>{{ $property->category->name }}
                                </span>
                                @if ($property->listingType->name == 'sell')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #E8F5E9; color: #2E7D32; font-size: 13px;">
                                        <i class="fas fa-tag me-1"></i>For Sale
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #FFF3E0; color: #F57C00; font-size: 13px;">
                                        <i class="fas fa-key me-1"></i>For Rent
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px; border-color: #E5E5E5;">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px; border-color: #E5E5E5;">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="mb-5">
                    <h2 class="mb-4" style="font-size: 24px; font-weight: 600; color: #1A365D;">Property Details</h2>
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="p-4 rounded-3" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #F0F4F8;">
                                        <i class="fas fa-ruler-combined" style="color: #1A365D; font-size: 18px;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #1A365D; font-size: 18px;">{{ $property->size }}</div>
                                        <div style="color: #999999; font-size: 13px;">Square Feet</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-4 rounded-3" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #F0F4F8;">
                                        <i class="fas fa-bed" style="color: #1A365D; font-size: 18px;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #1A365D; font-size: 18px;">{{ $property->bedrooms }}</div>
                                        <div style="color: #999999; font-size: 13px;">Bedrooms</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-4 rounded-3" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #F0F4F8;">
                                        <i class="fas fa-bath" style="color: #1A365D; font-size: 18px;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #1A365D; font-size: 18px;">{{ $property->bathrooms }}</div>
                                        <div style="color: #999999; font-size: 13px;">Bathrooms</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-4 rounded-3" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #F0F4F8;">
                                        <i class="fas fa-building" style="color: #1A365D; font-size: 18px;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold" style="color: #1A365D; font-size: 18px;">{{ $property->category->name }}</div>
                                        <div style="color: #999999; font-size: 13px;">Category</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <h2 class="mb-4" style="font-size: 24px; font-weight: 600; color: #1A365D;">About this property</h2>
                    <div class="p-5 rounded-3" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                        <p style="color: #333333; font-size: 16px; line-height: 1.8;">{{ $property->description }}</p>
                    </div>
                </div>

                <!-- Amenities -->
                <div class="mb-5">
                    <h2 class="mb-4" style="font-size: 24px; font-weight: 600; color: #1A365D;">Amenities</h2>
                    <div class="p-5 rounded-3" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                        <div class="row g-4">
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fas fa-wifi" style="color: #1A365D; font-size: 20px;"></i>
                                    <span style="color: #333333; font-size: 15px;">Free Wi-Fi</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fas fa-swimming-pool" style="color: #1A365D; font-size: 20px;"></i>
                                    <span style="color: #333333; font-size: 15px;">Swimming Pool</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fas fa-parking" style="color: #1A365D; font-size: 20px;"></i>
                                    <span style="color: #333333; font-size: 15px;">Free Parking</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fas fa-snowflake" style="color: #1A365D; font-size: 20px;"></i>
                                    <span style="color: #333333; font-size: 15px;">Air Conditioning</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fas fa-utensils" style="color: #1A365D; font-size: 20px;"></i>
                                    <span style="color: #333333; font-size: 15px;">Restaurant</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fas fa-coffee" style="color: #1A365D; font-size: 20px;"></i>
                                    <span style="color: #333333; font-size: 15px;">Breakfast</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="mb-5">
                    <h2 class="mb-4" style="font-size: 24px; font-weight: 600; color: #1A365D;">Location</h2>
                    <div class="p-5 rounded-3" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                        <div class="d-flex align-items-start gap-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 56px; height: 56px; background-color: #F0F4F8;">
                                <i class="fas fa-map-marker-alt" style="color: #1A365D; font-size: 24px;"></i>
                            </div>
                            <div>
                                <h4 class="mb-2" style="color: #1A365D; font-size: 18px; font-weight: 600;">{{ $property->city }}</h4>
                                <p style="color: #666666; font-size: 15px; margin-bottom: 0;">{{ $property->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Owner -->
                <div class="mb-5">
                    <h2 class="mb-4" style="font-size: 24px; font-weight: 600; color: #1A365D;">Property Owner</h2>
                    <div class="p-5 rounded-3" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                        <div class="d-flex align-items-center gap-4">
                            @if ($property->owner->image)
                                <img class="rounded-circle" src="{{ asset('storage/' . $property->owner->image) }}" alt="{{ $property->owner->name }}" style="width: 72px; height: 72px; object-fit: cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 72px; height: 72px; background-color: #F0F4F8;">
                                    <i class="fas fa-user" style="color: #1A365D; font-size: 32px;"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <h4 class="mb-1" style="color: #1A365D; font-size: 18px; font-weight: 600;">{{ $property->owner->name }}</h4>
                                <p style="color: #999999; font-size: 14px; margin-bottom: 0;">Property Owner</p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="mailto:{{ $property->owner->email }}" class="btn btn-outline-primary rounded-pill px-4 py-2" style="border-color: #1A365D; color: #1A365D;">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </a>
                                <a href="tel:+1234567890" class="btn btn-primary rounded-pill px-4 py-2" style="background-color: #1A365D; border-color: #1A365D;">
                                    <i class="fas fa-phone me-2"></i>Call
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Booking Card -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <div class="rounded-3 p-5 shadow" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-baseline mb-2">
                                <span style="color: #666666; font-size: 15px;">Price</span>
                                <div class="text-end">
                                    <span class="fw-bold" style="color: #1A365D; font-size: 28px;">${{ number_format($property->price, 2) }}</span>
                                    @if ($property->listingType->name == 'rent')
                                        <span style="color: #999999; font-size: 14px;">/ night</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge rounded-pill" style="background-color: #E8F5E9; color: #2E7D32; font-size: 12px;">
                                    <i class="fas fa-check-circle me-1"></i>{{ $property->listingType->name }}
                                </span>
                            </div>
                        </div>

                        <hr style="border-color: #E5E5E5; margin: 20px 0;">

                        @if(auth()->check() && auth()->user()->id !== $property->user_id)
                            <form action="{{ route('reservations.store', $property->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label mb-2" style="color: #333333; font-size: 14px; font-weight: 500;">Date d'arrivée (Check-in)</label>
                                    <input type="date" name="check_in_date" id="check_in_date" class="form-control rounded-2" style="border-color: #E5E5E5; padding: 12px;" required min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-2" style="color: #333333; font-size: 14px; font-weight: 500;">Date de départ (Check-out)</label>
                                    <input type="date" name="check_out_date" id="check_out_date" class="form-control rounded-2" style="border-color: #E5E5E5; padding: 12px;" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-2" style="color: #333333; font-size: 14px; font-weight: 500;">Nombre de personnes</label>
                                    <select name="number_of_guests" class="form-select rounded-2" style="border-color: #E5E5E5; padding: 12px;" required>
                                        <option value="1">1 personne</option>
                                        <option value="2">2 personnes</option>
                                        <option value="3">3 personnes</option>
                                        <option value="4">4 personnes</option>
                                        <option value="5">5 personnes</option>
                                        <option value="6">6 personnes</option>
                                        <option value="7">7 personnes</option>
                                        <option value="8">8 personnes</option>
                                        <option value="9">9 personnes</option>
                                        <option value="10">10+ personnes</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn w-100 py-3 rounded-2 fw-bold" style="background-color: #1A365D; border-color: #1A365D; color: #FFFFFF; font-size: 16px;">
                                    Réserver
                                </button>
                            </form>
                        @elseif(auth()->check() && auth()->user()->id === $property->user_id)
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle" style="font-size: 48px; color: #1A365D;"></i>
                                <p class="mt-3 mb-0" style="color: #666666;">Vous êtes le propriétaire de cette propriété.</p>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="mb-3" style="color: #666666;">Connectez-vous pour réserver cette propriété.</p>
                                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2" style="background-color: #1A365D; border: none;">
                                    Se connecter
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    @if (auth()->user() && auth()->user()->id === $property->user_id)
                        <div class="rounded-3 p-5 shadow mt-4" style="background-color: #FFFFFF; border: 1px solid #E5E5E5;">
                            <h3 class="mb-4" style="font-size: 20px; font-weight: 600; color: #1A365D;">Owner Actions</h3>
                            <div class="d-grid gap-2">
                                <a href="{{ route('editproperty', $property->id) }}" class="btn btn-outline-primary rounded-2 py-3" style="border-color: #1A365D; color: #1A365D;">
                                    <i class="fas fa-edit me-2"></i>Edit Property
                                </a>
                                <form action="{{ route('deleteproperty', $property->id) }}" method="POST" id="deletePropertyFormShow{{ $property->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDeletePropertyShow({{ $property->id }})" class="btn btn-outline-danger rounded-2 py-3 w-100" style="border-color: #DC3545; color: #DC3545;">
                                        <i class="fas fa-trash me-2"></i>Delete Property
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Photo Gallery Modal -->
<div class="modal fade" id="photoGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content rounded-3" style="background-color: #1A365D;">
            <div class="modal-header border-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" class="img-fluid w-100" style="max-height: 80vh; object-fit: contain;" src="" alt="">
            </div>
        </div>
    </div>
</div>

<script>
function changeMainPhoto(src) {
    document.getElementById('mainPhoto').src = src;
}

function showAllPhotos() {
    const modal = new bootstrap.Modal(document.getElementById('photoGalleryModal'));
    const mainPhoto = document.getElementById('mainPhoto');
    document.getElementById('modalImage').src = mainPhoto.src;
    modal.show();
}

// Validation des dates de réservation et gestion des dates bloquées
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in_date');
    const checkOutInput = document.getElementById('check_out_date');
    const propertyId = {{ $property->id }};

    if (checkInInput && checkOutInput) {
        // Récupérer les dates bloquées depuis l'API
        fetch(`/api/properties/${propertyId}/blocked-dates`)
            .then(response => response.json())
            .then(data => {
                const blockedDates = data.blocked_dates || [];
                const blockedDateSet = new Set();

                // Créer un ensemble de toutes les dates bloquées
                blockedDates.forEach(period => {
                    const start = new Date(period.start);
                    const end = new Date(period.end);
                    const current = new Date(start);

                    while (current < end) {
                        blockedDateSet.add(current.toISOString().split('T')[0]);
                        current.setDate(current.getDate() + 1);
                    }
                });

                // Fonction pour vérifier si une date est bloquée
                function isDateBlocked(dateStr) {
                    return blockedDateSet.has(dateStr);
                }

                // Validation du check-in
                checkInInput.addEventListener('change', function() {
                    if (isDateBlocked(this.value)) {
                        Swal.fire({
                            title: 'Date non disponible',
                            text: 'Cette date est déjà réservée. Veuillez choisir une autre date.',
                            icon: 'warning',
                            confirmButtonColor: '#1A365D',
                            confirmButtonText: 'OK'
                        });
                        this.value = '';
                        return;
                    }

                    checkOutInput.min = this.value;
                    if (checkOutInput.value && checkOutInput.value <= this.value) {
                        checkOutInput.value = '';
                    }
                });

                // Validation du check-out
                checkOutInput.addEventListener('change', function() {
                    if (!checkInInput.value) {
                        Swal.fire({
                            title: 'Date d\'arrivée requise',
                            text: 'Veuillez d\'abord sélectionner une date d\'arrivée.',
                            icon: 'warning',
                            confirmButtonColor: '#1A365D',
                            confirmButtonText: 'OK'
                        });
                        this.value = '';
                        return;
                    }

                    // Vérifier que la date de départ n'est pas bloquée
                    const current = new Date(checkInInput.value);
                    const end = new Date(this.value);

                    while (current < end) {
                        const dateStr = current.toISOString().split('T')[0];
                        if (isDateBlocked(dateStr)) {
                            Swal.fire({
                                title: 'Période non disponible',
                                text: 'La période sélectionnée contient des dates déjà réservées. Veuillez choisir une autre période.',
                                icon: 'warning',
                                confirmButtonColor: '#1A365D',
                                confirmButtonText: 'OK'
                            });
                            this.value = '';
                            return;
                        }
                        current.setDate(current.getDate() + 1);
                    }
                });
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des dates bloquées:', error);
            });
    }
});
</script>

<style>
.property-details-page {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

.rounded-3 {
    border-radius: 16px;
}

.rounded-2 {
    border-radius: 12px;
}

.rounded-pill {
    border-radius: 50px;
}

.shadow {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.btn-primary:hover {
    background-color: #15294A;
    border-color: #15294A;
}

.btn-outline-primary:hover {
    background-color: #1A365D;
    color: #FFFFFF;
}
</style>
@endsection
