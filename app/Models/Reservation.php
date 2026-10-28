<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'check_in_date',
        'check_out_date',
        'number_of_guests',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'check_in_date' => 'date',
            'check_out_date' => 'date',
        ];
    }

    /**
     * Relation avec l'utilisateur qui a réservé
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec la propriété réservée
     */
    public function property()
    {
        return $this->belongsTo(Proprety::class, 'property_id');
    }

    /**
     * Vérifier si la réservation est active pour une date donnée
     * Convention hôtelière : check_in inclus, check_out exclus
     */
    public function isActiveForDate($date)
    {
        return $this->status === 'confirmed' &&
               $date >= $this->check_in_date &&
               $date < $this->check_out_date;
    }

    /**
     * Scope pour les réservations confirmées
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope pour les réservations d'une propriété
     */
    public function scopeForProperty($query, $propertyId)
    {
        return $query->where('property_id', $propertyId);
    }

    /**
     * Vérifier si cette réservation chevauche une période donnée
     * Convention hôtelière : check_in inclus, check_out exclus
     */
    public function overlapsWith($startDate, $endDate)
    {
        return $this->status === 'confirmed' &&
               $this->check_in_date < $endDate &&
               $this->check_out_date > $startDate;
    }
}
