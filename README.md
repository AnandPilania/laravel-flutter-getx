# [DEV] laravel-flutter-getx
Scaffold Flutter project from [Laravel](https://laravel.com) :) with [GetX](https://pub.dev/packages/get) to accomplish Laravel structure.

[![Hits](https://hits.seeyoufarm.com/api/count/incr/badge.svg?url=https%3A%2F%2Fgithub.com%2FAnandPilania%2Flaravel-flutter-getx&count_bg=%23FF3863&title_bg=%232C3E50&icon=&icon_color=%23E7E7E7&title=HITS&edge_flat=false)](https://hits.seeyoufarm.com)

## What it'll do:
1. `Create` Flutter project via `shell_exec`
2. Structure it like Laravel
3. Scaffold


## Structure
```
- lib
  - app
    - bindings // DI
    - controllers // Business Logic
    - exceptions
    - models
    - providers // API communications
    - services // Global/App services
  - config // App config
  - mocks // Mocking data in 'dev' env
  -resources
    - lang
    - views
      - widgets
  - main.dart
  - routes.dart // Route management
```

#### [WINDOWS ONLY: till now] IF YOU WANT TO CREATE NEW FLUTTER APP WITH THIS STRUCTURE:
1: Clone the repo,
2: Open `cmd` & change the working dir to `bin` & run,
```
.\win-structure.bat APP_NAME
```
This will first run `flutter create` command & structure your new app afterthat.

## How to use
1. Install
```
composer require kspedu/laravel-flutter-getx
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
- `flutter:make:binding` => w/o `controller` &| `provider`
- `flutter:make:controller` => w/o `provider`
- `flutter:make:exception` => w/o message
- `flutter:make:lang`
- `flutter:make:mock` => w/o `model`
- `flutter:make:model` => w/o `mock`
- `flutter:make:provider` => w/o sample
- `flutter:make:service`
- `flutter:make:view`
