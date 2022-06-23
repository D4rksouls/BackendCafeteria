<?php

/*
|--------------------------------------------------------------------------
| Crear la aplicación
|--------------------------------------------------------------------------
|
| Lo primero que haremos será crear una nueva instancia de la aplicación Laravel
| que sirve como "pegamento" para todos los componentes de Laravel, y es
| el contenedor IoC para el sistema que une todas las diversas partes.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Vincular interfaces importantes
|--------------------------------------------------------------------------
|
| A continuación, debemos enlazar algunas interfaces importantes en el contenedor para que
| podremos resolverlos cuando sea necesario. Los kernels serve sirven
| solicitudes entrantes a esta aplicación desde la web y CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| Este script devuelve la instancia de la aplicación. La instancia se da a
| el script de llamada para que podamos separar la construcción de las instancias
| desde el funcionamiento real de la aplicación y el envío de respuestas.
|
*/

return $app;
