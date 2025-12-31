<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemuda;        // Panggil Model Pemuda
use App\Models\Kegiatan;      // Panggil Model Kegiatan
use App\Models\Pendaftaran;   // Panggil Model Pendaftaran

class AdminController extends Controller
{
    // 1. DASHBOARD ADMIN (Statistik)
    public function index()
    {
        // Hitung total data untuk dashboard
        $total_kegiatan = Kegiatan::count();
        $total_pemuda   = Pemuda::count();
        $total_peserta  = Pendaftaran::count();

        // Kirim ke view dashboard
        return view('dashboard', compact('total_kegiatan', 'total_pemuda', 'total_peserta'));
    }

    // 2. HALAMAN DATA PEMUDA (Ini yang tadi hilang)
    public function indexPemuda()
    {
        // Ambil data pemuda, urutkan terbaru, batasi 10 per halaman
        $pemudas = Pemuda::latest()->paginate(10);
        
        return view('admin.pemuda.index', compact('pemudas'));
    }

    // 3. HAPUS DATA PEMUDA
    public function destroy($id)
    {
        $pemuda = Pemuda::findOrFail($id);
        $pemuda->delete();

        return redirect()->back()->with('success', 'Data anggota berhasil dihapus.');
    }
}