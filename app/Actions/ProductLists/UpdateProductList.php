<?php

declare(strict_types=1);

namespace App\Actions\ProductLists;

use App\Models\ProductList;

class UpdateProductList
{
    /**
     * Update an existing ProductList.
     *
     * @param array<string, mixed> $data
     * @param string $id
     * @return ProductList
     */
    public function execute(array $data, string $id): ProductList
    {
        $productList = ProductList::findOrFail($id);
        $productList->update($data);

        return $productList;
    }
}
