<?php

namespace App\Actions\ProductActions;

use App\Models\Product;

class Store
{
    public function handle(array $data): Product
    {
        return Product::query()->create($data);
    }
}
