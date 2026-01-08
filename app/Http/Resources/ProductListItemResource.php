<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_list_id' => $this->product_list_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'is_checked' => $this->is_checked,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
