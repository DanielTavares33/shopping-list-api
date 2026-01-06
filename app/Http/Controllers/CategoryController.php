<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Categories\CreateCategory;
use App\Actions\Categories\DestroyCategory;
use App\Actions\Categories\UpdateCategory;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json([
            'data' => $categories
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $categoryRequest, CreateCategory $createCategory): JsonResponse
    {
        $category = $createCategory->execute($categoryRequest->validated());

        return response()->json([
            'message' => 'Category created successfully.',
            'data' => [$category]
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'data' => [$category]
        ], Response::HTTP_OK);
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
        ], Response::HTTP_OK);
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
        ], Response::HTTP_OK);
    }
}
