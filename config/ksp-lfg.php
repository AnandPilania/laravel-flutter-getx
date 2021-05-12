<?php

use KSPEdu\LaravelFlutterGetx\Http\Middleware\FlutterMiddleware;

return [
    'path' => base_path('flutter_app'),

    'config' => [
        'enabled' => true,
        'middleware' => [
            'enabled' => true,
            'middlewares' => [
                FlutterMiddleware::class,
            ],
        ],
        'route' => 'config', // http|s://website.com/api/...
        'is_auth_rotected' => false,
        'is_api_protected' => true,
        'api_protection_headers' => [
            'flutter_app' => 'appVersion.appSubVersion',
            'test' => 'thiss',
        ],
        'params' => [
            'appName' => 'Flutter App',
            'appVersion' => '1.0.0',
            'appSubVersion' => 1,
            'updatedAt' => '2021-12-12 12:12:12',
        ],
    ],

    'structure' => [
        'bindings' => 'app/bindings',
        'config' => 'config',
        'controllers' => 'app/controllers',
        'core' => 'core',
        'exceptions' => 'app/exceptions',
        'models' => 'app/models',
        'providers' => 'app/providers',
        'services' => 'app/services',

        'mocks' => 'mocks',

        'lang' => 'resources/lang',
        'views' => 'resources/views',
        'widgets' => 'resources/views/widgets',
    ],
];