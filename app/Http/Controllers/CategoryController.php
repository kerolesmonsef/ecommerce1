<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ShopProductResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\ShopProductService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected ShopProductService $shopProductService,
    )
    {
    }

    public function show(Category $category)
    {
        $categories = $this->categoryService->getChildes($category);
        $shopProducts = $this->shopProductService->getProductsForCategories($categories);

        return response()->json([
            'categories' => CategoryResource::collection($categories),
            'shopProducts' => ShopProductResource::collection($shopProducts),
        ]);
    }
}
