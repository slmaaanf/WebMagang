<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        Application::create([
            'user_id' => 1,
            'internship_id' => 1,
            'status' => 'pending'
        ]);
    }
}