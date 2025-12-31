<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kegiatan Pemuda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('kegiatan.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition flex items-center gap-2">
                   <i class="bi bi-plus-lg"></i> Tambah Kegiatan Baru
                </a>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 flex items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200 text-sm">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="border px-4 py-3 text-center w-12">No</th>
                                    <th class="border px-4 py-3 text-left">Nama Kegiatan</th>
                                    <th class="border px-4 py-3 text-center w-40">Tipe</th> 
                                    <th class="border px-4 py-3 text-center w-32">Tanggal</th>
                                    <th class="border px-4 py-3 text-center w-32">Status</th>
                                    <th class="border px-4 py-3 text-center w-48">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($kegiatans as $index => $kegiatan)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="border px-4 py-3 text-center font-medium">{{ $index + 1 }}</td>
                                    
                                    <td class="border px-4 py-3">
                                        <div class="font-bold text-gray-800 text-base">{{ $kegiatan->nama_kegiatan }}</div>
                                        <div class="text-xs text-gray-500 font-normal mt-1 flex items-center gap-1">
                                            <i class="bi bi-geo-alt-fill text-red-500"></i> {{ $kegiatan->lokasi }}
                                        </div>
                                    </td>

                                    <td class="border px-4 py-3 text-center align-middle">
                                        @if($kegiatan->buka_pendaftaran == 1)
                                            <span class="inline-flex items-center justify-center gap-1 w-full px-2 py-1.5 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-md border border-emerald-200 shadow-sm">
                                                ✅ Pendaftaran
                                            </span>
                                        @else
                                            <span class="inline-flex items-center justify-center gap-1 w-full px-2 py-1.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-md border border-gray-300 shadow-sm">
                                                ℹ️ Info Saja
                                            </span>
                                        @endif
                                    </td>

                                    <td class="border px-4 py-3 text-center whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                                    </td>

                                    <td class="border px-4 py-3 text-center">
                                        @php
                                            $status = $kegiatan->status ?? 'Aktif';
                                            $warna = match($status) {
                                                'Aktif'              => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'Sedang Berlangsung' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'Selesai'            => 'bg-gray-200 text-gray-600 border-gray-300',
                                                'Ditunda'            => 'bg-orange-100 text-orange-800 border-orange-200',
                                                'Dibatalkan'         => 'bg-red-100 text-red-800 border-red-200',
                                                default              => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="{{ $warna }} border text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wide">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    
                                    <td class="border px-4 py-3 text-center">
                                        <div class="flex justify-center items-center gap-2">
                                            
                                            @if($kegiatan->buka_pendaftaran == 1)
                                                <a href="{{ route('kegiatan.pdf', $kegiatan->id) }}" target="_blank"
                                                   class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 flex items-center justify-center rounded shadow transition" 
                                                   title="Cetak PDF">
                                                    <i class="bi bi-file-pdf-fill"></i>
                                                </a>
                                                <a href="{{ route('kegiatan.peserta', $kegiatan->id) }}" 
                                                   class="bg-indigo-600 hover:bg-indigo-700 text-white w-8 h-8 flex items-center justify-center rounded shadow transition"
                                                   title="Lihat Data Peserta">
                                                    <i class="bi bi-people-fill"></i>
                                                </a>
                                            @else
                                                <button disabled class="bg-gray-200 text-gray-400 w-8 h-8 flex items-center justify-center rounded cursor-not-allowed">
                                                    <i class="bi bi-slash-circle"></i>
                                                </button>
                                            @endif

                                            <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" 
                                               class="bg-yellow-400 hover:bg-yellow-500 text-black w-8 h-8 flex items-center justify-center rounded shadow border border-yellow-600 transition"
                                               title="Edit Kegiatan">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-gray-700 hover:bg-gray-900 text-white w-8 h-8 flex items-center justify-center rounded shadow transition" title="Hapus Permanen">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="border px-4 py-12 text-center text-gray-500 bg-gray-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="bi bi-clipboard-x display-4 text-gray-300 mb-2" style="font-size: 2.5rem;"></i>
                                            <p>Belum ada kegiatan.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $kegiatans->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>