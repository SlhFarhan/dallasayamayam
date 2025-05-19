<?php

// app/Http/Controllers/AddressController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{

    public function edit()
    {
        $addresses = auth()->user()->addresses; // Mengambil alamat dari user yang sedang login

        return view('profile.edit', compact('addresses')); // Mengirim data alamat ke tampilan
    }
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        if ($user->addresses()->count() >= 3) {
            return back()->with('error', 'Maksimal hanya 3 alamat yang dapat disimpan.');
        }

        $user->addresses()->create([
            'alamat' => $request->alamat,
        ]);

        return back()->with('success', 'Alamat berhasil disimpan.');
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        $address->update([
            'alamat' => $request->alamat,
        ]);

        return back()->with('success', 'Alamat berhasil diperbarui.');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return back()->with('success', 'Alamat berhasil dihapus.');
    }
}
