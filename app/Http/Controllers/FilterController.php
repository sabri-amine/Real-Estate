<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proprety;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request)
{
    // Fetch all categories
    $categories = Category::all();
    $propreties = Proprety::where('status', 'approved')->get();

    if ($request->has('category')) {
        $filteredProperties = Proprety::where('category_id', $request->category)
            ->where('status', 'approved')
            ->get();
    } else {
        $filteredProperties = Proprety::where('status', 'approved')->get();
    }

    return view('category.Hotel', compact('propreties','filteredProperties'));
}
public function show(Request $request)
{
    // Récupérer toutes les propriétés approuvées avec leurs images, catégorie et type de listing
    $query = Proprety::with(['images', 'category', 'listingType'])->where('status', 'approved');

    // Récupérer toutes les catégories
    $categories = Category::all();

    // Récupérer les villes uniques pour le filtre
    $cities = Proprety::where('status', 'approved')->distinct()->pluck('city')->sort()->values();

    // Filtrer par catégorie si une option de filtre est sélectionnée
    if ($request->filled('catigory_filter') && $request->input('catigory_filter') !== 'Property Category') {
        $categoryName = $request->input('catigory_filter');
        $query->whereHas('category', function ($q) use ($categoryName) {
            $q->where('name', $categoryName);
        });
    }

    // Filtrer par ville si une option de filtre est sélectionnée
    if ($request->filled('location_filter') && $request->input('location_filter') !== 'Location') {
        $locationName = $request->input('location_filter');
        $query->where('city', $locationName);
    }

    // Filtrer par mot-clé de recherche
    if ($request->filled('search_keyword')) {
        $keyword = $request->input('search_keyword');
        $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', '%' . $keyword . '%')
              ->orWhere('description', 'like', '%' . $keyword . '%')
              ->orWhere('city', 'like', '%' . $keyword . '%')
              ->orWhere('address', 'like', '%' . $keyword . '%');
        });
    }

    // Récupérer les propriétés filtrées
    $properties = $query->get();

    // Loop through properties and keep only the first image
    $properties->each(function ($property) {
        $property->first_image = $property->images->isNotEmpty() ? $property->images->first()->image_path : null;
    });

    return view('proprety.proprety', compact('properties', 'categories', 'cities'));
}


}
