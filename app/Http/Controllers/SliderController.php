<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    // TAMPILKAN HALAMAN KELOLA SLIDER
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    // SIMPAN GAMBAR BARU
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('gambar')->store('sliders', 'public');

        Slider::create([
            'judul' => $request->judul,
            'gambar' => $path
        ]);

        return redirect()->back()->with('success', 'Foto slide berhasil ditambahkan!');
    }

    // HAPUS GAMBAR
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        
        // Hapus file dari folder storage
        if(Storage::disk('public')->exists($slider->gambar)){
            Storage::disk('public')->delete($slider->gambar);
        }
        
        $slider->delete();
        return redirect()->back()->with('success', 'Foto slide dihapus.');
    }
}