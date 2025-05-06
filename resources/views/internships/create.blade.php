@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-center text-2xl font-bold text-blue-600 mb-6">Tambah Program</h2>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-600 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.internships.store') }}" method="POST">
            @csrf

            <!-- Judul -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Judul</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg" placeholder="Masukkan nama program" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Deskripsi</label>
                <textarea name="description" class="w-full px-4 py-2 border rounded-lg" rows="3" placeholder="Deskripsikan program magang" required></textarea>
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Lokasi</label>
                <input type="text" name="location" class="w-full px-4 py-2 border rounded-lg" placeholder="Masukkan lokasi" required>
            </div>

            <!-- Persyaratan -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Persyaratan</label>
                <textarea name="requirements" class="w-full px-4 py-2 border rounded-lg" rows="3" placeholder="Masukkan persyaratan" required></textarea>
            </div>

            <!-- ✅ Kualifikasi -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Kualifikasi</label>
                <textarea name="qualifications" class="w-full px-4 py-2 border rounded-lg" rows="3" placeholder="Masukkan kualifikasi" required></textarea>
            </div>

            <!-- Kuota -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Kuota</label>
                <input type="number" name="quota" class="w-full px-4 py-2 border rounded-lg" placeholder="Masukkan kuota" required>
            </div>


            <!-- Tanggal Mulai dan Selesai -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="w-full px-4 py-2 border rounded-lg" value="{{ old('start_date') }}" required>
                </div>
                <div>
                    <label class="block font-semibold text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="w-full px-4 py-2 border rounded-lg" value="{{ old('end_date') }}" required>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
