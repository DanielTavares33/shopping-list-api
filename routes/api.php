<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductListItemController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {

    // Test route to create a token for a specific user by email
    Route::post('test-token', function (Illuminate\Http\Request $request): JsonResponse {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = App\Models\User::where('email', $request->input('email'))->first();
        if ( ! $user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $token = $user->createToken('test-token')->plainTextToken;
        return response()->json(['token' => $token]);
    });

    Route::get('/health', [HealthCheckController::class, '__invoke']);

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::apiResource('categories', CategoryController::class)->middleware('auth:sanctum');
    Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
    Route::apiResource('product-lists', ProductListController::class)->middleware('auth:sanctum');
    Route::apiResource('product-list-items', ProductListItemController::class)->middleware('auth:sanctum');

    Route::get('users/{user}/product-lists', [ProductListController::class, 'byUser'])->middleware('auth:sanctum');
});
