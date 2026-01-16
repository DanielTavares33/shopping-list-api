<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ProductListItem> $items
 * @property-read int|null $items_count
 * @property-read User $user
 * @method static \Database\Factories\ProductListFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductList query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductList whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProductList whereUserId($value)
 * @mixin \Eloquent
 */
class ProductList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title'];

    public function items(): HasMany
    {
        return $this->hasMany(ProductListItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
