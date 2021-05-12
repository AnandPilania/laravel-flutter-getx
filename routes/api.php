<?php

use Illuminate\Support\Facades\Route;
use KSPEdu\LaravelFlutterGetx\Http\Controllers\ApiController;

Route::get(config('ksp-lfg.config.route', 'config'), [ApiController::class, '__invoke'])
    ->name('api.flutter.config');