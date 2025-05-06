<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Application; // Model untuk pendaftaran magang
use App\Models\Task; // Model untuk tugas
use App\Models\Upload; // Model untuk file upload
use App\Models\InternshipRegistration; // Model untuk dokumen user
use App\Models\Internship;

class PembimbingController extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil user yang sedang login (pembimbing)
        $pembimbing = Auth::user();

        // Ambil query pencarian (kalau ada)
        $search = $request->input('search');

         // Ambil data registrasi magang untuk user yang sedang login
        $registration = InternshipRegistration::where('user_id', $pembimbing->id)->first();

        // Ambil semua pendaftaran magang beserta user dan program magang (internship)
        $registrations = InternshipRegistration::with(['user', 'internship'])
        ->when($search, function ($query, $search) {
            return $query->whereHas('internship', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            });
        })
        ->get();

        // Filter user berdasarkan data registrasi yang sudah difilter (agar hanya tampil user terkait pencarian)
        $userIds = $registrations->pluck('user_id')->unique();
        $users = User::whereIn('id', $userIds)->where('role', 'user')->get();

        // ✅ Tambahkan ini
        $internships = Internship::with(['users.tasks'])->get();
        
        // Ambil semua aplikasi magang yang diajukan oleh peserta
        $applications = Application::with('user')->get();

        // Ambil semua tugas yang sudah dikerjakan oleh peserta
        $tasks = Task::with('users')->get();

        // Ambil data upload berdasarkan user_id
        $uploads = Upload::all()->keyBy('user_id');

        // Ambil nama-nama posisi 
        $positions = Internship::pluck('name')->unique();


        // Kirim semua variabel ke view
        return view('dashboard.pembimbing', compact(
            'pembimbing',
            'users',
            'applications',
            'tasks',
            'uploads',
            'registration',
            'registrations',
            'internships',
            'positions'
        ));
    }

    public function profile()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        $registration = InternshipRegistration::where('user_id', $id)->first();

        return view('pembimbing.profile.show', compact('user', 'registration'));
    }

    public function updateStatusLowongan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status_lowongan' => 'required|in:Belum Ditentukan,Diterima,Ditolak',
        ]);
    
        $registration = InternshipRegistration::where('user_id', $request->user_id)->first();
    
        if ($registration) {
            $registration->status_lowongan = $request->status_lowongan;
            $registration->save();
    
            return response()->json(['message' => 'Status berhasil diperbarui.']);
        }
    
        return response()->json(['message' => 'Registrasi tidak ditemukan.'], 404);
    }

    public function showTasksByInternship($id)
    {
        $internship = Internship::with(['users.tasks' => function ($query) {
            $query->withPivot('file_path', 'deadline', 'grade');
        }])->findOrFail($id);

        return view('admin.tasks_by_internship', compact('internships'));
    }

    public function index()
    {
        $internships = Internship::with(['users.tasks'])->get();
        return view('pembimbing.dashboard', compact('internships'));
    }

    
}

