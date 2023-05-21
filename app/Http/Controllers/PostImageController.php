<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use App\Http\Requests\StorePostImageRequest;
use App\Http\Requests\UpdatePostImageRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class PostImageController extends Controller
{
    use ApiResponse,ManagesFiles;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostImageRequest $request)
    {
        $images=$request->validated();
        $post_id=$request->validated('post_id');
        foreach($images as $image){
           $path= $this->uploadFile($image,'posts_images');
            PostImage::create([
                'post_id' => $post_id ,
                'path' => $path,
            ]);
        }
        $post=Post::with('postImages')->find($post_id);
        return $this->successResponse(PostResource::make($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostImage  $postImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostImage $postImage)
    {
        $this->deleteFile($postImage->path);
        return $this->customResponse([],'Image deleted succussfully');
    }
}
