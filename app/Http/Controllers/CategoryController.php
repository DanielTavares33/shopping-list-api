<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Categories\CreateCategory;
use App\Actions\Categories\DestroyCategory;
use App\Actions\Categories\UpdateCategory;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
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
        return CategoryResource::collection(Category::all())->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $categoryRequest, CreateCategory $createCategory): JsonResponse
    {
        $category = $createCategory->execute($categoryRequest->validated());

        return (new CategoryResource($category))
            ->additional(['message' => 'Category created successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        // Return a single resource directly
        return (new CategoryResource($category))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $categoryRequest, UpdateCategory $updateCategory, string $id): JsonResponse
    {
        $category = $updateCategory->execute($categoryRequest->validated(), $id);

        return (new CategoryResource($category))
            ->additional(['message' => 'Category updated successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyCategory $destroyCategory, string $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $destroyCategory->execute($category);

        return (new CategoryResource($category))
            ->additional(['message' => 'Category deleted successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
