<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama menu
            $table->text('description'); // Deskripsi menu
            $table->decimal('price', 8, 2); // Harga menu
            $table->enum('category', ['karbo', 'ayam', 'burger', 'nugget', 'minuman', 'paket', 'promo']); // Kategori
            $table->string('image'); // Gambar menu
            $table->timestamps(); // Waktu dibuat dan diubah
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
