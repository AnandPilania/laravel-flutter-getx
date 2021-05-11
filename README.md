# [DEV] laravel-flutter-getx
Scaffold Flutter project from [Laravel](https://laravel.com) :) with [GetX](https://pub.dev/packages/get) to accomplish Laravel structure.



## What it'll do:
1. `Create` Flutter project via `shell_exec`
2. Structure it like Laravel
3. Scaffold

## How to use
1. Install
```
composer install kspedu/laravel-flutter-getx
```

2. Publish the `config`
```
php artisan vendor:publish --tag=ksp-lfg
```

3. Configure the `flutter apps` path `config\ksp-lfg.php`


4. Create Flutter Project
```
php artisan flutter:create project_name
```

## Other commands
```
`flutter:make:binding`
`flutter:make:controller`
`flutter:make:exception`
`flutter:make:lang`
`flutter:make:mock`
`flutter:make:model`
`flutter:make:provider`
`flutter:make:service`
`flutter:make:view`
```

