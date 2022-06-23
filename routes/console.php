<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| Este archivo es donde puede definir toda su consola basada en Closure
| comandos Cada Closure está vinculado a una instancia de comando que permite un
| enfoque simple para interactuar con los métodos IO de cada comando.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
