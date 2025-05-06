<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Internship;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan hanya admin yang bisa mengakses
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        // Ambil data internships beserta relasi applicants
        $internships = Internship::with('applicants')->get();

        // Ambil semua user
        $users = User::all();

        // Ambil user dengan role 'mentor'
        $mentors = User::where('role', 'mentor')->get();

        return view('admin.dashboard', compact('internships', 'users', 'mentors'));
    }

    public function profile()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('profile.show', compact('user'));
    }

    public function arsip()
    {
    // Ambil semua program magang dengan relasi registrations dan user dari registrasi
    $programs = Internship::with(['registrations.user'])->get();

    return view('admin.arsip', compact('programs'));
    }
    
    public function index()
    {
        $internships = Internship::with('applicants')->get();

        // Ambil semua user dengan role 'user' dan 'mentor' (pastikan field 'role' ada)
        $jumlahPendaftar = User::where('role', 'user')->count();
        $jumlahPembimbing = User::where('role', 'pembimbing')->count();
        $jumlahProgram = Internship::count();

        // Kirim juga data lainnya seperti sebelumnya
        $users = User::where('role', 'user')->get();
        $mentors = User::where('role', 'pembimbing')->get();

        return view('admin.dashboard', compact(
            'internships',
            'users',
            'jumlahPendaftar',
            'jumlahPembimbing',
            'jumlahProgram',
            'mentors'));
        }
}