<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class OrderService
{
  use ApiResponse;
  public $notGoneAwaystatus;
  public function __construct()
  {
    $this->notGoneAwaystatus = [
      'pending',
      'received',
      'ready to be prepared', 'preparing'
    ];
  }
  public function GetCurrentOrdersBaseOnUserRole()
  {
    $role = auth()->user()->role->name;

    $user_id = auth()->user()->id;
    $orders = null;
    if ($role == 'user') {
      $orders = Order::whereUserId($user_id)->where('status', '!=', 'completed')->get();
    }
    if ($role == 'admin') {
      $orders = Order::where('status', '!=', 'completed')->get();
    }
    if ($role == 'chef') {
      $orders = Order::WhereStatus('preparing')->get();
    }
    if ($role == 'delivery') {
      $orders = Order::whereUserId($user_id)->whereStatus('deliverying')->get();
    }
    if ($role == 'reviewer') {
      $orders = Order::where('status', 'send')->get();
    }
    return OrderResource::collection($orders);
  }


  public function addItems(Order $order, $items)
  {
    if ($items) {

      if (!in_array($order->status, $this->notGoneAwaystatus)) {
        return $this->errorResponse('order can not be updated now', 400);
      }
      // $order->orderItem
    }
  }


  public function updateStatus(Order $order, $status)
  {
    if ($status) {

      $role = auth()->user()->role;
      $updates = match ($role) {
        'checker' => ['received', 'ready to be prepared'],
        'chef' => ['preparing', 'ready to be delivered'],
        'delivery' => ['delivering', 'completed'],
      };

      if (in_array($status, $updates)) {
        $order->status = $status;
        $order->save();
        return $this->successResponse(OrderResource::make($order));
      }

      if ($status == 'canceled') {
        if ($order->user_id == auth()->id() && in_array($order->status, $this->notGoneAwaystatus)) {
          $order->status = $status;
          $order->save();
          return $this->successResponse(OrderResource::make($order));
        }
      }
      
      return $this->errorResponse('You not allowed to update for this status', 401);
    }
  }
}
