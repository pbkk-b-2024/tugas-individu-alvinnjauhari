<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeretaController;
use App\Http\Controllers\Tugas1Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LogoutController;

//TUGAS 1 PENDAHULUAN

Route::get('/', function () {
    return view('layout.home');
});

Route::prefix('/tugas1')->group(function(){
    Route::prefix('/caribilangan')->group(function(){
        Route::get('/genap-ganjil', [Tugas1Controller::class,'genapGanjil'])->name('genap-ganjil');
        Route::get('/fibbonaci', [Tugas1Controller::class,'fibonacci'])->name('fibonacci');
        Route::get('/prima', [Tugas1Controller::class, 'bilanganPrima'])->name('bilangan-prima');
    });

    Route::prefix('/routing')->group(function(){
        Route::get('/param', fn() => view('tugas1.routing.param-routing.param'))->name('param');
        Route::get('/param-routing/param/{param1}', [Tugas1Controller::class, 'param1'])->name('param1');
        Route::get('/param-routing/param/{param1}/{param2}', [Tugas1Controller::class, 'param2'])->name('param2');
    });
});

// Tugas 2 CRUD
Route::prefix('/tugas2')->group(function() {
    Route::prefix('/crud-kereta')->group(function() {
        Route::get('/kereta', [KeretaController::class, 'index'])->name('kereta.index');
        Route::get('/kereta/create', [KeretaController::class, 'create'])->name('kereta.create');
        Route::post('/kereta/store', [KeretaController::class, 'store'])->name('kereta.store');
        Route::get('/kereta/{kereta}/edit', [KeretaController::class, 'edit'])->name('kereta.edit');
        Route::put('/kereta/{kereta}', [KeretaController::class, 'update'])->name('kereta.update');
    });
});

//TUGAS 3: AUTHENTIKASI

// Route untuk halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');

// Route untuk proses login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

// Route untuk logout
Route::post('/', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');