<?php

declare(strict_types=1);

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HealthCheckController;
use Illuminate\Support\Facades\Route;

// Health check endpoint
Route::prefix('v1')->group(function (): void {
    Route::get('/health', [HealthCheckController::class, '__invoke']);

    Route::apiResource('categories', CategoryController::class);
});
