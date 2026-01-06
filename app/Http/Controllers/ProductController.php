<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Products\CreateProduct;
use App\Actions\Products\DestroyProduct;
use App\Actions\Products\UpdateProduct;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json($products, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $productRequest, CreateProduct $createProduct): JsonResponse
    {
        $product = $createProduct->execute($productRequest->validated());

        return response()->json([
            'message' => 'Product created successfully.',
            'data' => [$product]
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'data' => [$product]
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $productRequest, UpdateProduct $updateProduct, string $id): JsonResponse
    {
        $product = $updateProduct->execute($productRequest->validated(), $id);

        return response()->json([
            'message' => 'Product updated successfully.',
            'data' => [$product]
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyProduct $destroyProduct, string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $destroyProduct->execute($product);

        return response()->json([
            'message' => 'Product deleted successfully.'
        ], Response::HTTP_OK);
    }
}
