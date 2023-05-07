<?php

namespace App\Http\Controllers;

use App\Models\MenuItemImage;
use App\Http\Requests\StoreMenuItemImageRequest;
use App\Http\Requests\UpdateMenuItemImageRequest;

class MenuItemImageController extends Controller
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
     * @param  \App\Http\Requests\StoreMenuItemImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuItemImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuItemImage  $menuItemImage
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItemImage $menuItemImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuItemImageRequest  $request
     * @param  \App\Models\MenuItemImage  $menuItemImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuItemImageRequest $request, MenuItemImage $menuItemImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuItemImage  $menuItemImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItemImage $menuItemImage)
    {
        //
    }
}
