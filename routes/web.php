<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tugas1Controller;


Route::get('/', function () {
    return view('layout.home');
});

Route::prefix('/tugas1')->group(function(){
    Route::prefix('/caribilangan')->group(function(){
        Route::get('/genap-ganjil',[Tugas1Controller::class,'genapGanjil'])->name('genap-ganjil');
        Route::get('/fibbonaci',[Tugas1Controller::class,'fibonacci'])->name('fibonacci');
        Route::get('/prima', [Tugas1Controller::class, 'bilanganPrima'])->name('bilangan-prima');
    });
    Route::prefix('/routing')->group(function(){
        Route::get('/param', fn() => view('tugas1.routing.param-routing.param'))->name('param');
        Route::get('param-routing/param/{param1}', [Tugas1Controller::class, 'param1'])->name('param1');
        Route::get('param-routing/param/{param1}/{param2}', [Tugas1Controller::class, 'param2'])->name('param2');
    });
});
