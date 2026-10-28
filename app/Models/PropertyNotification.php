<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'reservation_id',
        'type',
        'title',
        'message',
        'is_read',
        'rejection_reason'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Relation avec l'utilisateur destinataire
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec la propriété concernée
     */
    public function property()
    {
        return $this->belongsTo(Proprety::class, 'property_id');
    }

    /**
     * Relation avec la réservation (si applicable)
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    /**
     * Scope pour les notifications non lues
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope pour les notifications d'un utilisateur
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Marquer la notification comme lue
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Obtenir le badge de couleur selon le type
     */
    public function getBadgeColorAttribute()
    {
        return match($this->type) {
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            'reservation' => 'info',
            default => 'secondary',
        };
    }

    /**
     * Obtenir le type en français
     */
    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'pending' => 'En attente',
            'approved' => 'Approuvée',
            'rejected' => 'Rejetée',
            'reservation' => 'Réservation',
            default => 'Inconnu',
        };
    }
}
