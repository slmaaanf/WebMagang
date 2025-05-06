<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Upload;
use App\Models\InternshipRegistration;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'institution', 'major', 'nik', 'email', 'phone', 'password', 'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function upload(): HasOne
    {
        return $this->hasOne(Upload::class);
    }

    public function show($id)
    {
        $user = User::findOrFail($id); // cari user berdasarkan ID dari URL
        return view('profile.show', compact('user'));
    }

    public function internshipRegistration()
    {
        return $this->hasOne(InternshipRegistration::class);
    }

    public function internship()
    {
        return $this->hasOneThrough(
            Internship::class,
            InternshipRegistration::class,
            'user_id',      // Foreign key di internship_registrations
            'id',           // Primary key di internships
            'id',           // Local key di users
            'internship_id' // Foreign key di internship_registrations
        );
    }
    
    public function internships()
    {
        return $this->belongsToMany(Internship::class, 'internship_registrations')
                    ->withPivot('status_lowongan')
                    ->withTimestamps();
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('status')->withTimestamps();
    }
}
