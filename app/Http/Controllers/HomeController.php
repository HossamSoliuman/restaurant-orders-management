<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
class HomeController extends Controller
{
    use ApiResponse;
    public function menu(){
      $categories=  Category::with('menuItems.images','menuItems.offers')->get();
      return $this->successResponse( CategoryResource::collection($categories));
    }
    public function offers(){
        $offers= Offer::with('menuItem')->get();
        return $this->successResponse(OfferResource::collection($offers));
    }
    public function posts(){
        $posts=Post::with('comments','PostImages')->latest()->paginate(5);
        return $this->successResponse(PostResource::collection($posts));
    }
}
