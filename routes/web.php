<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

// **🏠 Halaman Utama**
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('home');
})->name('home');

// **🔒 Routes untuk tamu (Guest)**
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

});

Route::get('/profile', [AuthController::class, 'profile'])
    ->name('profile.show')
    ->middleware('auth'); 

// **🔓 Logout (Hanya untuk User yang sudah login)**
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// **📌 Informasi Umum**
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/about', [PageController::class, 'about'])->name('about');

// **📢 Program Magang (Dapat diakses tanpa login)**
Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index');
Route::get('/internships/{id}', [InternshipController::class, 'show'])->name('internships.show');

//Melihat profil user dan pembimbing oleh admin
Route::get('/profile/user/{id}', [UserController::class, 'showProfile'])->name('user.profile');
Route::get('/profile/pembimbing/{id}', [PembimbingController::class, 'showProfile'])->name('pembimbing.profile');

//Edit dan lihat profile oleh user
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile.show');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.show');
Route::post('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.update.info');
Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');


// Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');

Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');


// **🔐 Routes setelah login**
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/tasks/{task}/upload', [TaskController::class, 'uploadForm'])->name('tasks.upload.form');
    Route::put('/tasks/{task}/upload', [TaskController::class, 'uploadFile'])->name('tasks.upload');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile.show');

     // ✅ Tambahkan route update foto profil
     Route::post('/profile/update-picture', [ProfileController::class, 'update'])->name('profile.update-picture');

     Route::get('/tasks/{task}/upload', [TaskController::class, 'uploadForm'])->name('tasks.upload.form');
     Route::put('/tasks/{task}/upload', [TaskController::class, 'uploadFile'])->name('tasks.upload');

    // **👤 Routes untuk User**
    Route::prefix('user')->middleware('role:user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

        Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
        
        // 📝 Pendaftaran Program Magang
        Route::get('/internships/{id}/register', [InternshipController::class, 'register'])->name('internships.register');
        Route::post('/internships/{id}/register', [InternshipController::class, 'submitRegistration'])->name('internships.submit');

        // 🔼 Upload Dokumen oleh User
        Route::post('/internships/{id}/uploadResume', [InternshipController::class, 'uploadResume'])->name('internships.uploadResume');
        Route::post('/internships/{id}/uploadCv', [InternshipController::class, 'uploadCv'])->name('internships.uploadCv');
        Route::post('/internships/{id}/uploadGrades', [InternshipController::class, 'uploadGrades'])->name('internships.uploadGrades');
        Route::post('/internships/{id}/uploadApproval', [InternshipController::class, 'uploadApproval'])->name('internships.uploadApproval');

        // 💬 Menambahkan Komentar pada Program Magang
        Route::post('/internships/{id}/addComment', [InternshipController::class, 'addComment'])->name('internships.addComment');

        // 🔼 Upload Dokumen oleh User
        Route::post('/uploads', [UploadController::class, 'storeUser'])->name('uploads.storeUser');


    });

    // **🎓 Routes untuk Pembimbing**
    Route::prefix('pembimbing')->middleware('role:pembimbing')->group(function () {
        Route::get('/dashboard', [PembimbingController::class, 'dashboard'])->name('pembimbing.dashboard');

        // 🔄 Profil Pembimbing
        Route::get('/profile', [PembimbingController::class, 'profile'])->name('pembimbing.profile');
        Route::put('/profile/update', [PembimbingController::class, 'updateProfile'])->name('pembimbing.profile.update');

        // 📌 Manajemen Tugas
        Route::get('/tasks', [TaskController::class, 'index'])->name('pembimbing.tasks.index');
        Route::put('/tasks/{task}/review', [TaskController::class, 'review'])->name('pembimbing.tasks.review');
        Route::resource('tasks', TaskController::class);
        // Menambah tugas
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

        // Input Nilai
        Route::post('/tasks/{task}/grade', [TaskController::class, 'grade'])->name('tasks.grade');

        // 🔼 Upload Dokumen oleh Pembimbing
        Route::post('/uploads', [UploadController::class, 'storePembimbing'])->name('uploads.storePembimbing');
        
        // ❌ Manajemen User
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

        // Untuk update status lowongan
        Route::post('/update-status-lowongan', [PembimbingController::class, 'updateStatusLowongan'])->name('update.status.lowongan');

        //Melihat detail peserta
        // Route::get('/pembimbing/peserta/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('pembimbing.show');

        // Route::resource('users', \App\Http\Controllers\UserController::class, ['as' => 'pembimbing']);

        Route::get('/users/{user}', [UserController::class, 'show'])->name('pembimbing.users.show');

        Route::get('/profile', [ProfileController::class, 'profile'])->name('pembimbing.profile.show');

        Route::post('/pembimbing/tasks/assign', [TaskController::class, 'assignTaskToInternship'])->name('tasks.assign');
        
    });

    // **🛠️ Routes untuk Admin**
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/internships', [InternshipController::class, 'store'])->name('admin.internships.store');
    
        Route::get('/admin/arsip', [ArsipController::class, 'index'])->name('admin.arsip');
        
        Route::resource('internships', InternshipController::class)
             ->except(['index', 'show']) // ⛔ Hindari route GET /admin/internships/{id}
             ->names([
                'create' => 'admin.internships.create',
                'store' => 'admin.internships.store',
                'edit' => 'admin.internships.edit',
                'update' => 'admin.internships.update',
                'destroy' => 'admin.internships.destroy',
                ]);
        
        Route::get('/arsip', [AdminController::class, 'arsip'])->name('admin.arsip');

        //Dashboard admin
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Manajemen User (Khusus Admin)
        Route::resource('users', UserController::class, ['as' => 'admin']);

        //Manajemen Pembimbing (Khusus Admin)
        Route::resource('mentors', PembimbingController::class,['as' => 'admin']);

        //Update dan edit data user oleh admin
        Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        
        // Route::resource('users', \App\Http\Controllers\UserController::class, ['as' => 'admin']);

        // Route::middleware(['auth', 'role:admin'])->get('/admin/profile', [AdminController::class, 'show'])->name('admin.profile.show');

        Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
        
    });

    // **📑 Manajemen Tugas untuk Semua Pengguna**
    Route::resource('tasks', TaskController::class);

    // **👀 Pratinjau Dokumen (CV, Resume, dan Formulir)**
    Route::get('/preview/{filename}', function ($filename) {
        $path = storage_path("app/public/uploads/{$filename}");

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    })->name('preview.pdf');


    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    
    Route::get('/tasks/preview/{filename}', function ($filename) {
        $filePath = storage_path("app/public/uploads/{$filename}");

        if (!file_exists($filePath)) {
            abort(404);
        }

        return Response::file($filePath, [
            'Content-Type' => mime_content_type($filePath),
            'Content-Disposition' => 'inline',
        ]);
    })->name('tasks.preview');
});
