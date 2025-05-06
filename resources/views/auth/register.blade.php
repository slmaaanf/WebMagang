@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-3xl bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-center text-2xl font-bold mb-6">Register</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="institution" class="block font-medium">Instansi Pendidikan</label>
                    <select class="w-full p-2 border rounded" id="institution" name="institution" required>
                        <option value="">Pilih Instansi Pendidikan Anda</option>
                        <option value="Universitas Padjajaran">Universitas Padjajaran</option>
                        <option value="Universitas Pendidikan Indonesia">Universitas Pendidikan Indonesia</option>
                        <option value="Universitas Indonesia">Universitas Indonesia</option>
                        <option value="Institut Teknologi Bandung">Institut Teknologi Bandung</option>
                        <option value="Universitas Nusa Putra">Universitas Nusa Putra</option>
                        <option value="Politeknik Bandung">Politeknik Bandung</option>
                        <option value="Universitas Gajah Mada">Universitas Gajah Mada</option>
                        <option value="Universitas Muhammadiyah Sukabumi">Universitas Muhammadiyah Sukabumi</option>
                    </select>
                </div>

                <div>
                    <label for="major" class="block font-medium">Jurusan</label>
                    <select class="w-full p-2 border rounded" id="major" name="major" required>
                        <option value="">Pilih Jurusan Anda</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Manajemen Bisnis">Manajemen Bisnis</option>
                        <option value="Pendidikan Teknologi Informasi">Pendidikan Teknologi Informasi</option>
                        <option value="Seni Murni">Seni Murni</option>
                        <option value="Desain Grafis (DKV)">Desain Grafis (DKV)</option>
                        <option value="Manajemen Retail">Manajemen Retail</option>
                        <option value="Administrasi Publik">Administrasi Publik</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="name" class="block font-medium">Nama Lengkap</label>
                <input type="text" class="w-full p-2 border rounded" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="nik" class="block font-medium">Nomor Induk Kependudukan (NIK)</label>
                <input type="text"
                    class="w-full p-2 border rounded"
                    id="nik"
                    name="nik"
                    value="{{ old('nik') }}"
                    maxlength="16"
                    required>
                <p id="nikError" class="text-red-600 text-sm mt-1 hidden">NIK harus terdiri dari 16 digit angka</p>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block font-medium">Email</label>
                    <input type="email" class="w-full p-2 border rounded" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div>
                    <label for="phone" class="block font-medium">Nomor HP</label>
                    <input type="text" class="w-full p-2 border rounded" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block font-medium">Password</label>
                    <div class="relative">
                        <input type="password" class="w-full p-2 border rounded pr-10" id="password" name="password" required>
                        <button type="button" class="absolute right-3 top-3" onclick="togglePassword('password', 'togglePasswordIcon')">
                            <i id="togglePasswordIcon" class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block font-medium">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" class="w-full p-2 border rounded pr-10" id="password_confirmation" name="password_confirmation" required>
                        <button type="button" class="absolute right-3 top-3" onclick="togglePassword('password_confirmation', 'toggleConfirmPasswordIcon')">
                            <i id="toggleConfirmPasswordIcon" class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <label for="role" class="block font-medium">Peran</label>
                <select class="w-full p-2 border rounded" id="role" name="role" required>
                    <option value="">Pilih Peran</option>
                    <option value="User">User</option>
                    <option value="Pembimbing">Pembimbing</option>
                </select>
            </div>

            <div class="text-center">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            </div>

            <button type="submit" class="w-full bg-blue-700 text-white p-3 rounded hover:bg-blue-800">Daftar</button>
        </form>

        <p class="mt-3 text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-red-600">Login</a></p>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    function togglePassword(fieldId, iconId) {
        let field = document.getElementById(fieldId);
        let icon = document.getElementById(iconId);
        if (field.type === "password") {
            field.type = "text";
            icon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            field.type = "password";
            icon.classList.replace("fa-eye-slash", "fa-eye");
        }
    }
</script>

<script>
    const nikInput = document.getElementById('nik');
    const nikError = document.getElementById('nikError');

    nikInput.addEventListener('input', function () {
        const nik = nikInput.value;
        const isValid = /^\d{16}$/.test(nik);

        if (nik.length === 0 || isValid) {
            nikError.classList.add('hidden');
            nikInput.classList.remove('border-red-500');
            nikInput.classList.add('border-gray-300');
        } else {
            nikError.classList.remove('hidden');
            nikInput.classList.remove('border-gray-300');
            nikInput.classList.add('border-red-500');
        }
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
