<?php

use App\Http\Controllers\SlugResolverController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';


Route::get('/{slug}', SlugResolverController::class)->name('slug.resolve');
