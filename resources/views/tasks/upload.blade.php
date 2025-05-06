@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Upload File Tugas</h2>

    <form action="{{ route('tasks.upload', ['task' => $task->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Upload File Tugas</h2>

    {{-- Tampilkan status file --}}
    @if ($task->file)
        <div class="mb-4 p-3 bg-green-100 border border-green-400 rounded">
            <p class="text-green-800 font-semibold">📁 File sudah dikumpulkan:</p>
            <p class="text-sm break-words">{{ $task->file }}</p>
        </div>
    @else
        <div class="mb-4 p-3 bg-yellow-100 border border-yellow-400 rounded">
            <p class="text-yellow-800 font-semibold">⚠️ Belum mengumpulkan file</p>
        </div>
    @endif

    {{-- Form upload --}}
    <form action="{{ route('tasks.upload', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="status" class="block font-semibold mb-1">Status</label>
            <select id="status" name="status" class="w-full border border-gray-300 p-2 rounded">
                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="file" class="block font-semibold mb-1">Pilih File Baru (jika ingin mengganti):</label>
            <input type="file" name="file" class="w-full border p-2 rounded">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload File</button>
        </div>
    </form>
</div>
@endsection
