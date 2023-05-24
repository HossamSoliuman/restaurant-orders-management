<?php

use App\Models\Order;
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

Broadcast::channel('orders.{order}', function ($user, Order $order) {
    return $user->id ===  $order->user_id;
});

Broadcast::channel('admin', function ($user) {
    return $user->role->name == 'admin';
});

Broadcast::channel('reviewer', function ($user) {
    return $user->role->name == 'reviewer';
});

Broadcast::channel('chef', function ($user) {
    return $user->role->name == 'chef';
});

Broadcast::channel('delivery', function ($user) {
    return $user->role->name == 'delivery';
});