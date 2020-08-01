<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('notificacion.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('room.{id}', function ($user, $id) {
    // Este tipo de canales (presence) debe retornar un array con info del usuario
    if($user->canJoinRoom($id)){
        return ["id" => $user->id, "name" => $user->name];
    }
});