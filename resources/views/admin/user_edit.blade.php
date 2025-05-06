@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-6 px-4 sm:px-6 lg:px-8 relative">

    {{-- Tombol Kembali di pojok kiri atas --}}
    <a href="{{ route('admin.dashboard') }}" 
        class="absolute top-4 left-4 bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 transition inline-flex items-center shadow">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali
    </a>

    {{-- Form Edit User --}}
    <div class="max-w-xl w-full bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit Data User</h2>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label>No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Institusi</label>
                <input type="text" name="institution" value="{{ old('institution', $user->institution) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Jurusan</label>
                <input type="text" name="major" value="{{ old('major', $user->major) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>NIK</label>
                <input type="text" name="nik" value="{{ old('nik', $user->nik) }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label>Role</label>
                <select name="role" class="w-full border p-2 rounded">
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="pembimbing" {{ old('role', $user->role) == 'pembimbing' ? 'selected' : '' }}>Pembimbing</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@if (session('success'))
    <div class="fixed top-0 right-0 mt-5 mr-5 px-6 py-4 bg-green-500 text-white rounded shadow-lg z-50">
        <strong>🎉 {{ session('success') }}</strong>
    </div>
@endif
