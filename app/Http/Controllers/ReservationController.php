<?php

namespace App\Http\Controllers;

use App\Models\Proprety;
use App\Models\Reservation;
use App\Models\PropertyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Créer une nouvelle réservation
     */
    public function store(Request $request, $propertyId)
    {
        $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1|max:20',
        ]);

        // Convertir les dates du formulaire en objets Carbon
        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = Carbon::parse($request->check_out_date);

        $property = Proprety::findOrFail($propertyId);

        // Vérifier que l'utilisateur n'est pas le propriétaire
        if (Auth::id() === $property->user_id) {
            return back()->with('error', 'Vous ne pouvez pas réserver votre propre propriété.');
        }

        // Vérifier que la propriété est approuvée
        if ($property->status !== 'approved') {
            return back()->with('error', 'Cette propriété n\'est pas disponible à la réservation.');
        }

        // Vérifier la disponibilité de la propriété pour la période demandée
        $isAvailable = $property->isAvailable(
            $checkInDate,
            $checkOutDate
        );

        if (!$isAvailable) {
            return back()->with('error', 'Cette propriété n\'est pas disponible pour les dates sélectionnées.');
        }

        // Utiliser une transaction pour éviter les doubles réservations simultanées
        DB::beginTransaction();
        try {
            // Vérifier à nouveau la disponibilité (race condition)
            $isAvailable = $property->isAvailable(
                $checkInDate,
                $checkOutDate
            );

            if (!$isAvailable) {
                DB::rollBack();
                return back()->with('error', 'Cette propriété vient d\'être réservée par un autre utilisateur.');
            }

            // Créer la réservation
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'property_id' => $property->id,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'number_of_guests' => $request->number_of_guests,
                'status' => 'confirmed'
            ]);

            // Envoyer une notification au propriétaire
            PropertyNotification::create([
                'user_id' => $property->user_id,
                'property_id' => $property->id,
                'reservation_id' => $reservation->id,
                'type' => 'approved',
                'title' => 'Nouvelle réservation',
                'message' => 'Votre propriété "' . $property->name . '" vient d\'être réservée du ' .
                            $checkInDate->format('d/m/Y') . ' au ' .
                            $checkOutDate->format('d/m/Y') .
                            ' pour ' . $request->number_of_guests . ' personne(s).',
            ]);

            // Envoyer une notification à l'administrateur
            $admin = \App\Models\User::whereHas('roles', function($query) {
                $query->where('name', 'admin');
            })->first();

            if ($admin) {
                PropertyNotification::create([
                    'user_id' => $admin->id,
                    'property_id' => $property->id,
                    'reservation_id' => $reservation->id,
                    'type' => 'reservation',
                    'title' => 'Nouvelle réservation',
                    'message' => 'Nouvelle réservation : ' . Auth::user()->name . ' a réservé "' . $property->name . '" du ' .
                                $checkInDate->format('d/m/Y') . ' au ' .
                                $checkOutDate->format('d/m/Y') .
                                ' pour ' . $request->number_of_guests . ' personne(s).',
                ]);
            }

            DB::commit();

            return back()->with('success', 'Votre réservation a été confirmée avec succès !');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de la réservation : ' . $e->getMessage());
        }
    }

    /**
     * Annuler une réservation
     */
    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Vérifier que l'utilisateur est le propriétaire de la réservation
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', 'Votre réservation a été annulée.');
    }

    /**
     * Afficher les réservations de l'utilisateur connecté
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['property', 'property.images'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Récupérer les dates bloquées pour une propriété (API)
     */
    public function getBlockedDates($propertyId)
    {
        $property = Proprety::findOrFail($propertyId);
        $blockedDates = $property->getBlockedDates();

        return response()->json([
            'blocked_dates' => $blockedDates
        ]);
    }
}
