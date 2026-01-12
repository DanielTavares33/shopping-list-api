<?php

declare(strict_types=1);

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HealthCheckController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductListItemController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Route to generate a Sanctum token for testing
Route::post('v1/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if ( ! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('test-token')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::prefix('v1')->group(function (): void {
    Route::get('/health', [HealthCheckController::class, '__invoke']);

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-lists', ProductListController::class);
    Route::apiResource('product-list-items', ProductListItemController::class);

    Route::get('users/{user}/product-lists', [ProductListController::class, 'byUser']);
})->middleware('auth:sanctum');
