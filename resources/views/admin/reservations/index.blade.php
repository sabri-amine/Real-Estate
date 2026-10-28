@extends('layouts.admin')

@section('content')
@php
use Illuminate\Support\Str;
use Carbon\Carbon;
@endphp
<!-- Admin Reservations Management -->
<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #17324D; font-size: 32px;">Gestion des Réservations</h1>
            <p class="text-muted mb-0">Consultez et gérez toutes les réservations de propriétés</p>
        </div>
    </div>

    <!-- Status Filter -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-3">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.reservations') }}" class="btn btn-sm rounded-2 {{ request('filter') === null ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('filter') === null ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Toutes
                </a>
                <a href="{{ route('admin.reservations', ['filter' => 'available']) }}" class="btn btn-sm rounded-2 {{ request('filter') === 'available' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('filter') === 'available' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Disponibles
                </a>
                <a href="{{ route('admin.reservations', ['filter' => 'reserved']) }}" class="btn btn-sm rounded-2 {{ request('filter') === 'reserved' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('filter') === 'reserved' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Réservées
                </a>
                <a href="{{ route('admin.reservations', ['filter' => 'upcoming']) }}" class="btn btn-sm rounded-2 {{ request('filter') === 'upcoming' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('filter') === 'upcoming' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    À venir
                </a>
                <a href="{{ route('admin.reservations', ['filter' => 'completed']) }}" class="btn btn-sm rounded-2 {{ request('filter') === 'completed' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('filter') === 'completed' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Terminées
                </a>
            </div>
        </div>
    </div>

    <!-- Properties with Reservations Table -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #F5F7FA;">
                        <tr>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Propriété</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Propriétaire</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Statut</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Réservation</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Client</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Personnes</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Date</th>
                            <th class="py-3 px-4" style="color: #202B38; font-weight: 600;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($properties->count() > 0)
                            @foreach($properties as $property)
                            <tr>
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($property->images->count() > 0)
                                            <img src="{{ asset('images/' . $property->images->first()->image_path) }}"
                                                 alt="{{ $property->name }}"
                                                 class="rounded-2"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="rounded-2 d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px; background-color: #F7FAFC;">
                                                <i class="fas fa-home" style="color: #CBD5E0;"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="fw-bold mb-0" style="color: #202B38;">{{ $property->name }}</h6>
                                            <small class="text-muted">{{ $property->city }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span style="color: #6B7280;">{{ $property->owner->name ?? 'N/A' }}</span>
                                    <br>
                                    <small class="text-muted">{{ $property->owner->email ?? 'N/A' }}</small>
                                </td>
                                <td class="py-3 px-4">
                                    @php
                                        $today = Carbon::today();
                                        $activeReservation = $property->reservations()
                                            ->confirmed()
                                            ->where('check_in_date', '<=', $today)
                                            ->where('check_out_date', '>=', $today)
                                            ->first();
                                    @endphp
                                    @if($activeReservation)
                                        <span class="badge bg-danger rounded-pill px-3 py-1">Réservée</span>
                                    @else
                                        <span class="badge bg-success rounded-pill px-3 py-1">Disponible</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($activeReservation)
                                        <div>
                                            <small class="text-muted">Arrivée:</small>
                                            <div class="fw-semibold" style="color: #202B38;">{{ $activeReservation->check_in_date->format('d/m/Y') }}</div>
                                            <small class="text-muted">Départ:</small>
                                            <div class="fw-semibold" style="color: #202B38;">{{ $activeReservation->check_out_date->format('d/m/Y') }}</div>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($activeReservation)
                                        <span style="color: #6B7280;">{{ $activeReservation->user->name ?? 'N/A' }}</span>
                                        <br>
                                        <small class="text-muted">{{ $activeReservation->user->email ?? 'N/A' }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($activeReservation)
                                        <span class="fw-bold" style="color: #17324D;">{{ $activeReservation->number_of_guests }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($activeReservation)
                                        <small class="text-muted">{{ $activeReservation->created_at->format('d/m/Y H:i') }}</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('properties.show', $property->id) }}" class="btn btn-sm btn-outline-dark rounded-2" style="border-color: #E5E7EB; color: #6B7280;" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($activeReservation)
                                            <a href="{{ route('reservations.index') }}" class="btn btn-sm btn-outline-primary rounded-2" style="border-color: #E5E7EB; color: #6B7280;" title="Détails réservation">
                                                <i class="fas fa-calendar-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="py-5 text-center text-muted">
                                    Aucune propriété trouvée
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
