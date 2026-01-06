<?php

declare(strict_types=1);

namespace App\Actions\Categories;

use App\Models\Category;

class UpdateCategory
{
    /**
     * Update the given category.
     *
     * @param array<string, mixed> $data
     * @param string $id
     * @return Category
     */
    public function execute(array $data, string $id): Category
    {
        $category = Category::findOrFail($id);
        $category->update($data);

        return $category;
    }
}
