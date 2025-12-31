<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pemuda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('pemuda.update', $pemuda->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        
                        <div class="mb-4">
                            <label class="block font-bold mb-1">NIK</label>
                            <input type="number" name="nik" value="{{ old('nik', $pemuda->nik) }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pemuda->nama_lengkap) }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-bold mb-1">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pemuda->tanggal_lahir) }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                            
                            <div>
                                <label class="block font-bold mb-1">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="L" {{ $pemuda->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $pemuda->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-bold mb-1">Nomor HP (WA)</label>
                            <input type="number" name="no_hp" value="{{ old('no_hp', $pemuda->no_hp) }}" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>

                        <div class="mb-6">
                            <label class="block font-bold mb-1">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('alamat', $pemuda->alamat) }}</textarea>
                        </div>

                        <div style="margin-top: 30px; display: flex; align-items: center; gap: 15px;">
                            
                            <button type="submit" 
                                    style="background-color: #000000; color: #ffffff; padding: 10px 25px; border-radius: 5px; font-weight: bold; border: 1px solid black; cursor: pointer;">
                                SIMPAN PERUBAHAN
                            </button>
                            
                            <a href="{{ route('dashboard') }}" 
                               style="background-color: #cccccc; color: #000000; padding: 10px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; border: 1px solid #999999;">
                                Batal
                            </a>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>