<?php

use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\PlaneController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'panel'], function(){

    Route::any('brands/search',[BrandController::class, 'search'])->name('brands.search');
    Route::get('/', [PanelController::class, 'index'])->name('panel');
    Route::resource('/brands', BrandController::class);

    Route::resource('/planes', PlaneController::class);

});

Route::get('/', [SiteController::class, 'index']);

Route::get('/promocoes', [SiteController::class, 'promotions'])->name('promotions');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
