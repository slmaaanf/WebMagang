<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contact()
    {
        return view('pages.contact', [
            'title' => 'Kontak Kami',
            'email' => 'info@telkominternships.com',
            'phone' => ' +62523000843',
            'address' => 'Jl. Masjid No.1, Gunungparang, Kec. Cikole, Kota Sukabumi, Jawa Barat 43111'
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'title' => 'Tentang Kami',
            'description' => 'Telkom Internships adalah platform penyedia program magang berkualitas bagi mahasiswa dan fresh graduate untuk mendapatkan pengalaman kerja di industri teknologi.'
        ]);
    }
}
