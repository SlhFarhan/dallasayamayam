<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Menampilkan form profil pengguna beserta alamat-alamat yang dimiliki.
     */
    public function edit(Request $request)
    {
        $addresses = $request->user()->addresses; // Mengambil alamat pengguna yang sedang login
        return view('profile.edit', [
            'user' => $request->user(),
            'addresses' => $addresses, // Mengirimkan data alamat ke tampilan
        ]);
    }

    /**
     * Mengupdate informasi profil pengguna.
     */
    public function update(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
    ]);

    $request->user()->fill($validated);

    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Menyimpan alamat baru untuk pengguna.
     */
    public function storeAddress(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        // Menyimpan alamat baru
        $request->user()->addresses()->create([
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('profile.edit')->with('status', 'alamat-dibuat');
    }

    /**
     * Menghapus alamat yang dipilih.
     */
    public function destroyAddress(Address $address)
    {
        // Pastikan alamat milik pengguna yang sedang login
        if ($address->user_id == Auth::id()) {
            $address->delete();
            return redirect()->route('profile.edit')->with('status', 'alamat-dihapus');
        }

        return redirect()->route('profile.edit')->with('error', 'Alamat tidak ditemukan.');
    }
}
