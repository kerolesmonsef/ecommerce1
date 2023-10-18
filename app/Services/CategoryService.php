<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public function getChildes(Category $category): Collection
    {

        $childCategories = $this->allSubChildrens($category);
        $childCategories->push($category);

        ##################### another solution / just 2 queries
        $childCategories = $this->allSubChildrensSql($category);


        return $childCategories;
    }

    public function allSubChildrens(Category $category)
    {
        if ($category->childrens->count() == 0) {
            return collect();
        }
        $categories = $category->childrens;

        foreach ($category->childrens as $child) {
            $categories = $categories->merge($this->allSubChildrens($child));
        }

        return $categories;
    }

    public function allSubChildrensSql(Category $category)
    {
        $sql = "WITH RECURSIVE CategoryHierarchy AS (
              SELECT id
              FROM categories
              WHERE id = {$category->id}  -- Replace :category_id with the ID of the starting category

              UNION ALL

              SELECT c.id
              FROM categories c
              INNER JOIN CategoryHierarchy ch ON c.parent_id = ch.id
            )
            SELECT * FROM CategoryHierarchy;";

        $category_ids = DB::select($sql);
        $category_ids = array_map(fn($category) => $category->id, $category_ids);
        return Category::whereIn('id', $category_ids)->get();
    }
}
