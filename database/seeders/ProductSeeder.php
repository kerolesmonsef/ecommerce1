<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ShopProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $product = Product::factory()->create();

            $this->createShopProduct($product);
            $this->createShopProduct($product);
            $this->createShopProduct($product);
        }
    }

    private function createShopProduct(Product $product)
    {
        ShopProduct::query()->create([
            'product_id' => $product->id,
            'price' => rand(1, 99),
            'quantity' => rand(1, 99),
        ]);
    }
}
