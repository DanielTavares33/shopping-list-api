<?php

declare(strict_types=1);

namespace App\Actions\ProductLists;

use App\Models\ProductList;

class CreateProductList
{
    /**
     * Create a new ProductList.
     *
     * @param array<string, mixed> $data
     * @return ProductList
     */
    public function execute(array $data): ProductList
    {
        return ProductList::create($data);
    }
}
