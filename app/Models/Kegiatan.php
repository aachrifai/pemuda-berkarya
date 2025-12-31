<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    // Kita gunakan $fillable agar lebih spesifik dan aman
    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'lokasi',
        'tanggal',
        'gambar',
        'buka_pendaftaran', // <--- PENTING: Agar status checkbox/select bisa tersimpan
        'status',
    ];

    // Relasi ke tabel pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class); 
    }
}