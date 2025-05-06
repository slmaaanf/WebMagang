@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4 font-weight-bold">Daftar Dokumen Peserta Magang</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol untuk melihat siapa saja yang sudah mengunggah CV dan Formulir -->
    <div class="mb-3">
        <a href="{{ route('pembimbing.uploads.completed') }}" class="btn btn-primary">Lihat Peserta yang Sudah Mengunggah</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Peserta</th>
                <th>Nama File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploads as $upload)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $upload->user->name }}</td>
                <td>{{ $upload->file_name }}</td>
                <td>
                    <a href="{{ route('pembimbing.uploads.show', $upload->id) }}" class="btn btn-success">Lihat</a>
                    <form action="{{ route('pembimbing.uploads.destroy', $upload->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus file ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
