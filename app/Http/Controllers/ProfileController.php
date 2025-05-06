<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\InternshipRegistration; // Model untuk dokumen user

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($request->has('name')) {
        $user->name = $request->name;
    }
    if ($request->has('email')) {
        $user->email = $request->email;
    }
    if ($request->has('phone')) {
        $user->phone = $request->phone;
    }
    if ($request->has('address')) {
        $user->address = $request->address;
    }    

    // Simpan foto baru jika ada
    if ($request->hasFile('profile_picture')) {
        // Hapus foto lama kalau ada
        if ($user->profile_picture && Storage::exists('public/profile_pictures/' . $user->profile_picture)) {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
        }

        $photoName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->storeAs('public/profile_pictures', $photoName);
        $user->profile_picture = $photoName; // <- Pindahkan ke sini
    }

    $user->save();

    return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
}


    public function show()
    {
        return view('profile.show', [
            'user' => Auth::user()
        ]);
    }
    
    public function profile()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        $registration = InternshipRegistration::all();
    
        return view('profile.show', compact('user', 'registration'));
    }
    
}

