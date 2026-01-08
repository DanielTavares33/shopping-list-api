<?php

declare(strict_types=1);

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductListItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/health', [HealthCheckController::class, '__invoke']);

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-lists', ProductListController::class);
    Route::apiResource('product-list-items', ProductListItemController::class);

    Route::get('users/{user}/product-lists', [ProductListController::class, 'byUser']);
});
