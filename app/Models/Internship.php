<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location', 'quota','qualifications', 'requirements', 'start_date', 'end_date'];

    // Relasi dengan applicants (anggap applicants adalah user yang mendaftar)
    public function applicants()
    {
        return $this->hasMany(InternshipRegistration::class);
    }

    public function registrations()
    {
        return $this->hasMany(InternshipRegistration::class);

    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'internship_registrations')
                    ->withPivot('status_lowongan')
                    ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
