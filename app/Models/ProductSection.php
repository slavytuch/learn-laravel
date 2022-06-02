<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductSection
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $active
 * @property string $name
 * @property string $code
 * @property string|null $picture
 * @property int|null $product_section_id
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductSection[] $children
 * @property-read int|null $children_count
 * @property-read ProductSection|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection whereProductSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductSection extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function costlyProducts()
    {
        return $this->products()->where('price', '>', 1000);
    }

    public function parent()
    {
        return $this->belongsTo(ProductSection::class, 'product_section_id');
    }

    public function children()
    {
        return $this->hasMany(ProductSection::class);
    }
}
