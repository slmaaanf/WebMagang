<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'participants'; // Nama tabel di database

    protected $fillable = [
        'user_id',
        'pembimbing_id',
        'name',
        'email',
        'phone',
        'cv',
        'registration_form'
    ];

    /**
     * Relasi ke model User (peserta magang)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model User sebagai pembimbing
     */
    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }
}
