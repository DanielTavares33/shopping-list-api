<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_list_id
 * @property int $product_id
 * @property numeric|null $quantity
 * @property string|null $unit
 * @property int $is_checked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Product $product
 * @property-read ProductList $productList
 * @method static \Database\Factories\ProductListItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem whereIsChecked($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem whereProductListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductListItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
