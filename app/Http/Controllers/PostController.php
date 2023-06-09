<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;
use Illuminate\Auth\Events\Validated;

class PostController extends Controller
{
    use ApiResponse, ManagesFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with([
            'comments' => function ($query) {
                $query->with('user')->latest()->first();
            },
            'PostImages'
        ])
            ->orderBy('id', 'desc')
            ->paginate(4);
        return $this->successResponse(PostResource::collection($posts));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        $images = $request->validated('images');
        if($images)
        foreach ($images as $image) {
            $path = $this->uploadFile($image, 'images/posts');
            $post->postImages()->create([
                'path' => $path,
            ]);
        }
        return $this->successResponse(PostResource::make($post));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load(['comments.user', 'postImages']);
        return $this->successResponse(PostResource::make($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request  
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return $this->successResponse(PostResource::make($post));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->load('postImages');
        $postImages = $post->postImages;
        foreach ($postImages as $image) {
            $this->deleteFile($image->path);
        }
        $post->delete();
        return $this->customResponse('Successfully deleted');
    }
}
