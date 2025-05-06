<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Internship;

class InternshipSeeder extends Seeder
{
    public function run()
    {
        Internship::create([
            'name' => 'Digital Marketing',
            'description' => ' adalah strategi pemasaran yang menggunakan media digital untuk mempromosikan produk atau layanan. Digital marketing juga dikenal sebagai online marketing atau internet marketing. ',
            'location' => 'Sukabumi',
            'qualifications' => 'Memiliki gelar di bidang yang relevan, seperti desain grafis, desain interaksi, atau ilmu komputer
                                Mampu menggunakan perangkat lunak desain, seperti Adobe Photoshop, Illustrator, InDesign, After Effects, dan Dreamweaver
                                Memiliki pemahaman yang menyeluruh tentang desain grafis dan bahasa pengkodean',
            'requirements' => 'CV, Surat Rekomendasi, Transkip Nilai',
            'start_date' => now(),
            'end_date' => now()->addMonths(3)
        ]);
    }
}