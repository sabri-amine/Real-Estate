@extends('layouts.app')

@section('content')
<div class="container-xxl py-5" style="background-color: #F8FAFC; min-height: 100vh;">
    <div class="container">
        <!-- Header -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="bg-white rounded-4 shadow-sm p-5" style="border: 1px solid #E5E7EB;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="fw-bold mb-2" style="color: #1A365D; font-size: 32px;">Mes Réservations</h1>
                            <p style="color: #718096;">Gérez vos réservations de propriétés</p>
                        </div>
                    </div>

                    <!-- Liste des réservations -->
                    @if($reservations->count() > 0)
                        <div class="row g-3">
                            @foreach($reservations as $reservation)
                            <div class="col-12">
                                <div class="card rounded-3 shadow-sm" style="border: 1px solid #E5E7EB;">
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <div class="col-md-4 mb-3 mb-md-0">
                                                @if ($reservation->property->images->count() > 0)
                                                    <img src="{{ asset('images/' . $reservation->property->images->first()->image_path) }}"
                                                         alt="{{ $reservation->property->name }}"
                                                         class="img-fluid rounded-2"
                                                         style="height: 150px; object-fit: cover; width: 100%;">
                                                @else
                                                    <img src="{{ asset('img/generic.jpg') }}"
                                                         alt="{{ $reservation->property->name }}"
                                                         class="img-fluid rounded-2"
                                                         style="height: 150px; object-fit: cover; width: 100%;">
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h5 class="fw-bold mb-1" style="color: #1A365D;">{{ $reservation->property->name }}</h5>
                                                        <p class="mb-0" style="color: #718096; font-size: 14px;">
                                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $reservation->property->city }}, {{ $reservation->property->address }}
                                                        </p>
                                                    </div>
                                                    <span class="badge rounded-pill px-3 py-2 @if($reservation->status === 'confirmed') bg-success @elseif($reservation->status === 'cancelled') bg-danger @else bg-warning text-dark @endif">
                                                        @if($reservation->status === 'confirmed')
                                                            Confirmée
                                                        @elseif($reservation->status === 'cancelled')
                                                            Annulée
                                                        @else
                                                            En attente
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="row g-3 mb-3">
                                                    <div class="col-6">
                                                        <div class="p-2 rounded-2" style="background-color: #F7FAFC;">
                                                            <small style="color: #718096; font-size: 12px;">Arrivée</small>
                                                            <div class="fw-semibold" style="color: #1A365D;">{{ $reservation->check_in_date->format('d/m/Y') }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="p-2 rounded-2" style="background-color: #F7FAFC;">
                                                            <small style="color: #718096; font-size: 12px;">Départ</small>
                                                            <div class="fw-semibold" style="color: #1A365D;">{{ $reservation->check_out_date->format('d/m/Y') }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center gap-2 mb-3">
                                                    <i class="fas fa-users" style="color: #1A365D;"></i>
                                                    <span style="color: #4A5568; font-size: 14px;">{{ $reservation->number_of_guests }} personne(s)</span>
                                                </div>

                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('properties.show', $reservation->property_id) }}" class="btn btn-sm btn-outline-primary rounded-2" style="border-color: #1A365D; color: #1A365D;">
                                                        <i class="fas fa-eye me-1"></i>Voir la propriété
                                                    </a>
                                                    @if($reservation->status === 'confirmed')
                                                        <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-2">
                                                                <i class="fas fa-times me-1"></i>Annuler
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-alt" style="font-size: 64px; color: #CBD5E0;"></i>
                            <h4 class="mt-4" style="color: #718096;">Aucune réservation</h4>
                            <p style="color: #A0AEC0;">Vous n'avez pas encore de réservations.</p>
                            <a href="{{ route('properties.index') }}" class="btn btn-primary rounded-pill px-4 py-2 mt-3" style="background-color: #1A365D; border: none;">
                                <i class="fas fa-search me-2"></i>Explorer les propriétés
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
