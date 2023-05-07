<?php

namespace App\Http\Controllers;

use App\Models\OfferType;
use App\Http\Requests\StoreOfferTypeRequest;
use App\Http\Requests\UpdateOfferTypeRequest;

class OfferTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreOfferTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfferType  $offerType
     * @return \Illuminate\Http\Response
     */
    public function show(OfferType $offerType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOfferTypeRequest  $request
     * @param  \App\Models\OfferType  $offerType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOfferTypeRequest $request, OfferType $offerType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferType  $offerType
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferType $offerType)
    {
        //
    }
}
