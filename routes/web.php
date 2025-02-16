<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/register', function () {
    return view('register');})->name('register');


Route::get('/login', function () {
    return view('login');})->name('login');


//HOME PAGE
Route::get('/', function () {
    return view('pages.home');})->name('home');


Route::get('/about', function () {
    return view('pages.about');})->name('about');


Route::get('/package', function () {
    return view('pages.package');})->name('package');


Route::get('/packageDescription', function () {
    return view('pages.packageDescription');})->name('packageDescription');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// for admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});




require __DIR__.'/auth.php';
