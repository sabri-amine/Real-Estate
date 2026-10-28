@extends('layouts.admin')

@section('content')
<!-- Admin Notifications -->
<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold" style="color: #17324D; font-size: 32px;">Notifications</h1>
            <p class="text-muted mb-0">Gérez toutes les notifications du système</p>
        </div>
        @if(auth()->user()->unreadNotifications()->count() > 0)
            <form action="{{ route('notifications.markAllRead') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold" style="background-color: #17324D; border: none;">
                    <i class="fas fa-check-double me-2"></i>Tout marquer comme lu
                </button>
            </form>
        @endif
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-3">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('notifications.index') }}" class="btn btn-sm rounded-2 {{ request('type') === null ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('type') === null ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Toutes
                </a>
                <a href="{{ route('notifications.index', ['type' => 'unread']) }}" class="btn btn-sm rounded-2 {{ request('type') === 'unread' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('type') === 'unread' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Non lues
                </a>
                <a href="{{ route('notifications.index', ['type' => 'pending']) }}" class="btn btn-sm rounded-2 {{ request('type') === 'pending' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('type') === 'pending' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    En attente
                </a>
                <a href="{{ route('notifications.index', ['type' => 'approved']) }}" class="btn btn-sm rounded-2 {{ request('type') === 'approved' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('type') === 'approved' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Approuvées
                </a>
                <a href="{{ route('notifications.index', ['type' => 'rejected']) }}" class="btn btn-sm rounded-2 {{ request('type') === 'rejected' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('type') === 'rejected' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Rejetées
                </a>
                <a href="{{ route('notifications.index', ['type' => 'reservation']) }}" class="btn btn-sm rounded-2 {{ request('type') === 'reservation' ? 'btn-dark' : 'btn-outline-dark' }}" style="{{ request('type') === 'reservation' ? 'background-color: #17324D; color: #FFFFFF;' : 'border-color: #17324D; color: #17324D;' }}">
                    Réservations
                </a>
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    @if($notifications->count() > 0)
        <div class="row g-3">
            @foreach($notifications as $notification)
                @if(request('type') === null || request('type') === 'unread' && !$notification->is_read || request('type') === $notification->type)
                <div class="col-12">
                    <div class="card rounded-3 shadow-sm {{ !$notification->is_read ? 'border-2' : '' }}" style="{{ !$notification->is_read ? 'border-color: #17324D; border-left-width: 4px;' : 'border: 1px solid #E5E7EB;' }}">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="badge bg-{{ $notification->badge_color }} rounded-pill px-3 py-1">
                                            {{ $notification->type_label }}
                                        </span>
                                        @if(!$notification->is_read)
                                            <span class="badge bg-primary rounded-pill px-2 py-1" style="font-size: 11px;">
                                                Nouveau
                                            </span>
                                        @endif
                                        <small class="text-muted ms-auto">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <h5 class="fw-bold mb-2" style="color: #17324D;">{{ $notification->title }}</h5>
                                    <p class="mb-3" style="color: #4A5568;">{{ $notification->message }}</p>
                                    @if($notification->rejection_reason)
                                        <div class="alert alert-warning rounded-2 p-2" style="font-size: 13px;">
                                            <strong>Motif :</strong> {{ $notification->rejection_reason }}
                                        </div>
                                    @endif
                                    @if($notification->type === 'reservation' && $notification->reservation)
                                        <div class="alert alert-info rounded-2 p-2" style="font-size: 13px;">
                                            <strong>Détails de la réservation :</strong><br>
                                            Arrivée : {{ $notification->reservation->check_in_date->format('d/m/Y') }}<br>
                                            Départ : {{ $notification->reservation->check_out_date->format('d/m/Y') }}<br>
                                            Personnes : {{ $notification->reservation->number_of_guests }}
                                        </div>
                                    @endif
                                    <div class="d-flex gap-2 mt-3">
                                        @if($notification->property_id)
                                            <a href="{{ route('properties.show', $notification->property_id) }}" class="btn btn-sm btn-outline-primary rounded-2" style="border-color: #17324D; color: #17324D;">
                                                <i class="fas fa-eye me-1"></i>Voir la propriété
                                            </a>
                                        @endif
                                        @if($notification->type === 'reservation' && $notification->reservation)
                                            <a href="{{ route('reservations.index') }}" class="btn btn-sm btn-outline-secondary rounded-2">
                                                <i class="fas fa-calendar-alt me-1"></i>Voir les réservations
                                            </a>
                                        @endif
                                        @if(!$notification->is_read)
                                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-2">
                                                    <i class="fas fa-check me-1"></i>Marquer comme lu
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette notification ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-2">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-bell-slash" style="font-size: 64px; color: #CBD5E0;"></i>
            <h4 class="mt-4" style="color: #718096;">Aucune notification</h4>
            <p style="color: #A0AEC0;">Vous n'avez pas encore de notifications.</p>
        </div>
    @endif
</div>
@endsection
