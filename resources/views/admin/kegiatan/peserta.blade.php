<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Peserta Kegiatan: <span class="text-blue-600">{{ $kegiatan->nama_kegiatan }}</span>
            </h2>
            <a href="{{ route('kegiatan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-sm">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="mb-4 font-bold text-gray-700">Total Pendaftar: {{ $pesertas->count() }} Orang</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200 text-sm">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2 text-left">Nama Peserta</th>
                                    <th class="border px-4 py-2 text-left">Nomor HP/WA</th>
                                    <th class="border px-4 py-2 text-left">Tanggal Daftar</th>
                                    <th class="border px-4 py-2 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesertas as $index => $p)
                                <tr class="hover:bg-gray-100">
                                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2 font-bold">{{ $p->nama_peserta }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="https://wa.me/{{ $p->no_hp }}" target="_blank" class="text-green-600 hover:underline flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            {{ $p->no_hp }}
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">{{ $p->created_at->format('d M Y, H:i') }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $p->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-8 text-center text-gray-500">
                                        Belum ada yang mendaftar di kegiatan ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>