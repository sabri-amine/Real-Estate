<?php

namespace App\Http\Controllers;

use App\Models\PropertyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Afficher toutes les notifications de l'utilisateur connecté
     */
    public function index()
    {
        $notifications = PropertyNotification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Marquer une notification comme lue
     */
    public function markAsRead($id)
    {
        $notification = PropertyNotification::findOrFail($id);

        // Vérifier que la notification appartient à l'utilisateur connecté
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification marquée comme lue');
    }

    /**
     * Marquer toutes les notifications comme lues
     */
    public function markAllAsRead()
    {
        PropertyNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues');
    }

    /**
     * Supprimer une notification
     */
    public function destroy($id)
    {
        $notification = PropertyNotification::findOrFail($id);

        // Vérifier que la notification appartient à l'utilisateur connecté
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé');
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification supprimée');
    }

    /**
     * Obtenir le nombre de notifications non lues (pour l'API)
     */
    public function unreadCount()
    {
        $count = PropertyNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }
}
