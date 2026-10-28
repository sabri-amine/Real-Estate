<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proprety;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get()
    {
        // Only show approved properties on home page
        $properties = Proprety::with(['images', 'category', 'listingType'])
            ->where('status', 'approved')
            ->latest()
            ->get();
        $categories = Category::all();
        return view('welcome', compact('categories', 'properties'));
    }



    

}
