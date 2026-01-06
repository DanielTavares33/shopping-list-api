<?php

declare(strict_types=1);

namespace App\Actions\Products;

use App\Models\Product;

class CreateProduct
{
    /**
     * Create a new product.
     *
     * @param array<string, mixed> $data
     * @return Product
     */
    public function execute(array $data): Product
    {
        return Product::create($data);
    }
}
