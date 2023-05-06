<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'index']);
Route::get('/projetos', [SiteController::class, 'projects'])->name('projetos.index');
Route::post('/projetos', [SiteController::class, 'storeProject']);
Route::get('/projetos/{id}/edit', [SiteController::class, 'edit'])->name('projetos.edit');
Route::put('/projetos/update/{id}', [SiteController::class, 'updateProject'])->name('projetos.update');
Route::delete('/projetos/delete/{id}', [SiteController::class, 'deleteProject'])->name('projetos.delete');
Route::get('/eventos', [SiteController::class, 'events']);
Route::post('/eventos', [SiteController::class, 'storeEvent']);
Route::get('/sobre', [SiteController::class, 'about']);
