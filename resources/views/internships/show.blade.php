@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 relative">
    {{-- Button Kembali --}}
    <a href="{{ route('internships.index') }}" 
        class="absolute top-4 left-4 bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </a>

    <div class="bg-white shadow-lg rounded-2xl max-w-6xl w-full p-8">
        {{-- Header --}}
        <div class="bg-white text-blue-600 text-center rounded-t-2xl py-4 border-b-2 border-blue-600">
            <h3 class="text-3xl font-semibold">{{ $internship->name }}</h3>
        </div>

        {{-- Layout --}}
        <div class="flex flex-col md:flex-row gap-8 px-6 py-6">
            {{-- Kolom Kiri --}}
            <div class="flex-1 space-y-6">
                {{-- Deskripsi --}}
                <div>
                    <h5 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.1 0-2 .9-2 2v1h4v-1c0-1.1-.9-2-2-2zm-2 4v1h4v-1h-4zM12 4a8 8 0 00-8 8v5h16v-5a8 8 0 00-8-8z" />
                        </svg>
                        Deskripsi
                    </h5>
                    <p class="mt-1">{{ $internship->description }}</p>
                </div>

                {{-- Lokasi --}}
                <div>
                    <h5 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                        </svg>
                        Lokasi
                    </h5>
                    <p class="mt-1">{{ $internship->location }}</p>
                </div>
                {{-- Deadline --}}
                <div>
                    <h5 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Deadline Pendaftaran
                    </h5>
                    <p>{{ \Carbon\Carbon::parse($internship->deadline)->format('d M Y') }}</p>
                </div>

                {{-- Periode --}}
                <div>
                    <h5 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5V4H2v16h5m10 0V10m0 10h-4m4 0h4m-8 0v-6m0 6H7" />
                        </svg>
                        Periode Kerja Praktik
                    </h5>
                    <p>{{ \Carbon\Carbon::parse($internship->start_date)->format('d M Y') }} - 
                       {{ \Carbon\Carbon::parse($internship->end_date)->format('d M Y') }}</p>
                </div>

                {{-- Onboarding --}}
                <div>
                    <h5 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-2.21 0-4 1.79-4 4h8c0-2.21-1.79-4-4-4z" />
                        </svg>
                        Onboarding
                    </h5>
                    <p>{{ $internship->onboarding ?? '-' }}</p>
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="flex-1 space-y-6">
                {{-- Persyaratan --}}
                <div>
                    <h5 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6" />
                        </svg>
                        Persyaratan
                    </h5>
                    <ul class="mt-1 space-y-1 text-gray-700">
                        <li>✔ CV</li>
                        <li>✔ Surat Rekomendasi</li>
                        <li>✔ Transkrip Sementara</li>
                    </ul>
                </div>

                {{-- Kualifikasi --}}
                <div>
                    <h5 class="text-lg font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6" />
                        </svg>
                        Kualifikasi
                    </h5>
                    <ul class="mt-1 space-y-1 text-gray-700">
                        <li>✔ Mahasiswa minimal semester 5</li>
                        <li>✔ Memiliki kemampuan komunikasi yang baik</li>
                        <li>✔ Berorientasi pada detail dan hasil</li>
                    </ul>
                </div>
                {{-- Tombol Daftar --}}
                @auth
                    @if (auth()->user()->role === 'user')
                        <div class="flex justify-end">
                            <a href="{{ route('internships.register', $internship->id) }}" class="bg-blue-500 text-white px-8 py-2 rounded-md hover:bg-blue-600 transition">
                                Daftar
                            </a>
                        </div>
                    @endif
                @endauth

            </div>
        </div>
    </div>
</div>
@endsection