<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class StockMovement extends Model
{
    protected $fillable = [
        'material_id',
        'type',
        'quantity',
        'unit_cost',
        'total_cost',
        'reference',
        'supplier',
        'movement_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'unit_cost' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'movement_date' => 'date',
        ];
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    protected static function booted(): void
    {
        static::creating(function (StockMovement $movement) {
            if (blank($movement->reference)) {
                $movement->reference = 'STK-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
            }

            $movement->total_cost = (float) $movement->quantity * (float) $movement->unit_cost;
        });

        static::created(function (StockMovement $movement) {
            $material = $movement->material;

            if (! $material) {
                return;
            }

            $quantity = (float) $movement->quantity;

            if ($movement->type === 'in') {
                $material->quantity_on_hand = (float) $material->quantity_on_hand + $quantity;
                $material->unit_cost = (float) $movement->unit_cost ?: $material->unit_cost;
                $material->supplier = $movement->supplier ?: $material->supplier;
            }

            if ($movement->type === 'out') {
                $material->quantity_on_hand = max(0, (float) $material->quantity_on_hand - $quantity);
            }

            if ($movement->type === 'adjustment') {
                $material->quantity_on_hand = $quantity;
            }

            $material->save();
        });
    }
}
