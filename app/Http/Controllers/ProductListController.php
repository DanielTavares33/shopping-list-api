<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ProductLists\CreateProductList;
use App\Actions\ProductLists\DestroyProductList;
use App\Actions\ProductLists\UpdateProductList;
use App\Http\Requests\ProductListRequest;
use App\Http\Resources\ProductListResource;
use App\Models\ProductList;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductListController extends Controller
{
    /**
     * Display a listing of the product lists.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ProductListResource::collection(ProductList::all())->response();
    }

    /**
     * Store a newly created product list in storage.
     *
     * @param ProductListRequest $request
     * @param CreateProductList $createProductList
     * @return JsonResponse
     */
    public function store(ProductListRequest $request, CreateProductList $createProductList): JsonResponse
    {
        $productList = $createProductList->execute($request->validated());

        return (new ProductListResource($productList))
            ->additional(['message' => 'Product list created successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified product list.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $productList = ProductList::findOrFail($id);

        return (new ProductListResource($productList))->response();
    }

    /**
     * Get all product lists for a given user.
     *
     * @param string $userId
     * @return JsonResponse
     */
    public function byUser(string $userId): JsonResponse
    {
        $productLists = ProductList::where('user_id', $userId)->get();

        return ProductListResource::collection($productLists)->response();
    }

    /**
     * Update the specified product list in storage.
     *
     * @param ProductListRequest $request
     * @param UpdateProductList $updateProductList
     * @param string $id
     * @return JsonResponse
     */
    public function update(ProductListRequest $request, UpdateProductList $updateProductList, string $id): JsonResponse
    {
        $productList = $updateProductList->execute($request->validated(), $id);

        return (new ProductListResource($productList))
            ->additional(['message' => 'Product list updated successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified product list from storage.
     *
     * @param DestroyProductList $destroyProductList
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(DestroyProductList $destroyProductList, string $id): JsonResponse
    {
        $productList = ProductList::findOrFail($id);
        $destroyProductList->execute($productList);

        return (new ProductListResource($productList))
            ->additional(['message' => 'Product list deleted successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
