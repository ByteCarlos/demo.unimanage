<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'index']);
Route::get('/projetos', [SiteController::class, 'projects']);
Route::post('/projetos', [SiteController::class, 'store']);
Route::get('/eventos', [SiteController::class, 'events']);
Route::get('/sobre', [SiteController::class, 'about']);
