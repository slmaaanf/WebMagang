@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">📊 Admin Dashboard</h1>

    {{-- Section: Daftar Internship --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Daftar Internship</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('internships.create') }}" class="btn btn-success mb-3">
                ➕ Tambah Internship
            </a>
            <ul class="list-group">
                @foreach($internships as $internship)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $internship->title }}
                        <span class="badge bg-info">{{ $internship->applicants->count() }} Pendaftar</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

   {{-- Section: Daftar User --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-secondary text-white">
        <h4 class="mb-0">Daftar User</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    {{-- Section: Daftar Pembimbing --}}
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Daftar Pembimbing</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mentors as $mentor)
                        <tr>
                            <td>{{ $mentor->name }}</td>
                            <td>{{ $mentor->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
