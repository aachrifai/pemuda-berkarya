<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi
    protected $guarded = [];

    // Relasi balik ke Kegiatan (Opsional tapi bagus ada)
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}