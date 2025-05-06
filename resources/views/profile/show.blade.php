@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-5xl mx-auto relative">

        <a href="{{ auth()->user()->role == 'admin' ? route('admin.dashboard') : route('pembimbing.dashboard') }}"
            class="absolute top-4 left-4 bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition inline-flex items-center shadow">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        <h2 class="text-center text-3xl font-bold text-blue-700 mb-10">Profil User / Pembimbing</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- FOTO PROFIL DAN STATUS -->
            <div class="flex flex-col items-center space-y-4">
                <div class="relative">
                    @if($user->photo)
                    <img src="{{ asset('storage/photos/' . $user->photo) }}"
                        class="w-48 h-48 object-cover rounded-full border-4 border-blue-300 shadow-md transition hover:scale-105 duration-300"
                        alt="Foto Profil">
                    @else
                    <img src="{{ asset('images/profile/default.png') }}"
                        class="w-48 h-48 object-cover rounded-full border-4 border-blue-300 shadow-md"
                        alt="Foto Profil">
                    @endif

                    @if(auth()->user()->role == 'pembimbing')
                    <div class="mt-6 text-center">
                        <label class="block mb-2 font-semibold text-gray-700">Status Lowongan</label>
                        <select name="status_lowongan" class="border rounded px-3 py-2 shadow text-sm"
                            onchange="submitStatus(this, {{ $user->id }})">
                            <option value="Belum Ditentukan" {{ $user->internshipRegistration &&
                                $user->internshipRegistration->status_lowongan == 'Belum Ditentukan' ? 'selected' : ''
                                }}>Belum Ditentukan</option>
                            <option value="Diterima" {{ $user->internshipRegistration &&
                                $user->internshipRegistration->status_lowongan == 'Diterima' ? 'selected' : ''
                                }}>Diterima</option>
                            <option value="Ditolak" {{ $user->internshipRegistration &&
                                $user->internshipRegistration->status_lowongan == 'Ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>
                    @endif
                </div>
            </div>


            <!-- INFORMASI PROFIL -->
            <div class="md:col-span-2 text-gray-700 space-y-5">
                @php
                $iconStyle = "w-5 h-5 text-blue-500 mr-3";
                $textStyle = "flex items-center text-sm md:text-base";
                @endphp

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.293.534 6.121 1.474M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span><strong>Nama:</strong> {{ $user->name }}</span>
                </div>

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 01-8 0 4 4 0 018 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14v7m0-7H8m4 0h4" />
                    </svg>
                    <span><strong>Email:</strong> {{ $user->email }}</span>
                </div>

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h11m0 0h2a2 2 0 012 2v5a2 2 0 01-2 2h-2m-3-9v7m0-7H8m4 0h4" />
                    </svg>
                    <span><strong>No. Telepon:</strong> {{ $user->phone ?? 'Tidak tersedia' }}</span>
                </div>

                @if(auth()->user()->role == 'admin')
                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5s-3 1.343-3 3 1.343 3 3 3zM5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.293.534 6.121 1.474" />
                    </svg>
                    <span><strong>NIK:</strong> {{ $user->nik ?? 'Tidak tersedia' }}</span>
                </div>
                @endif

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l6.16-3.422A12.083 12.083 0 0120 17.5c0 1.086-.142 2.137-.407 3.125L12 14z" />
                    </svg>
                    <span><strong>Jurusan:</strong> {{ $user->major ?? 'Tidak tersedia' }}</span>
                </div>

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 22s8-4 8-10a8 8 0 10-16 0c0 6 8 10 8 10z" />
                    </svg>
                    <span><strong>Institusi:</strong> {{ $user->institution ?? 'Tidak tersedia' }}</span>
                </div>

                <div class="{{ $textStyle }}">
                    <svg class="{{ $iconStyle }}" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 110-8 4 4 0 010 8z" />
                    </svg>
                    <span class="block"><strong>Alamat:</strong> {{ $user->address ?? 'Tidak tersedia' }}</span>
                </div>

                @if (
                $user->role === 'user' &&
                $user->internshipRegistration &&
                $user->internshipRegistration->status_lowongan === 'Diterima' &&
                $user->internship
                )
                <p><strong>Program Magang:</strong> {{ $user->internship->name }}</p>
                @else
                <p><strong>Program Magang:</strong> -</p>
                @endif

                @if(auth()->user()->role == 'pembimbing')
                <div>
                    <h5 class="text-lg font-semibold text-gray-800 mb-2">Dokumen Pendaftaran</h5>
                    @if ($user->internshipRegistration)
                    <div class="flex flex-wrap gap-3">
                        @if ($user->internshipRegistration->cv)
                        <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition"
                            onclick="window.open('{{ asset(str_replace('public/', 'storage/', $user->internshipRegistration->cv)) }}', '_blank')">
                            CV
                        </button>
                        @endif
                        @if ($user->internshipRegistration->surat_persetujuan)
                        <button class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 transition"
                            onclick="window.open('{{ asset(str_replace('public/', 'storage/', $user->internshipRegistration->surat_persetujuan)) }}', '_blank')">
                            Surat
                        </button>
                        @endif
                        @if ($user->internshipRegistration->rekap_nilai)
                        <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition"
                            onclick="window.open('{{ asset(str_replace('public/', 'storage/', $user->internshipRegistration->rekap_nilai)) }}', '_blank')">
                            Nilai
                        </button>
                        @endif
                    </div>
                    @else
                    <p class="text-sm text-gray-500 italic">Belum upload dokumen.</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function submitStatus(select, userId) {
    const status = select.value;

    if (!confirm("Apakah kamu yakin ingin mengubah status menjadi '" + status + "'?")) {
        // Balikin ke status sebelumnya kalau dibatalkan (opsional)
        location.reload();
        return;
    }
    fetch("{{ route('update.status.lowongan') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            user_id: userId,
            status_lowongan: status
        })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    })
    .catch(err => {
        console.error(err);
        alert("Gagal memperbarui status.");
    });
}

</script>