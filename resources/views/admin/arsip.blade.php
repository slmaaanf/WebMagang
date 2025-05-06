@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 px-4">
    <h2 class="text-center text-2xl font-bold text-blue-600">Arsip Dokumen Pendaftaran</h2>
    <p class="text-center text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>

    @foreach($programs as $program)
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                📁 {{ $program->name }}
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-[#679CEB] text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-center">CV</th>
                            <th class="px-4 py-2 text-center">Surat Persetujuan</th>
                            <th class="px-4 py-2 text-center">Transkrip</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($program->registrations as $item)
                        <tr class="border-b border-gray-300 hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $item->user->name }}</td>
                            <td class="px-4 py-2">{{ $item->user->email }}</td>
                            <td class="px-4 py-2 text-center">
                                @if ($item->cv)
                                <a href="{{ asset(str_replace('public/', 'storage/', $item->cv)) }}" target="_blank"
                                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                    Lihat CV
                                </a>
                                @else
                                    <span class="text-gray-400 italic">Kosong</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if ($item->surat_persetujuan)
                                <a href="{{ asset(str_replace('public/', 'storage/', $item->surat_persetujuan)) }}" target="_blank"
                                    class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 transition">
                                    Lihat Surat
                                </a>
                                @else
                                    <span class="text-gray-400 italic">Kosong</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if ($item->rekap_nilai)
                                <a href="{{ asset(str_replace('public/', 'storage/', $item->rekap_nilai)) }}" target="_blank"
                                    class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                                    Lihat Transkrip
                                </a>
                                @else
                                    <span class="text-gray-400 italic">Kosong</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection
