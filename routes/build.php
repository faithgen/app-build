<?php

use Faithgen\AppBuild\Http\Controllers\ModuleController;
use Faithgen\AppBuild\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

Route::prefix('modules')
    ->group(function () {
        Route::get('comments/{module}', [ModuleController::class, 'comments']);
        Route::post('comment/module', [ModuleController::class, 'comment']);
    });

Route::prefix('templates')
    ->group(function () {
        Route::get('', [TemplateController::class, 'index']);
        Route::get('{template}', [TemplateController::class, 'show']);
        Route::get('comments/{template}', [TemplateController::class, 'comments']);
        Route::post('comment/{template}', [TemplateController::class, 'comment']);
    });
