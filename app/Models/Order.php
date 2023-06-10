<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const STATUS_PENDING = 'pending';
    const STATUS_RECEIVED = 'received';
    const STATUS_REVIEWING = 'reviewing';
    const STATUS_READY_TO_BE_PREPARED = 'ready to be prepared';
    const STATUS_PREPARING = 'preparing';
    const STATUS_READY_TO_BE_DELIVERED = 'ready to be delivered';
    const STATUS_DELIVERING = 'delivering';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';
    protected $fillable = [
        'user_id',
        'order_address_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function orderAddress()
    {
        return $this->belongsTo(OrderAddress::class);
    }
}
