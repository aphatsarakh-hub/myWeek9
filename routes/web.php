<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClaimController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', [AdminController::class, 'about'])->name('about');

Route::get('/blog', [BlogController::class, 'blog2'])->name('blog');
Route::get('/blog2', [BlogController::class, 'blog2'])->name('blog2');

Route::get('/from', [AdminController::class, 'from'])->name('from');
Route::get('/create', [AdminController::class, 'from'])->name('create');

Route::post('/insert', [AdminController::class, 'insert'])->name('insert');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();

        return "เชื่อมต่อฐานข้อมูลสำเร็จ : "
            . DB::connection()->getDatabaseName();

    } catch (\Exception $e) {

        return "เชื่อมต่อฐานข้อมูลไม่สำเร็จ : "
            . $e->getMessage();
    }
});

// Workshop 3: หน้าประวัตินักศึกษา รับ id ผ่าน URL
Route::get('/student/{id}', function ($id) {
    return view('student', ['id' => $id]);
})->name('student.profile');

Route::get('/claim', [ClaimController::class, 'create'])->name('claim.create');
Route::post('/claim', [ClaimController::class, 'store'])->name('claim.store');

Route::get('/delete/{id}', [BlogController::class, 'delete']);
Route::get('/change-status/{id}', [BlogController::class, 'changeStatus']);

// ต้องอยู่ล่างสุดของไฟล์เสมอ! ดักทุก route ที่ไม่ตรงกับที่ประกาศไว้ข้างบน
Route::fallback(function () {
    return 'ไม่พบหน้าเว็บ';
});