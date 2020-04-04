<?php

use Faithgen\AppBuild\Http\Controllers\BuildController;
use Faithgen\AppBuild\Http\Controllers\ModuleController;
use Faithgen\AppBuild\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

Route::name('modules.')
    ->prefix('modules/')
    ->group(function () {
        Route::get('', [ModuleController::class, 'index']);
        Route::post('', [ModuleController::class, 'addModules']);
        Route::get('{module}', [ModuleController::class, 'show']);
    });

Route::prefix('builds/')
    ->group(function () {
        Route::post('', [BuildController::class, 'buildApp']);
        Route::get('', [BuildController::class, 'index']);
        Route::get('{build}', [BuildController::class, 'buildLogs']);
    });


