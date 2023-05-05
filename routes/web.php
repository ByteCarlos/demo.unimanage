<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'index']);
Route::get('/projetos', [SiteController::class, 'projects']);
Route::post('/projetos', [SiteController::class, 'storeProject']);
Route::get('/eventos', [SiteController::class, 'events']);
Route::post('/eventos', [SiteController::class, 'storeEvent']);
Route::get('/sobre', [SiteController::class, 'about']);
