<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShopProductResource;
use App\Services\ShopProductService;
use Illuminate\Http\Request;

class ShopProductController extends Controller
{
    public function __construct(private ShopProductService $service)
    {
    }

    public function latest()
    {
        $latestShopProducts = $this->service->latestShopProducts();

        return response()->json(ShopProductResource::collection($latestShopProducts));
    }
}
