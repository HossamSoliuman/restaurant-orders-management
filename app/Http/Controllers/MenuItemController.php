<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Traits\ApiResponse;

class MenuItemController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuItemRequest $request)
    {
        $item=MenuItem::create($request->validated());
        return $this->customResponse([MenuItemResource::make($item)], 'Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItem $menuItem)
    {
        $item = $menuItem->load('offers', 'images', 'reviews.user');
        return MenuItemResource::make($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuItemRequest  $request
     * @param  \App\Models\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem)
    {
        $menuItem->update($request->validated());
        return $this->customResponse([], 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return $this->customResponse([], 'Item soft deleted.');
    }

    public function forceDestroy($menuItemId)
    {
        $item = MenuItem::withTrashed()
            ->findOrFail($menuItemId);

        $item->forceDelete();
        return $this->customResponse([], 'Item permanently deleted.');
    }

    public function restore($menuItem)
    {
        $item = MenuItem::withTrashed()
            ->findOrFail($menuItem);
            return $item;
        $item->restore();
        return $this->customResponse([], 'Item restored.');
    }

    public function deleted()
    {
        $items = MenuItem::onlyTrashed()->get();
        return MenuItemResource::collection($items);
    }
}
