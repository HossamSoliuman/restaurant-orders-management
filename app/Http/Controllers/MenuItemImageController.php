<?php

namespace App\Http\Controllers;

use App\Models\MenuItemImage;
use App\Http\Requests\StoreMenuItemImageRequest;
use App\Http\Requests\UpdateMenuItemImageRequest;
use App\Models\MenuItem;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class MenuItemImageController extends Controller
{

    use ManagesFiles, ApiResponse;
    public $folder = 'menu_item_images';
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuItemImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuItemImageRequest $request)
    {
        $path = $this->uploadFile($request->validated('image'), $this->folder);
        
        $image = MenuItemImage::create([
            'path' => $path,
            'menu_item_id' => $request->validated('menu_item_id'),
        ]);
        return $this->successResponse($image);
    }

    public function destroy(MenuItemImage $menuItemImage)
    {
        $this->deleteFile($menuItemImage->path);
        $menuItemImage->delete();
        return $this->customResponse([],'Deleted succusfully');
    }
}
