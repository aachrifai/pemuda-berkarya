<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;

class AspirasiController extends Controller
{
    // 1. SIMPAN ASPIRASI (UNTUK PUBLIK)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pengirim' => 'nullable', // Diubah jadi nullable (Boleh Kosong)
            'no_hp'         => 'nullable', // Diubah jadi nullable (Boleh Kosong)
            'pesan'         => 'required', // Pesan tetap WAJIB
        ]);

        // Simpan ke database
        Aspirasi::create([
            // Gunakan operator '??' (null coalescing)
            // Jika input kosong, otomatis isi dengan string 'Anonim'
            'nama_pengirim' => $request->nama_pengirim ?? 'Anonim', 
            'no_hp'         => $request->no_hp,
            'pesan'         => $request->pesan,
        ]);

        // Redirect kembali dengan pesan sukses khusus aspirasi
        return redirect()->back()->with('success_aspirasi', 'Terima kasih! Aspirasi Anda telah kami terima.');
    }

    // 2. LIHAT DAFTAR ASPIRASI (UNTUK ADMIN)
    public function index()
    {
        $aspirasis = Aspirasi::latest()->paginate(10);
        return view('admin.aspirasi.index', compact('aspirasis'));
    }

    // 3. HAPUS ASPIRASI (UNTUK ADMIN)
    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->delete();
        
        return redirect()->back()->with('success', 'Pesan aspirasi berhasil dihapus.');
    }
}