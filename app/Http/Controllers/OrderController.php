<?php

namespace App\Http\Controllers;

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
    /**a
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        // return $request->validated();
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

        return $this->successResponse(OrderResource::make($order));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, OrderService $orderService)
    {
        return $orderService->show($order);
    }

    public function update(UpdateOrderRequest $request, Order $order, OrderService $orderService)
    {
        return $request->validated();
        $validatedData = $request->validated();
        $updatedOrder = $orderService->updateOrder($order, $validatedData);
        $updatedOrder->load(['orderAddress', 'orderItems', 'user']);
        return $this->successResponse(OrderResource::make($updatedOrder));
    }
}
