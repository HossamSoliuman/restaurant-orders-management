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
      Order::STATUS_PENDING,
      Order::STATUS_RECEIVED,
      Order::STATUS_READY_TO_BE_PREPARED,
      Order::STATUS_PREPARING,
  ];
  }
  public function getCurrentOrdersBaseOnUserRole()
  {
    $role = auth()->user()->role->name;

    $user_id = auth()->user()->id;
    $orders = null;
    if ($role == 'user') {
      $orders = Order::whereUserId($user_id)
        ->where('status', '!=', Order::STATUS_COMPLETED)
        ->get();
    }
    if ($role == 'admin') {
      $orders = Order::where('status', '!=', Order::STATUS_COMPLETED)
        ->get();
    }

    if ($role == 'chef') {
      $orders = Order::where('status', '=', Order::STATUS_PREPARING)
        ->orWhere('status', '=', Order::STATUS_READY_TO_BE_PREPARED)
        ->get();
    }
    if ($role == 'delivery') {
      $orders = Order::whereUserId($user_id)
        ->where(function ($query) {
          $query->where('status', '=', Order::STATUS_DELIVERING)
            ->orWhere('status', '=', Order::STATUS_READY_TO_BE_DELIVERED);
        })
        ->get();
    }
    if ($role == 'reviewer') {
      $orders = Order::where('status', '=', Order::STATUS_PENDING)
        ->orWhere('status', '=', Order::STATUS_REVIEWING)
        ->get();
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
        'reviewer' => [
          Order::STATUS_RECEIVED,
          Order::STATUS_REVIEWING,
          Order::STATUS_READY_TO_BE_PREPARED,
        ],
        'chef' => [
          Order::STATUS_PREPARING,
          Order::STATUS_READY_TO_BE_DELIVERED,
        ],
        'delivery' => [
          Order::STATUS_DELIVERING,
          Order::STATUS_COMPLETED,
        ],
        'user' => [],
        'admin' => [],
      };

      if (in_array($status, $updates)) {
        $order->status = $status;
        $order->save();
      }

      if ($status == Order::STATUS_CANCELED) {
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
