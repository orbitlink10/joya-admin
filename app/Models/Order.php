<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'delivery_location',
        'delivery_date',
        'customer_message',
        'status',
        'payment_status',
        'subtotal',
        'delivery_fee',
        'total',
        'amount_paid',
        'payment_method',
        'payment_date',
        'payment_instructions',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'delivery_date' => 'date',
            'subtotal' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'total' => 'decimal:2',
            'amount_paid' => 'decimal:2',
            'payment_date' => 'date',
        ];
    }

    public function getBalanceDueAttribute(): float
    {
        return max(0, (float) $this->total - (float) $this->amount_paid);
    }

    public function getInvoiceNumberAttribute(): string
    {
        return str_replace('JOYA-', 'INV-', $this->order_number);
    }

    public function getReceiptNumberAttribute(): string
    {
        return str_replace('JOYA-', 'RCT-', $this->order_number);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (blank($order->order_number)) {
                $order->order_number = 'JOYA-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
            }
        });

        static::saving(function (Order $order) {
            $order->total = ((float) $order->subtotal) + ((float) $order->delivery_fee);

            if ((float) $order->amount_paid <= 0) {
                $order->payment_status = 'unpaid';
            } elseif ((float) $order->amount_paid < (float) $order->total) {
                $order->payment_status = 'deposit_paid';
            } else {
                $order->payment_status = 'paid';
            }
        });
    }
}
