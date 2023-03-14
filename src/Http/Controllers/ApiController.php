<?php

namespace LaravelFlutterGetx\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelFlutterGetx\Http\Resources\ConfigResource;

class ApiController extends Controller {
    public function __invoke() {
        $config = config('laravel-flutter-getx.config.params', []);
        return response()->json(new ConfigResource($config));
    }
}
