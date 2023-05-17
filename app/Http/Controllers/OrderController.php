<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use App\Traits\ApiResponse;

class OrderController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderService $orderService)
    {
        return $orderService->GetCurrentOrdersBaseOnUserRole();
    }

    /**a
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'user_id' => $request->validated('user_id'),
        ]);
        // $order->orderItems->
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load(['orderAddress', 'user', 'orderItems']);
        return $this->successResponse(OrderResource::make($order));
    }

    public function update(UpdateOrderRequest $request, Order $order,OrderService $orderService)
    {
        $items=$request->validated('items');
        $status=$request->validated('status');

        $orderService->updateStatus($order,$status);
        $orderService->addItems($order,$items);
    }

}
