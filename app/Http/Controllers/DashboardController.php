<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Task;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index'); // Sesuaikan dengan view yang Anda gunakan
    }

    public function userDashboard()
    {
        $tasks = Task::where('user_id', Auth::id())->with('user')->get();
        
        return view('dashboard.user', compact('tasks'));
    }
}