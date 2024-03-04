<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;

use App\Http\Controllers\AuthAdmin\LoginController as AdminLoginController;
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

// Auth::routes();
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware('auth:web')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login.index');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', function () { return redirect()->route('admin.home'); });
        Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
    });
});

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('categoria', App\Http\Controllers\CategoriaController::class)->parameters(['categoria' => 'categoria'])->names('categoria'); // tive que colocar isto porque de alguma forma o parâmetro estava com nome diferente, 'categorium' ??
    Route::resource('produto', App\Http\Controllers\ProdutoController::class);
});
