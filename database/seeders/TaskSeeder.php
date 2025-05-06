<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run()
    {
        Task::create([
            'title' => 'Complete Report',
            'description' => 'Submit final internship report.',
            'deadline' => now()->addWeeks(1),
            'status' => 'pending',
            'user_id' => 1,
            'file_path' => 'default.pdf' // Masukkan file default
        ]);
    }
}

