<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.pemuda.update', $pemuda->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block font-bold mb-1 text-gray-700">NIK</label>
                            <input type="number" name="nik" value="{{ old('nik', $pemuda->nik) }}" class="w-full border-gray-300 rounded shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-1 text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pemuda->nama_lengkap) }}" class="w-full border-gray-300 rounded shadow-sm" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-bold mb-1 text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pemuda->tanggal_lahir) }}" class="w-full border-gray-300 rounded shadow-sm" required>
                            </div>
                            <div>
                                <label class="block font-bold mb-1 text-gray-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full border-gray-300 rounded shadow-sm">
                                    <option value="L" {{ $pemuda->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $pemuda->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-1 text-gray-700">Nomor HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $pemuda->no_hp) }}" class="w-full border-gray-300 rounded shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-1 text-gray-700">Alamat</label>
                            <textarea name="alamat" rows="3" class="w-full border-gray-300 rounded shadow-sm" required>{{ old('alamat', $pemuda->alamat) }}</textarea>
                        </div>

                        <div class="flex justify-end gap-2 mt-4">
                            <a href="{{ route('admin.pemuda.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>