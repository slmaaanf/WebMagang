@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 p-6 bg-white rounded shadow-md">
    <h2 class="text-3xl font-bold text-blue-600 mb-6">Edit Profil</h2>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Foto Profil -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Foto Profil</label>
            <input type="file" name="photo"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('photo') border-red-500 @enderror">
            @error('photo')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nama -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
            @error('email')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- No. Telepon -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">No. Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
            @error('phone')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Alamat -->
        <div class="mb-5">
            <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
            <textarea name="address" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror">{{ old('address', $user->address) }}</textarea>
            @error('address')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold">
            Simpan
        </button>
    </form>
</div>

<!-- Konfirmasi sebelum submit -->
{{-- <script>
    document.getElementById('editProfileForm').addEventListener('submit', function(event) {
        const confirmed = confirm('Apakah Anda yakin ingin menyimpan perubahan profil?');
        if (!confirmed) {
            event.preventDefault(); // Membatalkan submit jika user klik "Batal"
        }
    });
</script> --}}

<!-- Tambahkan SweetAlert2 jika belum -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('editProfileForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Cegah submit otomatis

        Swal.fire({
            title: 'Simpan Perubahan Profil?',
            html: `
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="80" alt="User Icon" style="margin-bottom: 10px;">
                <p style="font-size: 16px;">Pastikan data profil sudah benar sebelum disimpan.</p>
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#4CAF50',
            cancelButtonColor: '#F44336',
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal',
            backdrop: `rgba(0,0,123,0.1)`,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit jika dikonfirmasi
            }
        });
    });
</script>

@endsection