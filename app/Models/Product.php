<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'product_category_id',
        'description',
        'price',
        'previous_price',
        'is_flash_sale',
        'sale_label',
        'image',
        'category',
        'is_featured',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'previous_price' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'is_flash_sale' => 'boolean',
        ];
    }

    public function getDiscountPercentAttribute(): ?int
    {
        if (! $this->previous_price || ! $this->price || $this->previous_price <= $this->price) {
            return null;
        }

        return (int) round((($this->previous_price - $this->price) / $this->previous_price) * 100);
    }

    public function getIsOnSaleAttribute(): bool
    {
        return (bool) ($this->is_flash_sale || $this->discount_percent);
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            if (blank($product->slug)) {
                $product->slug = static::uniqueSlug($product->name);
            }
        });
    }

    protected static function uniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }
}
