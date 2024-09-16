<?php

namespace App\Actions\ProductActions;

use App\Models\Product;

class Update
{
    public function handle(array $data, Product $product) : bool
    {
        return $product->update($data);
    }
}
