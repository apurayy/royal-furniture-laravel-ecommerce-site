<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'short_description', 'description',
        'price', 'old_price', 'sku', 'stock_quantity', 'images',
        'material', 'dimensions', 'color', 'weight', 'featured', 'status'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'featured' => 'boolean'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getFirstImageAttribute()
    {
        $images = $this->images;
        if (is_array($images) && count($images) > 0) {
            return $images[0];
        }
        return null;
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->old_price && $this->old_price > $this->price) {
            return round(($this->old_price - $this->price) / $this->old_price * 100);
        }
        return 0;
    }
}
