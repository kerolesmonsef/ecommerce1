<?php

namespace App\Services;

use App\Models\Category;
use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Collection;

class ShopProductService
{
    public function all()
    {
        return ShopProduct::all();
    }

    public function latestShopProducts()
    {
        return ShopProduct::query()
            ->with('product')
            ->join('products', 'products.id', '=', 'shop_products.product_id')
            ->select('shop_products.*')
            ->groupBy('products.category_id')
            ->orderByDesc('shop_products.id')
            ->get();
    }

    public function getProductsForCategories(Collection $categories): Collection|array
    {
        return ShopProduct::query()
            ->with('product')
            ->join('products', 'products.id', '=', 'shop_products.product_id')
            ->select('shop_products.*')
            ->whereIn('products.category_id', $categories->pluck('id'))
            ->get();
    }
}
