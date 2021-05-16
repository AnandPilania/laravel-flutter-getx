cd %1\lib

mkdir app
mkdir app\bindings
type NUL > app\bindings\home_binding.dart

mkdir app\controllers
type NUL > app\controllers\home_controller.dart

mkdir app\exceptions
mkdir app\models
type NUL > app\models\user.dart

mkdir app\providers
type NUL > app\providers\user_provider.dart

mkdir app\services
mkdir config
type NUL > config\constants.dart
type NUL > config\style.dart

mkdir config\theme
type NUL > config\theme\light_theme.dart
type NUL > config\theme\dark_theme.dart

mkdir core
type NUL > core\app_exception.dart
type NUL > core\app_translation.dart
type NUL > core\helpers.dart

mkdir core\concerns
type NUL > core\concerns\base_controller.dart
type NUL > core\concerns\base_mock.dart
type NUL > core\concerns\base_provider.dart

mkdir core\exceptions
type NUL > core\exceptions\invalid_request_exception.dart

mkdir core\services
type NUL > core\services\app_service.dart

mkdir resources
mkdir resources\lang
type NUL > resources\lang\en.dart

mkdir resources\views
type NUL > resources\views\home_view.dart

mkdir resources\views\widgets

mkdir mocks
type NUL > mocks\user_mock.dart

type NUL > routes.dart

cd ..