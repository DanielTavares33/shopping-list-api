<?php

declare(strict_types=1);

namespace App\Actions\Products;

use App\Models\Product;

class UpdateProduct
{
    /**
     * Update the given product with the provided data.
     *
     * @param array<string, mixed> $data
     * @param string $id
     * @return Product
     */
    public function execute(array $data, string $id): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);

        return $product;
    }
}
