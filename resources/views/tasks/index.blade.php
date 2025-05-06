@extends('layouts.app')

@section('content')
<!-- Daftar Tugas Magang -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Daftar Tugas Magang</h2>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">
        ➕ Tambah Tugas
    </a>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Program Magang</th>
                        <th>Jumlah Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($internships as $internship)
                        <tr>
                            <td>{{ $internship->name }}</td>
                            <td>{{ $internship->users->count() }}</td>
                            <td>
                                <button onclick="toggleDetail({{ $internship->id }})" class="btn btn-info btn-sm">
                                    🔍 Lihat
                                </button>
                            </td>
                        </tr>

                        <!-- Detail Peserta -->
                        <tr id="detail-{{ $internship->id }}" class="d-none">
                            <td colspan="3">
                                <div class="p-3">
                                    <h5>Peserta Program: {{ $internship->name }}</h5>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Judul Tugas</th>
                                                <th>File</th>
                                                <th>Deadline</th>
                                                <th>Nilai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $adaPeserta = false; @endphp
                                            @forelse ($internship->users as $user)
                                                @if (strcasecmp($user->pivot->status_lowongan, 'diterima') === 0)
                                                    @php $adaPeserta = true; @endphp
                                                    @forelse ($user->tasks as $task)
                                                        <tr>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $task->title }}</td>
                                                            <td>
                                                                @if ($task->file_path)
                                                                    <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">Lihat</a>
                                                                @else
                                                                    <span class="text-muted">Belum ada</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</td>
                                                            <td>{{ $task->grade ?? 'Belum Dinilai' }}</td>
                                                            <td>
                                                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')">Hapus</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="6" class="text-muted">Belum ada tugas</td></tr>
                                                    @endforelse
                                                @endif
                                            @empty
                                                <tr><td colspan="6" class="text-muted">Belum ada peserta</td></tr>
                                            @endforelse

                                            @if (!$adaPeserta)
                                                <tr><td colspan="6" class="text-muted">Belum ada peserta yang diterima</td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function toggleDetail(id) {
    const row = document.getElementById(`detail-${id}`);
    row.classList.toggle('d-none');
}
</script>
@endsection
