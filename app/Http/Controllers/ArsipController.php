<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship; // Sesuaikan dengan model data yang digunakan

class ArsipController extends Controller
{
    public function index()
    {
        $data = Internship::all(); // Ambil data magang
        return view('admin.arsip', compact('data'));
    }
}
