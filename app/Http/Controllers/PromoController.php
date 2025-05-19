<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        // Ambil menu yang kategorinya 'promo'
        $promos = Menu::where('category', 'promo')->get();
        return view('promo.index', compact('promos'));
        
    }
}
