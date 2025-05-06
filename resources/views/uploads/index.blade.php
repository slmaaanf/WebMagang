@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="text-center">Upload Dokumen</h3>
    <div class="card shadow-lg p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('uploads.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Upload CV (PDF/DOCX)</label>
                    <input type="file" class="form-control" name="cv">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Upload Formulir (PDF/DOCX)</label>
                    <input type="file" class="form-control" name="formulir">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-upload"></i> Upload</button>
        </form>
    </div>

    <h4 class="mt-4">Dokumen yang Diupload</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Nama</th>
                <th>CV</th>
                <th>Formulir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uploads as $upload)
                <tr>
                    <td>{{ $upload->user->name }}</td>
                    <td>
                        @if($upload->cv)
                            <a href="{{ asset('storage/'.$upload->cv) }}" target="_blank">Lihat CV</a>
                        @else
                            Belum diunggah
                        @endif
                    </td>
                    <td>
                        @if($upload->formulir)
                            <a href="{{ asset('storage/'.$upload->formulir) }}" target="_blank">Lihat Formulir</a>
                        @else
                            Belum diunggah
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
