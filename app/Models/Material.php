<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = [
        'name',
        'category',
        'unit',
        'quantity_on_hand',
        'unit_cost',
        'supplier',
        'reorder_level',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity_on_hand' => 'decimal:2',
            'unit_cost' => 'decimal:2',
            'reorder_level' => 'decimal:2',
        ];
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function getStockValueAttribute(): float
    {
        return (float) $this->quantity_on_hand * (float) $this->unit_cost;
    }
}
