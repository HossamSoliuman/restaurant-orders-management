<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;

class ReviewController extends Controller
{
    use ApiResponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreReviewRequest $request)
    {
        $user_id = Auth::id();
        $menu_item_id = $request->validated('menu_item_id');
    
        $hasReview = MenuItem::where('id', $menu_item_id)
            ->whereHas('reviews', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->count();
    
        if ($hasReview) {
            return $this->errorResponse('You have already reviewed this menu item', 422);
        }
    
        $review = Review::create($request->validated() + ['user_id' => $user_id]);
        return $this->successResponse(ReviewResource::make($review));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return $this->successResponse(ReviewResource::make($review));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
         if (Auth::id() !== $review->user_id) {
            return $this->errorResponse('You are not authorized to edit this review.', 403);
        }
        $validatedData = $request->validated();

        $review->update($validatedData);

        $review->save();

        return $this->successResponse(ReviewResource::make($review));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            return $this->errorResponse('You are not authorized to delete this review.', 403);
        }
    
        $review->delete();
    
        return $this->customResponse([], 'Review successfully deleted');
    }
}
