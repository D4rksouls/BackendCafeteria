<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Correo predeterminado
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el correo predeterminado que se utiliza para enviar cualquier correo electrónico.
    | mensajes enviados por su aplicación. Se pueden configurar correos alternativos
    | y se usa según sea necesario; sin embargo, este correo se utilizará de forma predeterminada.
    |
    */

    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Configuraciones de correo
    |--------------------------------------------------------------------------
    |
    | Aquí puede configurar todos los correos utilizados por su aplicación más
    | sus respectivos ajustes. Se han configurado varios ejemplos para
    | usted y usted son libres de agregar los suyos propios según lo requiera su aplicación.
    |
    | Laravel admite una variedad de controladores de "transport" de correo para usar mientras
    | enviando un correo electrónico. Usted especificará cuál está utilizando para su
    | correos a continuación. Usted es libre de agregar correos adicionales según sea necesario.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses",
    |            "postmark", "log", "array", "failover"
    |
    */

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'mailgun' => [
            'transport' => 'mailgun',
        ],

        'postmark' => [
            'transport' => 'postmark',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | Es posible que desee que todos los correos electrónicos enviados por su aplicación sean enviados desde
    | la misma dirección Aquí, puede especificar un nombre y una dirección que sea
    | se utiliza globalmente para todos los correos electrónicos que envía su aplicación.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'dh99583@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'Gmail'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de correo Markdown
    |--------------------------------------------------------------------------
    |
    | Si está utilizando la representación de correo electrónico basada en Markdown, puede configurar su
    | rutas de temas y componentes aquí, lo que le permite personalizar el diseño
    | de los correos electrónicos. ¡O simplemente puede quedarse con los valores predeterminados de Laravel!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
