<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipRegistration extends Model
{
    protected $fillable = [
    'internship_id', 'name', 'age', 'university','major', 'nik',
    'email', 'phone','rekap_nilai', 'surat_persetujuan', 'cv'
    ];

    protected $attributes = [
        'status_lowongan' => 'Belum Ditentukan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function internship() {
        return $this->belongsTo(Internship::class);
    }
}
