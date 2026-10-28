<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprety extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city',
        'address',
        'price',
        'size',
        'bedrooms',
        'bathrooms',
        'description',
        'category_id',
        'listing_type_id',
        'user_id',
        'status',
        'rejection_reason'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function listingType()
    {
        return $this->belongsTo(ListingType::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function images()
    {
        return $this->hasMany(PropretyImage::class, 'property_id');
    }

    public function notifications()
    {
        return $this->hasMany(PropertyNotification::class, 'property_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'property_id');
    }

    /**
     * Vérifier si la propriété est disponible pour une période donnée
     * Convention hôtelière : check_in inclus, check_out exclus
     * Une nouvelle réservation [new_start, new_end) chevauche une existante [existing_start, existing_end) si :
     * new_start < existing_end && new_end > existing_start
     */
    public function isAvailable($startDate, $endDate)
    {
        return !$this->reservations()
            ->confirmed()
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('check_in_date', '<', $endDate)
                      ->where('check_out_date', '>', $startDate);
            })
            ->exists();
    }

    /**
     * Récupérer toutes les dates bloquées pour cette propriété
     * Retourne un tableau de périodes [check_in, check_out]
     */
    public function getBlockedDates()
    {
        return $this->reservations()
            ->confirmed()
            ->where('check_out_date', '>', now())
            ->orderBy('check_in_date')
            ->get(['check_in_date', 'check_out_date'])
            ->map(function ($reservation) {
                return [
                    'start' => $reservation->check_in_date->format('Y-m-d'),
                    'end' => $reservation->check_out_date->format('Y-m-d'),
                ];
            })
            ->toArray();
    }

}
