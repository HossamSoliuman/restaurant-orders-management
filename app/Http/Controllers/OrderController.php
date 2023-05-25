<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Events\OrderStatusUpdated;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\OrderItem;
use App\Services\OrderService;
use App\Traits\ApiResponse;

class OrderController extends Controller
{
    use ApiResponse;
    
    public function index(OrderService $orderService)
    {
        $orders = $orderService->GetCurrentOrdersBaseOnUserRole();
        return $this->customResponse($orders);
    }
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_address_id' => $request->validated('order_address_id'),
            'status' => 'pending',
        ]);

        $items = $request->validated('items');
        $orderItems = [];

        foreach ($items as $item) {
            $orderItems[] = new OrderItem([
                'menu_item_id' => $item['id'],
                'quantity' => $item['quantity'],
            ]);
        }

        $order->orderItems()->saveMany($orderItems);

        $order->load('orderItems', 'orderAddress');

        $formatedOrder=OrderResource::make($order);

        event(new OrderCreated($formatedOrder));

        return $this->successResponse($formatedOrder);
    }

    public function show(Order $order, OrderService $orderService)
    {
        return $orderService->show($order);
    }

    public function update(UpdateOrderRequest $request, Order $order, OrderService $orderService)
    {
        $validatedData = $request->validated();
        $updatedOrder = $orderService->updateOrder($order, $validatedData);
        $updatedOrder->load(['orderAddress', 'orderItems', 'user']);
        $formatedOrder=OrderResource::make($updatedOrder);
        
        event(new OrderStatusUpdated($formatedOrder));
        return $this->successResponse($formatedOrder);
    }
}
