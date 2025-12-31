<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();
            
            // Tambahkan ->nullable() di sini agar database mengizinkan data kosong
            $table->string('nama_pengirim')->nullable(); // Nama warga (Opsional)
            $table->string('no_hp')->nullable();         // No HP/WA (Opsional)
            
            $table->text('pesan');                       // Isi saran (Wajib)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};