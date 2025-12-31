<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel kegiatan (cascade: jika kegiatan dihapus, pendaftar ikut terhapus)
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            
            $table->string('nama_peserta');
            $table->string('no_hp');
            $table->string('status')->default('Mendaftar'); // <--- INI YANG TADI KURANG
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};