<?php

declare(strict_types=1);

namespace App\Actions\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DestroyProduct
{
    /**
     * Delete the given product.
     *
     * @param Product $product
     * @return bool
     */
    public function execute(Product $product): bool
    {
        return DB::transaction(function () use ($product): bool {
            return $product->delete();
        });
    }
}
