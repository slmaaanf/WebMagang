<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'cv', 'rekap_nilai', 'surat_persetujuan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function internshipRegistration()
    {
        return $this->hasOne(InternshipRegistration::class);
    }
}
