@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg p-6 rounded-xl w-full max-w-2xl">
        <h2 class="text-center text-2xl font-bold text-red-600 mb-4">Edit Program Magang</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/admin/internships/' . $internship->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-semibold">Nama Program</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                       value="{{ old('name', $internship->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold">Deskripsi</label>
                <textarea name="description" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                          rows="3" required>{{ old('description', $internship->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="location" class="block font-semibold">Lokasi</label>
                <input type="text" name="location" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                       value="{{ old('location', $internship->location) }}" required>
            </div>

            <!-- Ganti name menjadi 'requirements' -->
            <div class="mb-4">
                <label for="requirements" class="block font-semibold">Persyaratan</label>
                <textarea name="requirements" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                          rows="3" required>{{ old('requirements', $internship->requirements) }}</textarea>
            </div>

            <!-- Ganti name menjadi 'qualifications' -->
            <div class="mb-4">
                <label for="qualifications" class="block font-semibold">Kualifikasi</label>
                <textarea name="qualifications" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                          rows="3" required>{{ old('qualifications', $internship->qualifications) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="start_date" class="block font-semibold">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                           value="{{ old('start_date', $internship->start_date) }}" required>
                </div>

                <div>
                    <label for="end_date" class="block font-semibold">Tanggal Selesai</label>
                    <input type="date" name="end_date" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-red-400"
                           value="{{ old('end_date', $internship->end_date) }}" required>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-bold transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
