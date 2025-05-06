@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 px-4">
    <h2 class="text-center text-2xl font-bold text-blue-600">User Dashboard</h2>
    <p class="text-center text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>

    <div class="overflow-x-auto mt-6">
        <table class="w-full border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Judul Task</th>
                    <th class="px-4 py-2">File</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Nilai</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($tasks as $task)
                <tr class="border-b border-gray-300 hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $task->user->name }}</td>
                    <td class="px-4 py-2">{{ $task->title }}</td>
                    <td class="px-4 py-2 text-center">
                        @if($task->file)
                            <a href="{{ asset('storage/' . $task->file) }}" 
                               class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                               Lihat File
                            </a>
                        @else
                            <span class="text-red-500">Tidak ada file</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center">
                        <span class="px-3 py-1 rounded 
                            {{ $task->status == 'Completed' ? 'bg-green-500 text-white' : 'bg-yellow-400 text-gray-800' }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-center">
                        @if($task->grade)
                            <span class="font-bold text-green-600">{{ $task->grade }}</span>
                        @else
                            <span class="text-gray-500 italic">Belum dinilai</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
