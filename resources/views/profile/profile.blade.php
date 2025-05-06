@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="bg-white shadow-xl rounded-2xl p-6 md:p-8 max-w-5xl mx-auto">
        <h2 class="text-center text-2xl md:text-3xl font-bold text-blue-700 mb-8 md:mb-10">Profil Pengguna</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
            <!-- FOTO PROFIL DAN UPLOAD -->
            <div class="flex flex-col items-center">
                <!-- Foto Profil -->
                <div class="relative">
                    @if($user->profile_picture)
                    <img src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}"
                         class="w-36 h-36 md:w-48 md:h-48 object-cover rounded-full border-4 border-blue-300 shadow-md transition hover:scale-105 duration-300"
                         alt="Foto Profil">
                    @else
                    <img src="{{ asset('images/profile/default.png') }}"
                         class="w-36 h-36 md:w-48 md:h-48 object-cover rounded-full border-4 border-blue-300 shadow-md"
                         alt="Foto Default">
                    @endif                    
                </div>

                <!-- Form Upload Foto -->
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-5 w-full max-w-xs px-2 space-y-3">
                    @csrf
                    <label class="block text-sm font-semibold text-gray-600 text-center">Ganti Foto Profil</label>

                    <input type="file" name="profile_picture" accept="image/*" required
                        class="w-full text-sm text-gray-600
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-full file:border-0
                               file:text-sm file:font-semibold
                               file:bg-blue-100 file:text-blue-700
                               hover:file:bg-blue-200 transition duration-200 ease-in-out">

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold text-sm transition">
                        <i class="fas fa-upload mr-1"></i> Unggah
                    </button>

                    @error('profile_picture')
                        <p class="text-red-500 text-xs md:text-sm text-center">{{ $message }}</p>
                    @enderror

                    @if(session('success'))
                        <p class="text-green-600 text-xs md:text-sm text-center">{{ session('success') }}</p>
                    @endif
                </form>
            </div>

            <!-- INFORMASI PROFIL -->
            <div class="col-span-2 text-gray-700 space-y-5">
                @php
                    $iconStyle = "w-5 h-5 text-blue-500 mr-2 md:mr-3";
                    $textStyle = "flex items-center text-sm md:text-base";
                @endphp

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.293.534 6.121 1.474M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span><strong>Nama:</strong> {{ $user->name }}</span>
                </div>

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M16 12a4 4 0 01-8 0 4 4 0 018 0z" /><path stroke-linecap="round" stroke-linejoin="round"
                         d="M12 14v7m0-7H8m4 0h4" />
                    </svg>
                    <span><strong>Email:</strong> {{ $user->email }}</span>
                </div>

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M3 10h11m0 0h2a2 2 0 012 2v5a2 2 0 01-2 2h-2m-3-9v7m0-7H8m4 0h4" />
                    </svg>
                    <span><strong>No. Telepon:</strong> {{ $user->phone ?? 'Tidak tersedia' }}</span>
                </div>

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M12 22s8-4 8-10a8 8 0 10-16 0c0 6 8 10 8 10z" />
                    </svg>
                    <span><strong>Alamat:</strong> {{ $user->address ?? 'Tidak tersedia' }}</span>
                </div>

                @if(auth()->user()->role == 'user' || auth()->user()->role == 'pembimbing')
                <hr class="my-4">
                <div class="space-y-2">
                    <h5 class="text-lg font-semibold text-gray-800">Informasi Magang</h5>

                    @if(auth()->user()->role == 'pembimbing')
                        <p><strong>Program Magang:</strong> -</p>
                        <p><strong>Status:</strong> Pembimbing</p>
                    @else
                        @php
                            $registration = $user->internshipRegistration;
                        @endphp

                        @if($registration && $registration->status_lowongan == 'Diterima' && $user->internship)
                            <p><strong>Program Magang:</strong> {{ $user->internship->name }}</p>
                            <p><strong>Status:</strong> Peserta</p>
                        @else
                            <p><strong>Program Magang:</strong> -</p>
                            <p><strong>Status:</strong> -</p>
                        @endif
                    @endif
                </div>
                @endif

                <!-- Tombol Edit -->
                <div class="pt-6 text-center md:text-right">
                    <a href="{{ route('profile.edit') }}"
                       class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold shadow transition">
                        <i class="fas fa-edit mr-2"></i>Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
