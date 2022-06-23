<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Controladora de sesión predeterminada
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el "driver" predeterminado de la sesión que se usará en
    | peticiones. Por defecto, usaremos el controlador nativo ligero, pero
    | puede especificar cualquiera de los otros controladores maravillosos proporcionados aquí.
    |
    | Supported: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Duración de la sesión
    |--------------------------------------------------------------------------
    |
    | Aquí puede especificar el número de minutos que desea que dure la sesión.
    | que se le permita permanecer inactivo antes de que caduque. si los quieres
    | para que caduque inmediatamente al cerrar el navegador, establezca esa opción.
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 300),

    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Cifrado de sesión
    |--------------------------------------------------------------------------
    |
    | Esta opción le permite especificar fácilmente que todos los datos de su sesión
    | debe cifrarse antes de almacenarse. Todo el cifrado se ejecutará
    | automáticamente por Laravel y puede usar la sesión como de costumbre.
    |
    */

    'encrypt' => false,

    /*
    |--------------------------------------------------------------------------
    | Ubicación del archivo de sesión
    |--------------------------------------------------------------------------
    |
    | Cuando usamos el controlador de sesión nativo, necesitamos una ubicación donde la sesión
    | los archivos pueden ser almacenados. Se ha establecido un valor predeterminado para usted, pero un
    | se puede especificar la ubicación. Esto solo es necesario para las sesiones de archivos.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Conexión de base de datos de sesión
    |--------------------------------------------------------------------------
    |
    | Cuando utilice los controladores de sesión "base de datos" o "redis", puede especificar un
    | conexión que se debe utilizar para administrar estas sesiones. Esto debería
    | corresponden a una conexión en las opciones de configuración de su base de datos.
    |
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Tabla de base de datos de sesión
    |--------------------------------------------------------------------------
    |
    | Al usar el controlador de sesión de "base de datos", puede especificar la tabla que
    | debe utilizar para gestionar las sesiones. Por supuesto, un valor predeterminado razonable es
    | provisto para usted; sin embargo, puede cambiar esto según sea necesario.
    |
    */

    'table' => 'sessions',

    /*
    |--------------------------------------------------------------------------
    | Almacén de caché de sesión
    |--------------------------------------------------------------------------
    |
    | Mientras usa uno de los backends de sesión controlados por caché del marco, puede
    | enumere un almacén de caché que se debe utilizar para estas sesiones. Este valor
    | debe coincidir con uno de los "almacenes" de caché configurados de la aplicación.
    |
    | Affects: "apc", "dynamodb", "memcached", "redis"
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Sesión de lotería de barrido
    |--------------------------------------------------------------------------
    |
    | Algunos controladores de sesión deben barrer manualmente su ubicación de almacenamiento para obtener
    | deshacerse de las sesiones antiguas del almacenamiento. Estas son las posibilidades de que lo haga
    | suceder en una solicitud dada. Por defecto, las probabilidades son 2 de 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nombre de la cookie de sesión
    |--------------------------------------------------------------------------
    |
    | Aquí puede cambiar el nombre de la cookie utilizada para identificar una sesión
    | instancia por ID. El nombre especificado aquí se utilizará cada vez que un
    | El marco crea una nueva cookie de sesión para cada controlador.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Ruta de cookies de sesión
    |--------------------------------------------------------------------------
    |
    | La ruta de la cookie de sesión determina la ruta por la cual la cookie
    | ser considerado como disponible. Por lo general, esta será la ruta raíz de
    | su aplicación, pero usted es libre de cambiar esto cuando sea necesario.
    |
    */

    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Dominio de cookies de sesión
    |--------------------------------------------------------------------------
    |
    | Aquí puede cambiar el dominio de la cookie utilizada para identificar una sesión
    | en su aplicación. Esto determinará en qué dominios está la cookie.
    | disponibles en su aplicación. Se ha establecido un valor predeterminado razonable.
    |
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    |--------------------------------------------------------------------------
    |
    | Al establecer esta opción en verdadero, las cookies de sesión solo se devolverán
    | al servidor si el navegador tiene una conexión HTTPS. esto se mantendrá
    | la cookie se le envíe cuando no se pueda hacer de forma segura.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    |Solo acceso HTTP
    |--------------------------------------------------------------------------
    |
    | Establecer este valor en verdadero evitará que JavaScript acceda a la
    | el valor de la cookie y la cookie solo será accesible a través de
    | el protocolo HTTP. Usted es libre de modificar esta opción si es necesario.
    |
    */

    'http_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Cookies del mismo sitio
    |--------------------------------------------------------------------------
    |
    | Esta opción determina cómo se comportan sus cookies cuando se realizan solicitudes entre sitios.
    | tener lugar, y se puede utilizar para mitigar los ataques CSRF. Por defecto, nosotros
    | establecerá este valor en "lax" ya que es un valor predeterminado seguro.
    |
    | Supported: "lax", "strict", "none", null
    |
    */

    'same_site' => 'lax',

];
