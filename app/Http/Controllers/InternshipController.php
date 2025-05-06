<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;
use App\Models\InternshipRegistration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InternshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except(['index', 'show', 'register', 'uploadCv', 'uploadGrades', 'uploadApproval']);
    }

    // 📌 Menampilkan daftar program magang (bisa diakses semua user)
    public function index()
    {
        $internships = Internship::all(); // Ambil semua data magang
        return view('internships.index', compact('internships'));
    }

    // 📌 Menampilkan detail program magang (bisa diakses semua user)
    public function show($id)
    {
        $internship = Internship::findOrFail($id);
        return view('internships.show', compact('internship'));
    }
    

    // 🔒 Menampilkan form tambah program magang (hanya admin)
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('internships.create');
    }

    // 📝 Menyimpan program magang baru (hanya admin)
    public function store(Request $request)
    {
        $roles = auth()->user()->roles;

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'qualifications' => 'required|string',
            'requirements' => 'required|string',
            'quota' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Internship::create($validatedData);

        return redirect()->route('internships.index')->with('success', 'Program magang berhasil ditambahkan!');
    }

    // 🔒 Menampilkan form edit program magang (hanya admin)
    public function edit($id)
    {
        // 1️⃣ Cek apakah user sudah login
        if (!auth()->check()) {
            abort(403, '❌ Unauthorized: User not logged in.');
        }

        $user = auth()->user();

        // 3️⃣ Pastikan hanya admin yang bisa mengakses
        if ($user->role !== 'admin') {
            abort(403, '❌ Unauthorized: User is not an admin.');
        }

        // 4️⃣ Cek apakah ID magang ada di database
        $internship = Internship::find($id);
        if (!$internship) {
            abort(404, '❌ Internship program not found.');
        }

        return view('internships.edit', compact('internship'));
    }

    // ✏️ Menyimpan perubahan program magang (hanya admin)
    public function update(Request $request, $id)
    {
        // Gate::authorize('admin-access');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'qualifications' => 'required|string',
            'requirements' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $internship = Internship::findOrFail($id);
        $internship->update($validatedData);

        return redirect()->route('internships.index')->with('success', 'Program magang berhasil diperbarui!');
    }

    // ❌ Menghapus program magang (hanya admin)
    public function destroy($id)
    {
        $internship = Internship::findOrFail($id);
        $internship->delete();

        return redirect()->route('internships.index')->with('success', 'Program magang berhasil dihapus!');
    }

    // 📌 Menampilkan form pendaftaran magang (hanya user login)
    public function register($id)
    {
        $internship = Internship::findOrFail($id);
        return view('internships.register', compact('internship'));
    }

    // 📤 Upload CV
    public function uploadCv(Request $request, $id)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        $fileName = time() . '_cv_' . $request->file('cv')->getClientOriginalName();
        $path = $request->file('cv')->storeAs('uploads', $fileName, 'public');

        return back()->with('success', 'CV berhasil diupload!');
    }

    // 📤 Upload Rekap Nilai
    public function uploadGrades(Request $request, $id)
    {
        $request->validate([
            'grades' => 'required|mimes:pdf|max:2048',
        ]);

        $fileName = time() . '_grades_' . $request->file('grades')->getClientOriginalName();
        $path = $request->file('grades')->storeAs('uploads', $fileName, 'public');

        return back()->with('success', 'Rekap Nilai berhasil diupload!');
    }

    // 📤 Upload Surat Persetujuan
    public function uploadApproval(Request $request, $id)
    {
        $request->validate([
            'approval' => 'required|mimes:pdf|max:2048',
        ]);

        $fileName = time() . '_approval_' . $request->file('approval')->getClientOriginalName();
        $path = $request->file('approval')->storeAs('uploads', $fileName, 'public');

        return back('/')->with('success', 'Surat Persetujuan Magang berhasil diupload!');
    }

    // ❌ Menghapus pendaftaran magang beserta file terkait (opsional)
    public function deleteRegistration($id)
    {
        $registration = InternshipRegistration::findOrFail($id);

        // Hapus file terkait
        Storage::disk('public')->delete([
            $registration->rekap_nilai,
            $registration->surat_persetujuan,
            $registration->cv,
        ]);

        // Hapus data dari database
        $registration->delete();

        return redirect()->route('internships.index')->with('success', 'Pendaftaran berhasil dihapus!');
    }
}
