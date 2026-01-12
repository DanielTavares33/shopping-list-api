<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductListItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_list_id', 'product_id', 'quantity', 'unit', 'is_checked'];

    public function productList(): BelongsTo
    {
        return $this->belongsTo(ProductList::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
