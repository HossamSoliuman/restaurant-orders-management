<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
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

  private function updateStatus(Order $order, string $status): void
  {
    $order->status = $status;
    $order->save();
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
