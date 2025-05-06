@extends('layouts.app')

@section('content')
<style>
    .upload-wrapper {
        background: #fff;
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        max-width: 900px;
        margin: auto;
    }

    .upload-title {
        color: #4A90E2;
        font-weight: 600;
        margin-bottom: 30px;
        font-size: 22px;
        text-align: center;
    }

    .file-upload-box {
        background-color: #F7F9FC;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #E0E0E0;
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
    }

    .upload-label {
        font-weight: 500;
        margin-bottom: 8px;
        font-size: 16px;
        color: #333;
    }

    .upload-label small {
        color: #888;
        font-size: 12px;
    }

    .file-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .file-row input[type="file"] {
        flex-grow: 1;
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #fff;
    }

    .remove-file-btn {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #d00;
        transition: color 0.2s;
    }

    .remove-file-btn:hover {
        color: #a00;
    }

    .upload-btn {
        background-color: #4A90E2;
        color: white;
        font-weight: 500;
        padding: 12px 24px;
        border-radius: 10px;
        border: none;
        transition: background-color 0.3s;
    }

    .upload-btn:hover {
        background-color: #357ABD;
    }

    .centered-upload-btn {
        margin-top: 20px;
        width: 100%;
        max-width: 300px;
        text-align: center;
    }
</style>

<div class="container my-5">
    <div class="upload-wrapper">
        <h4 class="upload-title">Upload Dokumen {{ $internship->name }}</h4>

        @auth
        <form action="{{ route('uploads.storeUser') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="internship_id" value="{{ $internship->id }}">

            <div class="file-upload-box">
                <label class="upload-label">CV <small>(PDF, Max 2MB)</small></label>
                <div class="file-row">
                    <input type="file" name="cv" required>
                    <button type="button" class="remove-file-btn" onclick="resetInput(this)">🗑️</button>
                </div>
            </div>

            <div class="file-upload-box">
                <label class="upload-label">Rekap Nilai <small>(PDF, Max 2MB)</small></label>
                <div class="file-row">
                    <input type="file" name="rekap_nilai" required>
                    <button type="button" class="remove-file-btn" onclick="resetInput(this)">🗑️</button>
                </div>
            </div>

            <div class="file-upload-box">
                <label class="upload-label">Surat Persetujuan Magang <small>(PDF, Max 2MB)</small></label>
                <div class="file-row">
                    <input type="file" name="surat_persetujuan" required>
                    <button type="button" class="remove-file-btn" onclick="resetInput(this)">🗑️</button>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="upload-btn centered-upload-btn">Upload Semua Dokumen</button>
            </div>
        </form>
        @endauth
    </div>
</div>

<script>
    function resetInput(btn) {
        const fileInput = btn.previousElementSibling;
        fileInput.value = "";
    }
</script>
@endsection

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notifSound = document.getElementById('notifSound');
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '🎉 {{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    notifSound.play();
                }
            });
        });
    </script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<audio id="notifSound" src="{{ asset('sounds/notify.mp3') }}" preload="auto"></audio>
