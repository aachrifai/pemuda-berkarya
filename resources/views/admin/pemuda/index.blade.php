<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Anggota Pemuda') }}
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
                    
                    <h3 class="font-bold mb-4">Total Anggota: {{ $pemudas->total() }} Orang</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200 text-sm">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="border px-4 py-2 text-left">No</th>
                                    <th class="border px-4 py-2 text-left">NIK</th>
                                    <th class="border px-4 py-2 text-left">Nama Lengkap</th>
                                    <th class="border px-4 py-2 text-left">L/P</th>
                                    <th class="border px-4 py-2 text-left">No HP</th>
                                    <th class="border px-4 py-2 text-left">Alamat</th>
                                    <th class="border px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pemudas as $index => $p)
                                <tr class="hover:bg-gray-100">
                                    <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="border px-4 py-2 font-mono">{{ $p->nik }}</td>
                                    <td class="border px-4 py-2 font-bold">{{ $p->nama_lengkap }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $p->jenis_kelamin }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="https://wa.me/{{ $p->no_hp }}" target="_blank" class="text-green-600 hover:underline">
                                            {{ $p->no_hp }}
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">{{ Str::limit($p->alamat, 30) }}</td>
                                    
                                    <td class="border px-4 py-2 text-center">
                                        <div class="flex justify-center items-center gap-1">
                                            
                                            <a href="{{ route('admin.pemuda.edit', $p->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-1 px-3 rounded text-xs shadow border border-yellow-600 transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.pemuda.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data anggota ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs shadow transition">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="border px-4 py-6 text-center text-gray-500">
                                        Belum ada data anggota yang mendaftar.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $pemudas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>