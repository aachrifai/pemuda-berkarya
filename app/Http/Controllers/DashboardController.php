<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemuda;
use App\Models\Kegiatan;
use App\Models\Aspirasi;
use App\Models\Pendaftaran; // Jika ingin hitung total pendaftar acara

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik Utama
        $total_pemuda = Pemuda::count();
        $total_kegiatan = Kegiatan::count();
        $total_aspirasi = Aspirasi::count();
        $total_pendaftar_acara = Pendaftaran::count();

        // 2. Ambil 5 Data Terbaru (Untuk tabel mini)
        $pemuda_terbaru = Pemuda::latest()->take(5)->get();
        $aspirasi_terbaru = Aspirasi::latest()->take(3)->get();

        return view('dashboard', compact(
            'total_pemuda', 
            'total_kegiatan', 
            'total_aspirasi', 
            'total_pendaftar_acara',
            'pemuda_terbaru',
            'aspirasi_terbaru'
        ));
    }
}