<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendaftaran; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; 

class KegiatanController extends Controller
{
    // 1. TAMPILKAN DAFTAR KEGIATAN
    public function index()
    {
        $kegiatans = Kegiatan::latest()->paginate(10);
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    // 2. TAMPILKAN FORM TAMBAH
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    // 3. FUNGSI SIMPAN (STORE) - SUDAH DIPERBAIKI
    public function store(Request $request)
    {
        // Validasi input (Pastikan 'status' dan 'buka_pendaftaran' wajib diisi)
        $request->validate([
            'nama_kegiatan'    => 'required',
            'tanggal'          => 'required|date',
            'lokasi'           => 'required',
            'deskripsi'        => 'required',
            'gambar'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'buka_pendaftaran' => 'required', // 1 = Pendaftaran, 0 = Info
            'status'           => 'required', // Dibuka / Ditutup
        ]);

        // Ambil semua data input kecuali _token
        $data = $request->except(['_token']);

        // Upload Gambar
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kegiatan', 'public');
            $data['gambar'] = $path;
        }

        Kegiatan::create($data);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // 4. HAPUS KEGIATAN
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        if ($kegiatan->gambar) { 
            Storage::disk('public')->delete($kegiatan->gambar); 
        }
        
        $kegiatan->delete();
        
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus!');
    }

    // 5. EDIT KEGIATAN
    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    // 6. UPDATE KEGIATAN - SUDAH DIPERBAIKI
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan'    => 'required',
            'tanggal'          => 'required|date',
            'lokasi'           => 'required',
            'deskripsi'        => 'required',
            'gambar'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'buka_pendaftaran' => 'required',
            'status'           => 'required', 
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        
        // Ambil semua data input kecuali token dan method
        $data = $request->except(['_token', '_method']);

        // Upload Gambar Baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            // Simpan gambar baru
            $path = $request->file('gambar')->store('kegiatan', 'public');
            $data['gambar'] = $path;
        }

        $kegiatan->update($data);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    // 7. LIHAT PESERTA
    public function lihatPeserta($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $pesertas = Pendaftaran::where('kegiatan_id', $id)->latest()->get();
        return view('admin.kegiatan.peserta', compact('kegiatan', 'pesertas'));
    }

    // 8. CETAK PDF
    public function cetakPdf($id)
    {
        $kegiatan = Kegiatan::with('pendaftarans')->findOrFail($id);
        
        // Jika jenisnya "Hanya Info" (0), tolak cetak PDF
        if ($kegiatan->buka_pendaftaran == 0) {
            return back()->with('error', 'Kegiatan ini berjenis Informasi, tidak ada data pendaftar.');
        }
        
        $pdf = Pdf::loadView('admin.kegiatan.pdf', compact('kegiatan'));
        return $pdf->download('Laporan-Peserta-' . $kegiatan->nama_kegiatan . '.pdf');
    }
}