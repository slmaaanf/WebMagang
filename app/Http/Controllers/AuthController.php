<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:users,nik',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:User,Pembimbing',
            'g-recaptcha-response' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Silakan periksa kembali isian Anda.');
        }

        // Validasi Google reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        if (!$response->json()['success']) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Verifikasi Captcha gagal.'])->withInput();
        }

        // Simpan user ke database
        $user = User::create([
            'institution' => $request->institution,
            'major' => $request->major,
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => strtolower($request->role), // Pastikan format role sesuai database
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Akun Anda telah dibuat.');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'g-recaptcha-response' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validasi Google reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        if (!$response->json()['success']) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Verifikasi Captcha gagal.'])->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
        
            $user = Auth::user();
        
            // Cek role dan arahkan ke dashboard masing-masing
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Admin!');
            } elseif ($user->role === 'pembimbing') {
                return redirect()->route('pembimbing.dashboard')->with('success', 'Login berhasil sebagai Pembimbing!');
            } else {
                return redirect()->route('dashboard')->with('success', 'Login berhasil!');
            }
        }
        
        return redirect()->back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil.');
    }

    public function profile()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('profile.profile', compact('user'));
    }
}
