<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Nombre de la aplicación
    |--------------------------------------------------------------------------
    |
    | Este valor es el nombre de su aplicación. Este valor se utiliza cuando el
    | framework necesita colocar el nombre de la aplicación en una notificación o
    | cualquier otra ubicación que requiera la aplicación o sus paquetes.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Entorno de aplicación
    |--------------------------------------------------------------------------
    |
    | Este valor determina el "entorno" en el que se encuentra actualmente su aplicación
    | funcionando. Esto puede determinar cómo prefiere configurar varios
    | servicios que utiliza la aplicación. Configure esto en su archivo ".env".
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo de depuración de aplicaciones
    |--------------------------------------------------------------------------
    |
    | Cuando su aplicación está en modo de depuración, los mensajes de error detallados con
    | los rastros de pila se mostrarán en cada error que ocurra dentro de su
    | solicitud. Si está deshabilitado, se muestra una página de error genérica simple.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL de la aplicación
    |--------------------------------------------------------------------------
    |
    | La consola utiliza esta URL para generar URL correctamente cuando se utiliza
    | la herramienta de línea de comandos de Artisan. Debe establecer esto en la raíz de
    | su aplicación para que se utilice al ejecutar tareas de Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Zona horaria de la aplicación
    |--------------------------------------------------------------------------
    |
    | Aquí puede especificar la zona horaria predeterminada para su aplicación, que
    | será utilizado por las funciones de fecha y hora de PHP. Nos hemos ido
    | adelante y configure esto a un valor predeterminado razonable para usted listo para usar.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Configuración local de la aplicación
    |--------------------------------------------------------------------------
    |
    | La configuración local de la aplicación determina la configuración local predeterminada que se utilizará
    | por el proveedor de servicios de traducción. Usted es libre de establecer este valor
    | a cualquiera de las configuraciones regionales que serán compatibles con la aplicación.
    |
    */

    'locale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Configuración local alternativa de la aplicación
    |--------------------------------------------------------------------------
    |
    | La configuración local alternativa determina la configuración local que se utilizará cuando la actual
    | no está disponible. Puede cambiar el valor para que corresponda a cualquiera de
    | las carpetas de idioma que se proporcionan a través de su aplicación.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Localización del farsante
    |--------------------------------------------------------------------------
    |
    | Esta configuración local será utilizada por la biblioteca Faker PHP al generar falsos
    | datos para las semillas de su base de datos. Por ejemplo, esto se utilizará para obtener
    | números de teléfono localizados, información de direcciones y más.
    |
    */

    'faker_locale' => 'es_EC',

    /*
    |--------------------------------------------------------------------------
    | Clave de encriptación
    |--------------------------------------------------------------------------
    |
    | Esta clave es utilizada por el servicio de cifrado de Illuminate y debe establecerse
    | a una cadena aleatoria de 32 caracteres; de lo contrario, estas cadenas cifradas
    | no estará a salvo. ¡Haga esto antes de implementar una aplicación!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Controlador de modo de mantenimiento
    |--------------------------------------------------------------------------
    |
    | Estas opciones de configuración determinan el controlador utilizado para determinar y
    | administrar el estado de "modo de mantenimiento" de Laravel. El controlador de "caché"
    | permitir que el modo de mantenimiento se controle en varias máquinas.
    |
    | Controladores compatibles: "file", "caché"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Proveedores de servicios cargados automáticamente
    |--------------------------------------------------------------------------
    |
    | Los proveedores de servicios enumerados aquí se cargarán automáticamente en el
    | solicitud a su aplicación. Siéntase libre de agregar sus propios servicios a
    | esta matriz para otorgar funcionalidad ampliada a sus aplicaciones.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | Esta matriz de Class Aliases se registrará cuando esta aplicación
    | Está empezado. Sin embargo, no dude en registrar tantos como desee como
    | los alias se cargan de forma "perezosa" para que no obstaculicen el rendimiento.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
    ])->toArray(),

];
