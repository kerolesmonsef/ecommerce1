<?php

namespace App\Services;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class OrderService
{

    public function store(OrderRequest $request)
    {
        $shopProduct = ShopProduct::findOrFail($request->shop_product_id);

        Order::create([
            'shop_product_id' => $shopProduct->id,
            'customer_name' => $request->customer_name,
            'total_price' => $shopProduct->price * $request->quantity,
            'quantity' => $request->quantity,
        ]);

        $shopProduct->decrement('quantity', $request->quantity);
    }
}
