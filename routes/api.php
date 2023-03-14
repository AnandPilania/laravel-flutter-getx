<?php

use Illuminate\Support\Facades\Route;
use LaravelFlutterGetx\Http\Controllers\ApiController;

Route::get(config('laravel-flutter-getx.config.route', 'config'), [ApiController::class, '__invoke'])
    ->name('api.flutter.config');
