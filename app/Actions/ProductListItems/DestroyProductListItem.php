<?php

declare(strict_types=1);

namespace App\Actions\ProductListItems;

use App\Models\ProductListItem;

class DestroyProductListItem
{
    /**
     * Delete the given ProductListItem.
     *
     * @param ProductListItem $item
     * @return void
     */
    public function execute(ProductListItem $item): void
    {
        $item->delete();
    }
}
