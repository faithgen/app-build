<?php

use Faithgen\AppBuild\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

Route::name('modules.')
    ->prefix('modules/')
    ->group(function () {
        Route::get('', [ModuleController::class, 'index']);
        Route::post('', [ModuleController::class, 'addModules']);
    });
