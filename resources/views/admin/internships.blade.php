@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kelola Program Magang</h2>
    <a href="{{ route('admin.internships.create') }}" class="btn btn-success mb-3">Tambah Magang</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Posisi</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($internships as $internship)
                <tr>
                    <td>{{ $internship->company_name }}</td>
                    <td>{{ $internship->position }}</td>
                    <td>{{ $internship->description }}</td>
                    <td>
                        <a href="{{ route('admin.internships.edit', $internship->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.internships.destroy', $internship->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection