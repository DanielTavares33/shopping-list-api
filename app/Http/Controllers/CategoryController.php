<?php

namespace App\Http\Controllers;

use App\Actions\Categories\CreateCategory;
use App\Actions\Categories\DestroyCategory;
use App\Actions\Categories\UpdateCategory;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $categoryRequest, CreateCategory $createCategory): JsonResponse
    {
        $category = $createCategory->execute($categoryRequest->validated());

        return response()->json([
            'message' => 'Category created successfully.',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $categoryRequest, UpdateCategory $updateCategory, string $id): JsonResponse
    {
        $category = $updateCategory->execute($categoryRequest->validated(), $id);

        return response()->json([
            'message' => 'Category updated successfully.',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyCategory $destroyCategory, string $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $destroyCategory->execute($category);

        return response()->json([
            'message' => 'Category deleted successfully.'
        ], 201);
    }
}
