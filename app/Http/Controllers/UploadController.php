<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\InternshipRegistration;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function storeUser(Request $request)
    {
        $request->validate([
            'internship_id' => 'required|exists:internships,id', // validasi tambahan
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'rekap_nilai' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'surat_persetujuan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = Auth::user();

        // Ambil atau buat data registrasi untuk kombinasi user dan internship
        $registration = InternshipRegistration::firstOrNew([
            'user_id' => $user->id,
            'internship_id' => $request->internship_id,
        ]);

        // Auto-isi data user
        $registration->user_id = $user->id;
        $registration->internship_id = $request->internship_id; // simpan program
        $registration->name = $user->name;
        $registration->nik = $user->nik;
        $registration->university = $user->institution;
        $registration->jurusan= $user->major;
        $registration->email = $user->email;
        $registration->phone = $user->phone;

        // Direktori user
        $directory = "uploads/user_{$user->name}";

        // Handle CV
        if ($request->hasFile('cv')) {
            if ($registration->cv) {
                Storage::delete($registration->cv);
            }

            $filename = 'cv.' . $request->file('cv')->getClientOriginalExtension();
            $path = $request->file('cv')->storeAs("public/{$directory}", $filename);
            $registration->cv = $path;
        }

        // Handle Rekap Nilai
        if ($request->hasFile('rekap_nilai')) {
            if ($registration->rekap_nilai) {
                Storage::delete($registration->rekap_nilai);
            }

            $filename = 'rekap_nilai.' . $request->file('rekap_nilai')->getClientOriginalExtension();
            $path = $request->file('rekap_nilai')->storeAs("public/{$directory}", $filename);
            $registration->rekap_nilai = $path;
        }

        // Handle Surat Persetujuan
        if ($request->hasFile('surat_persetujuan')) {
            if ($registration->surat_persetujuan) {
                Storage::delete($registration->surat_persetujuan);
            }

            $filename = 'surat_persetujuan.' . $request->file('surat_persetujuan')->getClientOriginalExtension();
            $path = $request->file('surat_persetujuan')->storeAs("public/{$directory}", $filename);
            $registration->surat_persetujuan = $path;
        }

        $registration->save();
        return redirect()->route('internships.index')->with('success', 'Dokumen berhasil diupload!');

    }

}