<?php

namespace KSPEdu\LaravelFlutterGetx\Http\Controllers;

use App\Http\Controllers\Controller;
use KSPEdu\LaravelFlutterGetx\Http\Resources\ConfigResource;

class ApiController extends Controller {
    public function __invoke() {
        $config = config('ksp-lfg.config.params', []);
        return response()->json(new ConfigResource($config));
    }
}