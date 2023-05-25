<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public  $order)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $role = auth()->user()->role->name;
        $order = $this->order;

        if ($role == 'chef' && $order->status == 'ready to be prepared') {
            return [
                new PrivateChannel('chef'),
                new PrivateChannel('admin'),
                new PrivateChannel('orders.' . $order->id),
            ];
        }
        if ($role == 'delivery' && $order->status == 'ready to be delivered') {
            return [
                new PrivateChannel('delivery'),
                new PrivateChannel('admin'),
                new PrivateChannel('orders.' . $order->id),
            ];
        }
        return [
            new PrivateChannel('admin'),
            new PrivateChannel('orders.' . $order->id),
        ];
    }
}
