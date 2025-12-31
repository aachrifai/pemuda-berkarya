<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemuda;

class PemudaController extends Controller
{
    // 1. TAMPILKAN DAFTAR ANGGOTA
    public function index()
    {
        $pemudas = Pemuda::latest()->paginate(10);
        return view('admin.pemuda.index', compact('pemudas'));
    }

    // 2. TAMPILKAN FORM EDIT
    public function edit($id)
    {
        $pemuda = Pemuda::findOrFail($id);
        return view('admin.pemuda.edit', compact('pemuda'));
    }

    // 3. PROSES UPDATE DATA
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|numeric|unique:pemudas,nik,'.$id, // Cek unik kecuali NIK dia sendiri
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

        // Ambil data dan update
        $pemuda = Pemuda::findOrFail($id);
        
        $pemuda->update([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.pemuda.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    // 4. HAPUS ANGGOTA
    public function destroy($id)
    {
        $pemuda = Pemuda::findOrFail($id);
        $pemuda->delete();

        return redirect()->back()->with('success', 'Data anggota berhasil dihapus.');
    }
}