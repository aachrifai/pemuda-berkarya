<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kotak Aspirasi Warga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="border px-4 py-2 text-left" width="50">No</th>
                                <th class="border px-4 py-2 text-left">Pengirim</th>
                                <th class="border px-4 py-2 text-left">Isi Pesan</th>
                                <th class="border px-4 py-2 text-left">Waktu</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($aspirasis as $index => $a)
                            <tr class="hover:bg-gray-100 align-top">
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">
                                    <span class="font-bold">{{ $a->nama_pengirim }}</span><br>
                                    <a href="https://wa.me/{{ $a->no_hp }}" class="text-green-600 text-xs hover:underline">
                                        {{ $a->no_hp }}
                                    </a>
                                </td>
                                <td class="border px-4 py-2 italic text-gray-700">"{{ $a->pesan }}"</td>
                                <td class="border px-4 py-2 text-sm text-gray-500">
                                    {{ $a->created_at->diffForHumans() }}
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <form action="{{ route('aspirasi.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border px-4 py-6 text-center text-gray-500">
                                    Belum ada aspirasi masuk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 