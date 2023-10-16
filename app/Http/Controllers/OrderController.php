<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\ShopProduct;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService,
        private ShopProduct $shopProduct,
    )
    {
    }

    public function create()
    {
        return view('add-order',[
            'shop_products' => $this->shopProduct->all(),
        ]);
    }

    public function store(OrderRequest $request)
    {
        $this->orderService->store($request);

        return response()->json([
            'message' => 'Order created successfully'
        ]);
    }
}
