<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\ProductListItems\CreateProductListItem;
use App\Actions\ProductListItems\DestroyProductListItem;
use App\Actions\ProductListItems\UpdateProductListItem;
use App\Http\Requests\ProductListItemRequest;
use App\Http\Resources\ProductListItemResource;
use App\Models\ProductListItem;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductListItemController extends Controller
{
    /**
     * Display a listing of the product list items.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return ProductListItemResource::collection(ProductListItem::all())->response();
    }

    /**
     * Store a newly created product list item in storage.
     *
     * @param ProductListItemRequest $request
     * @param CreateProductListItem $createProductListItem
     * @return JsonResponse
     */
    public function store(ProductListItemRequest $request, CreateProductListItem $createProductListItem): JsonResponse
    {
        $item = $createProductListItem->execute($request->validated());

        return (new ProductListItemResource($item))
            ->additional(['message' => 'Product list item created successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified product list item.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        return (new ProductListItemResource(ProductListItem::findOrFail($id)))->response();
    }

    /**
     * Update the specified product list item in storage.
     *
     * @param ProductListItemRequest $request
     * @param UpdateProductListItem $updateProductListItem
     * @param string $id
     * @return JsonResponse
     */
    public function update(ProductListItemRequest $request, UpdateProductListItem $updateProductListItem, string $id): JsonResponse
    {
        $item = $updateProductListItem->execute($request->validated(), $id);

        return (new ProductListItemResource($item))
            ->additional(['message' => 'Product list item updated successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified product list item from storage.
     *
     * @param DestroyProductListItem $destroyProductListItem
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(DestroyProductListItem $destroyProductListItem, string $id): JsonResponse
    {
        $item = ProductListItem::findOrFail($id);
        $destroyProductListItem->execute($item);

        return (new ProductListItemResource($item))
            ->additional(['message' => 'Product list item deleted successfully.'])
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
