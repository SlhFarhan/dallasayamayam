<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Menambahkan $fillable untuk mass assignment
    protected $fillable = [
        'order_id',   // Menambahkan order_id agar bisa diisi massal
        'menu_id',    // Menambahkan menu_id agar bisa diisi massal
        'quantity',   // Menambahkan quantity agar bisa diisi massal
        'price',
        'status'   // Menambahkan price agar bisa diisi massal
    ];

    // Relasi dengan Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
