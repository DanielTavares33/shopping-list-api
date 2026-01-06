<?php

namespace App\Actions\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\DB;


class DestroyCategory
{
    /**
     * Delete the given category.
     *
     * @param Category $category
     * @return bool
     */
    public function execute(Category $category): bool
    {
        return DB::transaction(function () use ($category): bool {
            return $category->delete();
        });
    }
}