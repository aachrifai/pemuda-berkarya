<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    // KITA HARUS MENAMBAHKAN INI AGAR BISA DISIMPAN KE DATABASE
    protected $fillable = [
        'judul',
        'gambar',
    ];
}