<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductListItem extends Model
{
    protected $fillable = ['product_list_id', 'product_id', 'quantity', 'unit'];

    public function productList(): BelongsTo
    {
        return $this->belongsTo(ProductList::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}