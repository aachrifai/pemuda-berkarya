<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('sliders', function (Blueprint $table) {
        $table->id();
        $table->string('judul')->nullable(); // Judul foto (opsional)
        $table->string('gambar'); // Lokasi file gambar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
