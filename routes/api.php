<?php

use App\Http\Controllers\Api\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());

    Route::prefix('urls')->group(function () {
        Route::get('/', [UrlController::class, 'index'])->name('urls.index');
        Route::post('/', [UrlController::class, 'store'])->name('urls.store');
        Route::get('/{id}', [UrlController::class, 'show'])->name('urls.show');
        Route::delete('/{id}', [UrlController::class, 'destroy'])->name('urls.destroy');
    });
});
