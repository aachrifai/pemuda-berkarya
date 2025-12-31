<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kegiatan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <strong class="font-bold">Gagal Menyimpan!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block font-bold mb-1">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required placeholder="Contoh: Kerja Bakti Desa">
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-1">Upload Poster/Gambar</label>
                            <input type="file" name="gambar" class="w-full border border-gray-300 rounded p-2 text-sm text-gray-600">
                            <small class="text-gray-500">Format: JPG, PNG. Maks: 2MB.</small>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-bold mb-1">Tanggal Pelaksanaan</label>
                                <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <div>
                                <label class="block font-bold mb-1">Lokasi</label>
                                <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required placeholder="Contoh: Balai Desa">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block font-bold mb-1">Deskripsi Kegiatan</label>
                            <textarea name="deskripsi" rows="4" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required placeholder="Jelaskan detail kegiatan...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Jenis Publikasi</label>
                                <select name="buka_pendaftaran" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="1" {{ old('buka_pendaftaran') == '1' ? 'selected' : '' }}>📝 Pendaftaran (Butuh Data Peserta)</option>
                                    <option value="0" {{ old('buka_pendaftaran') == '0' ? 'selected' : '' }}>📢 Hanya Informasi (Pengumuman Saja)</option>
                                </select>
                                <small class="text-gray-500 text-xs">Pilih "Hanya Informasi" jika tidak ada pendaftaran online.</small>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Status Pendaftaran</label>
                                <select name="status" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Dibuka" {{ old('status') == 'Dibuka' ? 'selected' : '' }}>✅ Dibuka (Sedang Berjalan)</option>
                                    <option value="Ditutup" {{ old('status') == 'Ditutup' ? 'selected' : '' }}>⛔ Ditutup (Selesai / Penuh)</option>
                                </select>
                                <small class="text-gray-500 text-xs">Jika "Ditutup", form pendaftaran akan disembunyikan.</small>
                            </div>

                        </div>

                        <div class="flex items-center gap-4 mt-8">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-bold transition shadow-lg">
                                SIMPAN KEGIATAN
                            </button>
                            <a href="{{ route('kegiatan.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded font-bold hover:bg-gray-300 transition">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>