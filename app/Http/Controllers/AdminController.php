<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ListingType;
use App\Models\Proprety;
use App\Models\PropertyNotification;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $stats = [
            'total_properties' => Proprety::count(),
            'pending_properties' => Proprety::where('status', 'pending')->count(),
            'approved_properties' => Proprety::where('status', 'approved')->count(),
            'rejected_properties' => Proprety::where('status', 'rejected')->count(),
            'total_categories' => Category::count(),
            'total_listing_types' => ListingType::count(),
        ];

        $recentProperties = Proprety::with(['category', 'listingType', 'owner'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentProperties'));
    }

    /**
     * Display all categories for admin management.
     */
    public function categories()
    {
        $categories = Category::withCount('properties')->orderBy('created_at', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function createCategory()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category.
     */
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified category.
     */
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        if ($category->properties()->exists()) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle est utilisée par des propriétés.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }

    /**
     * Display all listing types for admin management.
     */
    public function listingTypes()
    {
        $listingTypes = ListingType::withCount('properties')->orderBy('created_at', 'desc')->get();
        return view('admin.listing-types.index', compact('listingTypes'));
    }

    /**
     * Show the form for creating a new listing type.
     */
    public function createListingType()
    {
        return view('admin.listing-types.create');
    }

    /**
     * Store a newly created listing type.
     */
    public function storeListingType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:listing_types',
        ]);

        ListingType::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.listing-types.index')
            ->with('success', 'Type d\'annonce créé avec succès.');
    }

    /**
     * Show the form for editing the specified listing type.
     */
    public function editListingType($id)
    {
        $listingType = ListingType::findOrFail($id);
        return view('admin.listing-types.edit', compact('listingType'));
    }

    /**
     * Update the specified listing type.
     */
    public function updateListingType(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:listing_types,name,' . $id,
        ]);

        $listingType = ListingType::findOrFail($id);
        $listingType->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.listing-types.index')
            ->with('success', 'Type d\'annonce mis à jour avec succès.');
    }

    /**
     * Remove the specified listing type.
     */
    public function destroyListingType($id)
    {
        $listingType = ListingType::findOrFail($id);

        if ($listingType->properties()->exists()) {
            return redirect()->route('admin.listing-types.index')
                ->with('error', 'Impossible de supprimer ce type d\'annonce car il est utilisé par des propriétés.');
        }

        $listingType->delete();

        return redirect()->route('admin.listing-types.index')
            ->with('success', 'Type d\'annonce supprimé avec succès.');
    }

    /**
     * Display all properties for admin management.
     */
    public function properties(Request $request)
    {
        $query = Proprety::with(['category', 'listingType', 'owner']);

        // Filter by status if provided
        if ($request->has('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $properties = $query->orderBy('created_at', 'desc')->get();

        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Validate/Approve a property.
     */
    public function approveProperty($id)
    {
        $property = Proprety::findOrFail($id);

        // Only approve if property is pending
        if ($property->status !== 'pending') {
            return redirect()->route('admin.properties')
                ->with('error', 'Seules les propriétés en attente peuvent être approuvées.');
        }

        $property->update(['status' => 'approved']);

        // Créer une notification pour le propriétaire (éviter les doublons)
        $existingNotification = PropertyNotification::where('property_id', $property->id)
            ->where('type', 'approved')
            ->where('is_read', false)
            ->first();

        if (!$existingNotification) {
            PropertyNotification::create([
                'user_id' => $property->user_id,
                'property_id' => $property->id,
                'type' => 'approved',
                'title' => 'Propriété approuvée',
                'message' => 'Votre propriété "' . $property->name . '" a été approuvée et est désormais visible publiquement.',
            ]);
        }

        return redirect()->route('admin.properties')
            ->with('success', 'Propriété approuvée avec succès.');
    }

    /**
     * Reject a property.
     */
    public function rejectProperty(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:1000',
        ]);

        $property = Proprety::findOrFail($id);

        // Can reject pending or approved properties
        if (!in_array($property->status, ['pending', 'approved'])) {
            return redirect()->route('admin.properties')
                ->with('error', 'Seules les propriétés en attente ou approuvées peuvent être rejetées.');
        }

        $property->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('rejection_reason')
        ]);

        // Créer une notification pour le propriétaire
        $message = 'Votre propriété "' . $property->name . '" a été rejetée.';
        if ($request->input('rejection_reason')) {
            $message .= ' Motif : ' . $request->input('rejection_reason');
        }

        PropertyNotification::create([
            'user_id' => $property->user_id,
            'property_id' => $property->id,
            'type' => 'rejected',
            'title' => 'Propriété rejetée',
            'message' => $message,
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        return redirect()->route('admin.properties')
            ->with('success', 'Propriété rejetée avec succès.');
    }

    /**
     * Set property back to pending.
     */
    public function pendingProperty($id)
    {
        $property = Proprety::findOrFail($id);

        // Can set back to pending only if approved or rejected
        if (!in_array($property->status, ['approved', 'rejected'])) {
            return redirect()->route('admin.properties')
                ->with('error', 'Seules les propriétés approuvées ou rejetées peuvent être remises en attente.');
        }

        $property->update([
            'status' => 'pending',
            'rejection_reason' => null
        ]);

        // Créer une notification pour le propriétaire
        PropertyNotification::create([
            'user_id' => $property->user_id,
            'property_id' => $property->id,
            'type' => 'pending',
            'title' => 'Propriété remise en attente',
            'message' => 'Votre propriété "' . $property->name . '" a été remise en attente de validation.',
        ]);

        return redirect()->route('admin.properties')
            ->with('success', 'Propriété remise en attente avec succès.');
    }

    /**
     * Delete a property.
     */
    public function deleteProperty($id)
    {
        $property = Proprety::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.properties')
            ->with('success', 'Propriété supprimée avec succès.');
    }

    /**
     * Display all properties with reservation status for admin management.
     */
    public function reservations(Request $request)
    {
        $query = Proprety::with(['images', 'category', 'listingType', 'owner', 'reservations.user'])
            ->where('status', 'approved');

        $today = Carbon::today();

        // Filter by reservation status
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'available':
                    $query->whereDoesntHave('reservations', function ($q) use ($today) {
                        $q->where('status', 'confirmed')
                          ->where('check_in_date', '<=', $today)
                          ->where('check_out_date', '>=', $today);
                    });
                    break;
                case 'reserved':
                    $query->whereHas('reservations', function ($q) use ($today) {
                        $q->where('status', 'confirmed')
                          ->where('check_in_date', '<=', $today)
                          ->where('check_out_date', '>=', $today);
                    });
                    break;
                case 'upcoming':
                    $query->whereHas('reservations', function ($q) use ($today) {
                        $q->where('status', 'confirmed')
                          ->where('check_in_date', '>', $today);
                    });
                    break;
                case 'completed':
                    $query->whereHas('reservations', function ($q) use ($today) {
                        $q->where('status', 'confirmed')
                          ->where('check_out_date', '<', $today);
                    });
                    break;
            }
        }

        $properties = $query->orderBy('created_at', 'desc')->get();

        return view('admin.reservations.index', compact('properties'));
    }
}
