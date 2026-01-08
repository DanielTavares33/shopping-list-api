<?php

declare(strict_types=1);

namespace App\Actions\ProductListItems;

use App\Models\ProductListItem;

class CreateProductListItem
{
    /**
     * Create a new ProductListItem.
     *
     * @param array<string, mixed> $data
     * @return ProductListItem
     */
    public function execute(array $data): ProductListItem
    {
        return ProductListItem::create($data);
    }
}
