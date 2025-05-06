@extends('layouts.auth')

@section('content')
<style>
    body {
        background-image: url('{{ asset('banner2.png') }}');
        background-size: cover;
        background-position: center;
        font-family: 'Inter', sans-serif;
    }
    .login-container {
        max-width: 450px;
        background: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .login-title {
        font-family: 'Poppins', sans-serif;
        font-size: 24px;
        font-weight: bold;
        color: #2C3E50;
        text-align: center;
        margin-bottom: 20px;
    }
    .form-control {
        border-radius: 10px;
        padding-left: 40px;
    }
    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }
    .btn-login {
        background-color: #5E7CC7;
        color: white;
        font-weight: bold;
        border-radius: 10px;
    }
    .btn-login:hover {
        background-color: #4A66A0;
    }
    .register-link {
        text-align: center;
        margin-top: 15px;
    }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-container">
        <h2 class="login-title">Welcome to <br> Telkom Internship</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3 position-relative">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3 position-relative">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" name="password" placeholder="Password" id="password" required>
            </div>
            <div class="col-md-6 mb-3 text-end">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                @error('g-recaptcha-response')
                   <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>

        <p class="register-link">Belum punya akun? <a href="{{ route('register') }}" class="text-primary fw-bold">Daftar di sini</a></p>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
