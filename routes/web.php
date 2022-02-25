<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvisionServer;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\EpisodeController;

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::resources([
        'series'    => SerieController::class,
        'seasons'   => SeasonController::class,
        'episodes'  => EpisodeController::class,
    ]);
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');