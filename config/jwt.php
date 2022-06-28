<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Secret
    |--------------------------------------------------------------------------
    |
    | No te olvides de establecer esto en tu archivo .env, ya que se utilizará para firmar
    | sus tokens. Se proporciona un comando de ayuda para esto:
    | `php artisan jwt:secret`
    |
    | Nota: Sólo se utilizará para los algoritmos simétricos (HMAC),
    | ya que RSA y ECDSA utilizan una combinación de clave privada/pública (See below).
    |
    */

    'secret' => env('JWT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Keys
    |--------------------------------------------------------------------------
    |
    | El algoritmo que estés utilizando, determinará si tus tokens son
    | firmados con una cadena aleatoria (definida en `JWT_SECRET`) o usando las
    | siguientes claves públicas y privadas.
    |
    | Symmetric Algorithms:
    | HS256, HS384 & HS512 will use `JWT_SECRET`.
    |
    | Asymmetric Algorithms:
    | RS256, RS384 & RS512 / ES256, ES384 & ES512 will use the keys below.
    |
    */

    'keys' => [

        /*
        |--------------------------------------------------------------------------
        | Public Key
        |--------------------------------------------------------------------------
        |
        | Una ruta o recurso a su clave pública.
        |
        | E.g. 'file://path/to/public/key'
        |
        */

        'public' => env('JWT_PUBLIC_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Private Key
        |--------------------------------------------------------------------------
        |
        | Una ruta o recurso a su clave privada.
        |
        | E.g. 'file://path/to/private/key'
        |
        */

        'private' => env('JWT_PRIVATE_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Passphrase
        |--------------------------------------------------------------------------
        |
        | La frase de contraseña para su clave privada. Puede ser nula si no se ha establecido ninguna.
        |
        */

        'passphrase' => env('JWT_PASSPHRASE'),

    ],

    /*
    |--------------------------------------------------------------------------
    | JWT time to live
    |--------------------------------------------------------------------------
    |
    | Especifique el tiempo (en minutos) que será válido el token.
    | Por defecto, 1 hora.
    |
    | También se puede establecer en null, para obtener un token que nunca expira.
    | Algunas personas pueden querer este comportamiento para, por ejemplo, una aplicación móvil.
    | Esto no es particularmente recomendable, así que asegúrese de tener sistemas apropiados para revocar el token si es necesario.
    | sistemas apropiados para revocar el token si es necesario.
    | Aviso: Si se establece este valor en null se debe eliminar el elemento 'exp' de la lista 'required_claims'.
    |
    */

    'ttl' => env('JWT_TTL', 60),

    /*
    |--------------------------------------------------------------------------
    | Refresh time to live
    |--------------------------------------------------------------------------
    |
    | Especifique el tiempo (en minutos) en el que se puede refrescar el token
    | dentro de. Por ejemplo, el usuario puede actualizar su ficha en un plazo de 2 semanas desde que se creó la ficha original hasta que deba volver a autenticarse.
    | de la creación del token original hasta que tenga que volver a autenticarse.
    | El valor predeterminado es de 2 semanas.
    |
    | También puede establecerlo como nulo, para obtener un tiempo de actualización infinito.
    | Algunos pueden querer esto en lugar de que los tokens nunca expiren, por ejemplo, para una aplicación móvil.
    | Esto no es particularmente recomendable, así que asegúrate de tener sistemas apropiados para revocar los tokens.
    | sistemas apropiados para revocar el token si es necesario.
    |
    */

    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),

    /*
    |--------------------------------------------------------------------------
    | JWT hashing algorithm
    |--------------------------------------------------------------------------
    |
    | Especifica el algoritmo hash que se utilizará para firmar el token.
    |
    */

    'algo' => env('JWT_ALGO', Tymon\JWTAuth\Providers\JWT\Provider::ALGO_HS256),

    /*
    |--------------------------------------------------------------------------
    | Required Claims
    |--------------------------------------------------------------------------
    |
    | Especifique las demandas requeridas que deben existir en cualquier token.
    | Se lanzará una TokenInvalidException si alguna de estas afirmaciones no está
    | presente en la carga útil.
    |
    */

    'required_claims' => [
        'iss',
        'iat',
        'exp',
        'nbf',
        'sub',
        'jti',
    ],

    /*
    |--------------------------------------------------------------------------
    | Persistent Claims
    |--------------------------------------------------------------------------
    |
    | Especifica las claves de reclamación que deben persistir cuando se actualiza un token.
    | Los datos `sub` y `iat` se mantendrán automáticamente, además de estos datos.
    | además de las siguientes reclamaciones.
    |
    | Nota: Si una reclamación no existe, será ignorada.
    |
    */

    'persistent_claims' => [
        // 'foo',
        // 'bar',
    ],

    /*
    |--------------------------------------------------------------------------
    | Lock Subject
    |--------------------------------------------------------------------------
    |
    | Esto determinará si se añade automáticamente una declaración `prv` a
    | el token. El propósito de esto es asegurar que si tienes múltiples modelos de
    | modelos de autenticación, por ejemplo, "Usuario" y "Otra persona".
    | evitar que una solicitud de autenticación se haga pasar por otra,
    | ...si dos tokens tienen el mismo ID en dos modelos diferentes.
    |
    | En circunstancias específicas, puedes querer desactivar este comportamiento.
    | Por ejemplo, si sólo tienes un modelo de autenticación, entonces ahorrarías
    | un poco en el tamaño de los tokens.
    |
    */

    'lock_subject' => true,

    /*
    |--------------------------------------------------------------------------
    | Leeway
    |--------------------------------------------------------------------------
    |
    | Esta propiedad le da a las reclamaciones de tiempo jwt un poco de "margen de maniobra".
    | Esto significa que si usted tiene cualquier desviación inevitable del reloj en cualquiera de sus servidores, esto le permitirá un cierto nivel de amortiguación.
    | cualquiera de sus servidores, entonces esto le permitirá un cierto nivel de amortiguación.
    |
    | Esto se aplica a las reclamaciones `iat`, `nbf` y `exp`.
    |
    | Especifique en segundos - sólo si sabe que lo necesita.
    |
    */

    'leeway' => env('JWT_LEEWAY', 0),

    /*
    |--------------------------------------------------------------------------
    | Blacklist Enabled
    |--------------------------------------------------------------------------
    |
    | Para invalidar los tokens, debe tener activada la lista negra.
    | Si no quieres o necesitas esta funcionalidad, entonces establece esto como falso.
    |
    */

    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),

    /*
    | -------------------------------------------------------------------------
    | Blacklist Grace Period
    | -------------------------------------------------------------------------
    |
    | Cuando se realizan varias peticiones concurrentes con el mismo JWT,
    | es posible que algunas de ellas fallen, debido a la regeneración del token
    | en cada petición.
    |
    | Establezca el periodo de gracia en segundos para evitar el fallo de las peticiones paralelas.
    |
    */

    'blacklist_grace_period' => env('JWT_BLACKLIST_GRACE_PERIOD', 0),

    /*
    |--------------------------------------------------------------------------
    | Cookies encryption
    |--------------------------------------------------------------------------
    |
    | Por defecto Laravel encripta las cookies por motivos de seguridad.
    | Si decides no descifrar las cookies, tendrás que configurar Laravel
    | para que no cifre su token de cookie añadiendo su nombre en el array $except
    | disponible en el middleware "EncryptCookies" proporcionado por Laravel.
    | Ver https://laravel.com/docs/master/responses#cookies-and-encryption
    | para más detalles.
    |
    | Set it to true if you want to decrypt cookies.
    |
    */

    'decrypt_cookies' => false,

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    |
    | Especifique los distintos proveedores utilizados en el paquete.
    |
    */

    'providers' => [

        /*
        |--------------------------------------------------------------------------
        | JWT Provider
        |--------------------------------------------------------------------------
        |
        | Especifica el proveedor que se utiliza para crear y decodificar los tokens.
        |
        */

        'jwt' => Tymon\JWTAuth\Providers\JWT\Lcobucci::class,

        /*
        |--------------------------------------------------------------------------
        | Authentication Provider
        |--------------------------------------------------------------------------
        |
        | Especifique el proveedor que se utiliza para autenticar a los usuarios.
        |
        */

        'auth' => Tymon\JWTAuth\Providers\Auth\Illuminate::class,

        /*
        |--------------------------------------------------------------------------
        | Storage Provider
        |--------------------------------------------------------------------------
        |
        | Especifique el proveedor que se utiliza para almacenar tokens en la lista negra.
        |
        */

        'storage' => Tymon\JWTAuth\Providers\Storage\Illuminate::class,

    ],

];
