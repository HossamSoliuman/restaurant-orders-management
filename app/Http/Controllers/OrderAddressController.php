<?php

namespace App\Http\Controllers;

use App\Models\OrderAddress;
use App\Http\Requests\StoreOrderAddressRequest;
use App\Http\Requests\UpdateOrderAddressRequest;

class OrderAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderAddressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderAddress  $orderAddress
     * @return \Illuminate\Http\Response
     */
    public function show(OrderAddress $orderAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderAddressRequest  $request
     * @param  \App\Models\OrderAddress  $orderAddress
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderAddressRequest $request, OrderAddress $orderAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderAddress  $orderAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderAddress $orderAddress)
    {
        //
    }
}
