<?php

declare(strict_types=1);

namespace App\Actions\Categories;

use App\Models\Category;

class CreateCategory
{
    /**
     * Create a new category.
     *
     * @param array<string, mixed> $data
     * @return Category
     */
    public function execute(array $data): Category
    {
        return Category::create($data);
    }
}
