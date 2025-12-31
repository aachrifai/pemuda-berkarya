<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Slide Show</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg mb-6">
                <h3 class="font-bold mb-4">Tambah Foto Slide Baru</h3>
                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-4">
                    @csrf
                    <input type="text" name="judul" placeholder="Judul (Opsional)" class="border rounded px-3 py-2 w-1/3">
                    <input type="file" name="gambar" class="border rounded px-3 py-2 w-1/3" required>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold">Upload</button>
                </form>
            </div>

            <div class="grid grid-cols-3 gap-4">
                @foreach($sliders as $slide)
                <div class="bg-white p-4 shadow rounded">
                    <img src="{{ asset('storage/' . $slide->gambar) }}" class="w-full h-40 object-cover rounded mb-2">
                    <p class="font-bold text-sm">{{ $slide->judul ?? 'Tanpa Judul' }}</p>
                    <form action="{{ route('slider.destroy', $slide->id) }}" method="POST" class="mt-2">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-sm hover:underline" onclick="return confirm('Hapus foto ini?')">Hapus</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>