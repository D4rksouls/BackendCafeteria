<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Aquí podrá registrar todos los canales de transmisión de eventos que su
| soportes de aplicaciones. Las devoluciones de llamada de autorización de canal dadas son
| se utiliza para comprobar si un usuario autenticado puede escuchar el canal.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
