<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Products\CreateProduct;
use App\Actions\Products\DestroyProduct;
use App\Actions\Products\UpdateProduct;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
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
        return ProductResource::collection(Product::all())->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $productRequest, CreateProduct $createProduct): JsonResponse
    {
        $product = $createProduct->execute($productRequest->validated());

        return (new ProductResource($product))
            ->additional(['message' => 'Product created successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return (new ProductResource(Product::findOrFail($id)))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $productRequest, UpdateProduct $updateProduct, string $id): JsonResponse
    {
        $product = $updateProduct->execute($productRequest->validated(), $id);

        return (new ProductResource($product))
            ->additional(['message' => 'Product updated successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyProduct $destroyProduct, string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $destroyProduct->execute($product);

        return (new ProductResource($product))
            ->additional(['message' => 'Product deleted successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
