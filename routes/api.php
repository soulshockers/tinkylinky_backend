<?php

use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());

    Route::prefix('urls')->group(function () {
        Route::get('/', [UrlController::class, 'index']);
        Route::post('/', [UrlController::class, 'store']);
        Route::get('/{id}', [UrlController::class, 'show']);
        Route::delete('/{id}', [UrlController::class, 'destroy']);
    });
});
