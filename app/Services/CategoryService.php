<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getChildes(Category $category): Collection
    {
        $childCategories = $category->children()->get();
        $childCategories->push($category);

        return $childCategories;
    }
}
