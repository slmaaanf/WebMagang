@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Verifikasi Email Anda</h2>
    <p>Kami telah mengirimkan tautan verifikasi ke email Anda. Silakan periksa email dan klik tautan yang diberikan.</p>
    <p>Jika tidak menerima email, <a href="{{ route('verification.resend') }}">klik di sini untuk mengirim ulang</a>.</p>
</div>
@endsection
