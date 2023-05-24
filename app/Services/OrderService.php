<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Traits\ApiResponse;

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


  public function updateOrder(Order $order, array $validatedData): Order
  {
    if (isset($validatedData['status'])) {
      $this->updateStatus($order, $validatedData['status']);
    }

    if (isset($validatedData['items'])) {
      $this->updateItems($order, $validatedData['items']);
    }

    return $order->fresh();
  }

  public function updateStatus(Order $order, $status)
  {
    if ($status) {

      $role = auth()->user()->role->name;
      $updates = match ($role) {
        'reviewer' => ['received', 'ready to be prepared'],
        'chef' => ['preparing', 'ready to be delivered'],
        'delivery' => ['delivering', 'completed'],
        'user' => [],
        'admin' => [],
      };

      if (in_array($status, $updates)) {
        $order->status = $status;
        $order->save();
      }

      if ($status == 'canceled') {
        if ($order->user_id == auth()->id() && in_array($order->status, $this->notGoneAwaystatus)) {
          $order->status = $status;
          $order->save();
        }
      }
    }
  }

  private function updateItems(Order $order, array $items): void
  {
    $orderItems = [];

    foreach ($items as $item) {
      $orderItems[] = new OrderItem([
        'menu_item_id' => $item['id'],
        'quantity' => $item['quantity'],
      ]);
    }

    $order->orderItems()->saveMany($orderItems);
  }

  public function show(Order $order)
  {
    $role = auth()->user()->role->name;
    if ($role == 'user') {
      if (auth()->id() != $order->user_id) {
        return $this->errorResponse('You not allowed to see this order details', 401);
      }
      $order->load(['orderAddress', 'orderItems']);
      return $this->successResponse(OrderResource::make($order));
    }
    $order->load(['orderAddress', 'orderItems', 'user']);
    return $this->successResponse(OrderResource::make($order));
  }
}
