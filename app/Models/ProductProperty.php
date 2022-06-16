<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductProperty
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\ProductPropertyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductProperty whereUpdatedAt($value)
 */
class ProductProperty extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
