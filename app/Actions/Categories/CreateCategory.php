<?php

namespace App\Actions\Categories;

use App\Models\Category;

class CreateCategory
{
    public function execute(array $data): Category
    {
        return Category::create($data);
    }
}