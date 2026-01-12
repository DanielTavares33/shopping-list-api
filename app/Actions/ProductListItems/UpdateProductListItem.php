<?php

declare(strict_types=1);

namespace App\Actions\ProductListItems;

use App\Models\ProductListItem;

class UpdateProductListItem
{
    /**
     * Update an existing ProductListItem.
     *
     * @param array<string, mixed> $data
     * @param string $id
     * @return ProductListItem
     */
    public function execute(array $data, string $id): ProductListItem
    {
        $item = ProductListItem::findOrFail($id);
        $item->update($data);

        return $item;
    }
}
