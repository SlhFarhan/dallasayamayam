<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Menambahkan $fillable untuk mass assignment
    protected $fillable = [
        'user_id',      // Menambahkan user_id agar bisa diisi massal
        'alamat',
        'no_hp',
        'total_harga',
        'status'
    ];

    // Relasi dengan OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id'); // Sesuaikan dengan kolom relasi di tabel
    }
    // Di dalam model Order
public function user()
{
    return $this->belongsTo(User::class); // Relasi ke model User
}

}
