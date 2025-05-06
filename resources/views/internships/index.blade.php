@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Judul --}}
    <div class="flex justify-center mb-8">
        <h3 class="text-2xl md:text-3xl font-bold text-blue-600 text-center">Internship Management</h3>
    </div>

    @if($internships->isEmpty())
        <p class="text-center text-gray-500 text-base md:text-lg">Belum ada program magang yang tersedia.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($internships as $internship)
                <div class="flex flex-col justify-between bg-white rounded-2xl shadow-md border border-gray-100 p-5 hover:shadow-lg transition duration-300">
                    <div class="space-y-4">
                        {{-- Nama dan Lokasi --}}
                        <div>
                            <h5 class="text-lg md:text-xl font-semibold text-gray-800">{{ $internship->name }}</h5>
                            <p class="text-sm text-gray-500">Telkom Indonesia</p>
                        </div>

                        <hr class="border-gray-300">

                        {{-- Detail Lokasi dan Mode --}}
                        <div class="text-sm text-gray-600 space-y-2">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                </svg>
                                {{ $internship->location ?? 'Sukabumi' }}
                            </div>
                            <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded">
                                Work From Office
                            </span>
                        </div>

                        {{-- Kuota dan Pelamar --}}
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                Kuota: {{ $internship->quota ?? '-' }}
                            </span>
                            <span class="bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                Pelamar: {{ $internship->applicants_count ?? 0 }}
                            </span>
                        </div>

                        {{-- Informasi Tanggal --}}
                        <div class="text-sm text-gray-700 space-y-1 mt-3">
                            <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($internship->deadline)->format('d M Y') }}</p>
                            <p><strong>Periode:</strong> {{ $internship->start_date }} - {{ $internship->end_date }}</p>
                            <p><strong>Onboarding:</strong> {{ $internship->onboarding_date ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Tombol Lihat Selengkapnya --}}
                    <div class="mt-6 text-right">
                        <a href="{{ route('internships.show', $internship->id) }}" 
                           class="inline-block text-blue-600 font-semibold hover:underline text-sm">
                            Lihat Selengkapnya →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notifSound = document.getElementById('notifSound');
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '🎉 {{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    notifSound.play();
                }
            });
        });
    </script>
@endif

{{-- SweetAlert2 & Audio Notifikasi --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<audio id="notifSound" src="{{ asset('sounds/notify.mp3') }}" preload="auto"></audio>
