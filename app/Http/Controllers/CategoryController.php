<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponse;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = Category::all();

        return $this->customResponse(CategoryResource::collection($categories));
    }

    public function show(Category $category)
    {
        $category->load('menuItems');

        return $this->customResponse(CategoryResource::make($category));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated_data = $request->validated();

        $category = Category::create($validated_data);

        return $this->customResponse($category, 'Category created successfully.', 201);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated_data = $request->validated();

        $category->update($validated_data);

        return $this->customResponse($category, 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $this->customResponse(null, 'Categorydeleted successfully.', 204);
    }
}
