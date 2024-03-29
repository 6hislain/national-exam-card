<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\CombinationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CalendarEventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DefaultController::class, 'home'])->name('home');
Route::get('/about', [DefaultController::class, 'about'])->name('about');
Route::get('/contact', [DefaultController::class, 'contact'])->name('contact');
Route::get('/license', [DefaultController::class, 'license'])->name('license');
Route::get('/privacy', [DefaultController::class, 'privacy'])->name('privacy');
Route::get('/dashboard', [DefaultController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard/report', [DefaultController::class, 'report'])->name('report');
Route::post('/dashboard/report', [DefaultController::class, 'report'])->name('report');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard/user', [AuthController::class, 'users'])->name('user.index');
Route::get('/dashboard/user/{user}', [AuthController::class, 'profile'])->name('user.show');
Route::put('/dashboard/user/{user}', [AuthController::class, 'update'])->name('user.update');
Route::post('/dashboard/user/{user}', [AuthController::class, 'profile'])->name('user.show');
Route::get('/dashboard/user/{user}/edit', [AuthController::class, 'edit'])->name('user.edit');
Route::get('/dashboard/student', [AuthController::class, 'students'])->name('student.index');
Route::get('/dashboard/student/{user}', [AuthController::class, 'profile'])->name('student.show');
Route::get('/dashboard/profile/{user}', [AuthController::class, 'profile'])->name('profile.show');
Route::post('/dashboard/profile/{user}', [AuthController::class, 'profile'])->name('profile.show');
Route::post('/dashboard/student/{user}', [AuthController::class, 'profile'])->name('student.show');

Route::resources([
    'paper' => PaperController::class,
    'marks' => MarksController::class,
    'school' => SchoolController::class,
    'message' => MessageController::class,
    'subject' => SubjectController::class,
    'calendar' => CalendarEventController::class,
    'combination' => CombinationController::class,
    'application' => ApplicationController::class,
    'notification' => NotificationController::class,
]);

Route::get('/language/{locale?}', function ($locale = null) {
    if (isset($locale) && in_array($locale, config('app.available_locales'))) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
    }
    return redirect()->back();
});
