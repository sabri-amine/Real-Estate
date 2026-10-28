<?php

namespace App\Http\Controllers;

use App\Models\ListingType;
use Illuminate\Http\Request;

class ListingTypeController extends Controller
{
    /**
     * Display a listing of listing types.
     */
    public function index()
    {
        $listingTypes = ListingType::all();
        return view('admin.listing-types.index', compact('listingTypes'));
    }

    /**
     * Show the form for creating a new listing type.
     */
    public function create()
    {
        return view('admin.listing-types.create');
    }

    /**
     * Store a newly created listing type.
     */
    public function store(Request $request)
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
    public function edit($id)
    {
        $listingType = ListingType::findOrFail($id);
        return view('admin.listing-types.edit', compact('listingType'));
    }

    /**
     * Update the specified listing type.
     */
    public function update(Request $request, $id)
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
    public function destroy($id)
    {
        $listingType = ListingType::findOrFail($id);

        // Check if listing type is used by properties
        if ($listingType->properties()->exists()) {
            return redirect()->route('admin.listing-types.index')
                ->with('error', 'Impossible de supprimer ce type d\'annonce car il est utilisé par des propriétés.');
        }

        $listingType->delete();

        return redirect()->route('admin.listing-types.index')
            ->with('success', 'Type d\'annonce supprimé avec succès.');
    }
}
