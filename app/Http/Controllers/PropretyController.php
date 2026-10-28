<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ListingType;
use App\Models\Proprety;
use App\Models\PropretyImage;
use App\Models\PropertyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropretyController extends Controller
{
    public function get()
    {
        // Only show approved properties to regular users
        $today = now()->toDateString();

        $properties = Proprety::with(['images', 'category', 'listingType'])
            ->where('status', 'approved')
            ->whereDoesntHave('reservations', function ($query) use ($today) {
                $query->where('status', 'confirmed')
                      ->where('check_in_date', '<=', $today)
                      ->where('check_out_date', '>=', $today);
            })
            ->get();
        $categories = Category::all();
        $cities = Proprety::where('status', 'approved')->distinct()->pluck('city')->sort()->values();

        // Loop through properties and keep only the first image
        $properties->each(function ($property) {
            $property->first_image = $property->images->isNotEmpty() ? $property->images->first()->image_path : null;
        });

        return view('proprety.proprety', compact('properties', 'categories', 'cities'));
    }

    public function show($id)
    {
        $property = Proprety::with(['images', 'category', 'listingType', 'owner'])->findOrFail($id);

        // Check if property is approved or belongs to current user
        if ($property->status !== 'approved' && $property->user_id !== Auth::id()) {
            abort(403, 'This property is not available for viewing.');
        }

        return view('proprety.showProperty', compact('property'));
    }

    public function create()
{
    $categories = Category::all();
    $listingTypes = ListingType::all();
    return view('proprety.createProprety', compact('categories', 'listingTypes'));
}

public function add(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'price' => 'required|numeric',
                'size' => 'required|numeric',
                'bedrooms' => 'required|integer',
                'bathrooms' => 'required|integer',
                'description' => 'required|string|max:10000',
                'property-category' => 'required|exists:categories,id',
                'listing-type' => 'required|exists:listing_types,id',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp'
            ]);

            $userId = Auth::id();

            if (!$userId) {
                return redirect()->back()->with('error', 'Vous devez être connecté pour créer une propriété.');
            }

            // Create property with pending status
            $property = Proprety::create([
                'name' => $request->input('name'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'price' => $request->input('price'),
                'size' => $request->input('size'),
                'bedrooms' => $request->input('bedrooms'),
                'bathrooms' => $request->input('bathrooms'),
                'description' => $request->input('description'),
                'category_id' => $request->input('property-category'),
                'listing_type_id' => $request->input('listing-type'),
                'user_id' => $userId,
                'status' => 'pending'
            ]);

            // Créer une notification pour le propriétaire
            PropertyNotification::create([
                'user_id' => $userId,
                'property_id' => $property->id,
                'type' => 'pending',
                'title' => 'Propriété soumise',
                'message' => 'Votre propriété "' . $property->name . '" a été soumise et attend la validation de l\'administrateur.',
            ]);

            // Handle property images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);
                    PropretyImage::create([
                        'property_id' => $property->id,
                        'image_path' => $imageName
                    ]);
                }
            }

            return redirect()->route('properties.index')->with('success', 'Propriété créée avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de la propriété : ' . $e->getMessage())->withInput();
        }
    }


    public function edit(string $id){
        $property = Proprety::findOrFail($id);

        // Check if user owns this property or is admin
        if ($property->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Vous ne pouvez modifier que vos propres propriétés.');
        }

        $category = Category::all();

        return view('proprety.editProperty',compact('property'));
    }

    public function update(Request $request, $id){
        $property = Proprety::findOrFail($id);

        // Check if user owns this property or is admin
        if ($property->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Vous ne pouvez mettre à jour que vos propres propriétés.');
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        // Don't allow updating status through this method
        $data = $request->except(['status', 'user_id']);
        $property->update($data);

        return redirect()->route('profile');
    }


    public function destroy($id){
        $property = Proprety::findOrFail($id);

        // Check if user owns this property or is admin
        if ($property->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Vous ne pouvez supprimer que vos propres propriétés.');
        }

        $property->delete();
        return redirect()->route('properties.index');
    }
}
