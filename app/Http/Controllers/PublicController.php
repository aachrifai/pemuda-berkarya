<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemuda;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use App\Models\Slider; 

class PublicController extends Controller
{
    // Halaman Depan
    public function index()
    {
        // Ambil 3 kegiatan terbaru
        $kegiatans = Kegiatan::latest()->take(3)->get();
        
        // Ambil data slider untuk carousel
        $sliders = Slider::latest()->get(); 

        // Kirim kedua data tersebut ke view 'landing'
        return view('landing', compact('kegiatans', 'sliders'));
    }

    // PROSES PENDAFTARAN ANGGOTA PEMUDA
    public function simpanPemuda(Request $request)
    {
        // 1. Validasi Input & Pesan Error Bahasa Indonesia
        $request->validate([
            'nik' => 'required|unique:pemudas,nik', // Cek NIK tidak boleh kembar
            'nama_lengkap' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ], [
            'nik.unique' => 'Maaf, NIK ini sudah terdaftar sebagai anggota.',
            'nik.required' => 'NIK wajib diisi.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
        ]);

        // 2. Simpan Data
        Pemuda::create($request->all());

        // 3. Redirect dengan Kunci 'success_pemuda'
        return redirect()->back()->with('success_pemuda', 'Selamat! Anda berhasil mendaftar sebagai anggota.');
    }

    // Detail Kegiatan
    public function detailKegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('public.kegiatan_detail', compact('kegiatan'));
    }

    // Daftar Jadi Peserta Kegiatan (SUDAH DIPERBAIKI LOGIKANYA)
    public function daftarKegiatan(Request $request, $id)
    {
        // 1. Ambil Data Kegiatan Dulu
        $kegiatan = Kegiatan::findOrFail($id);

        // 2. CEK STATUS: Jika pendaftaran ditutup (0), tolak proses ini!
        if ($kegiatan->buka_pendaftaran == 0) {
            return redirect()->back()->with('error', 'Maaf, pendaftaran untuk kegiatan ini sudah ditutup.');
        }

        // 3. Validasi Input
        $request->validate([
            'nama_peserta' => 'required',
            'no_hp' => 'required|numeric', // Tambahkan numeric agar input angka saja
        ]);

        // 4. CEK DUPLIKAT: Cek apakah nomor HP ini sudah daftar di kegiatan yang sama?
        $sudahDaftar = Pendaftaran::where('kegiatan_id', $id)
                        ->where('no_hp', $request->no_hp)
                        ->exists();

        if ($sudahDaftar) {
            return redirect()->back()->with('error', 'Nomor WhatsApp ini sudah terdaftar di kegiatan ini.');
        }

        // 5. Simpan Data
        Pendaftaran::create([
            'kegiatan_id' => $id,
            'nama_peserta' => $request->nama_peserta,
            'no_hp' => $request->no_hp,
            'status' => 'Mendaftar',
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar di kegiatan ini!');
    }

    // TAMPILKAN SEMUA KEGIATAN
    public function semuaKegiatan()
    {
        $kegiatans = Kegiatan::latest()->paginate(9); 
        return view('public.kegiatan_semua', compact('kegiatans'));
    }
}