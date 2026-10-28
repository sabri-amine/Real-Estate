<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proprety;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function get()
    {
        $user = auth()->user();
        $pubs = $user->properties()->with(['images', 'category', 'listingType'])->paginate(3);
        return view('profile', compact('user', 'pubs'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        // Ensure user can only edit their own profile
        if (Auth::id() != $user->id && !$user->hasRole('admin')) {
            return redirect()->route('profile')->with('error', 'Vous ne pouvez modifier que votre propre profil.');
        }
        return view('editprofile', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Ensure user can only update their own profile
        if (Auth::id() != $user->id && !$user->hasRole('admin')) {
            return redirect()->route('profile')->with('error', 'Vous ne pouvez mettre à jour que votre propre profil.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/users', $name);
            $user->image = $name;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');
    }
}
