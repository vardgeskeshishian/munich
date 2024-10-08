<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category' => new CategoryResource($this->whenLoaded('category')),
            'title' => $this->title,
            'description' => $this->description,
            'sku' => $this->sku,
            'price' => $this->price,
        ];
    }
}
