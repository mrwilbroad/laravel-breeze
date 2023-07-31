<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteLearn\GoogleController;
use App\Http\Controllers\SocialiteLearn\GuthubController;
use App\Http\Controllers\SocialiteLearn\LinkedinController;
use App\Http\Controllers\PasspoerEd\PassportClientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// SOCIALITE
Route::controller(GuthubController::class)->group(function(){
    Route::get("auth/github", "redirect")->name("github.login");
    Route::get("auth/github/callback", "callback");
});

Route::controller(GoogleController::class)->group(function(){
    Route::get("auth/google", "redirect")->name("google.login");
    Route::get("auth/google/callback", "callback");
});

Route::controller(LinkedinController::class)->group(function(){
    Route::get("auth/linkedin", "redirect")->name("linkedin.login");
    Route::get("auth/linkedin/callback", "callback");
});


// PASSPORT CLIENTS
Route::controller(PassportClientController::class)->group(function(){

    Route::get("/dashbord/clients", "index");
});

require __DIR__.'/auth.php';
