@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl py-6 px-4">
    <h2 class="text-2xl font-bold text-center mb-6 flex items-center justify-center gap-2 text-gray-800">
        <i class="fas fa-edit"></i> Edit Tugas
    </h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block font-semibold">Judul Tugas</label>
                <input type="text" id="title" name="title" value="{{ $task->title }}"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-400"
                    required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-400"
                    required>{{ $task->description }}</textarea>
            </div>

            <div>
                <label for="deadline" class="block font-semibold">Batas Waktu</label>
                <input type="date" id="deadline" name="deadline" class="w-full border border-gray-300 p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('tasks.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow text-sm flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
