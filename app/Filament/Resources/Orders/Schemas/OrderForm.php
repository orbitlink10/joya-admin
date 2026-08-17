<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_number')
                    ->helperText('Leave blank to generate automatically.')
                    ->maxLength(255),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'preparing' => 'Preparing',
                        'ready' => 'Ready',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
                Select::make('payment_status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'deposit_paid' => 'Deposit paid',
                        'paid' => 'Paid',
                        'refunded' => 'Refunded',
                    ])
                    ->default('unpaid')
                    ->required(),
                TextInput::make('customer_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('customer_phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                TextInput::make('customer_email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('delivery_location')
                    ->maxLength(255),
                DatePicker::make('delivery_date'),
                Textarea::make('customer_message')
                    ->rows(3)
                    ->columnSpanFull(),
                Repeater::make('items')
                    ->relationship()
                    ->schema([
                        Select::make('product_id')
                            ->label('Product')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload(),
                        TextInput::make('product_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required(),
                        TextInput::make('unit_price')
                            ->numeric()
                            ->prefix('KSh')
                            ->default(0)
                            ->required(),
                        TextInput::make('line_total')
                            ->numeric()
                            ->prefix('KSh')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(5)
                    ->columnSpanFull(),
                TextInput::make('subtotal')
                    ->numeric()
                    ->prefix('KSh')
                    ->default(0),
                TextInput::make('delivery_fee')
                    ->numeric()
                    ->prefix('KSh')
                    ->default(0),
                TextInput::make('total')
                    ->numeric()
                    ->prefix('KSh')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('amount_paid')
                    ->numeric()
                    ->prefix('KSh')
                    ->default(0)
                    ->helperText('Enter 0 if unpaid, a smaller amount for deposit, or full amount when fully paid.'),
                Select::make('payment_method')
                    ->options([
                        'cash' => 'Cash',
                        'mpesa' => 'M-Pesa',
                        'bank' => 'Bank transfer',
                        'card' => 'Card',
                        'other' => 'Other',
                    ]),
                DatePicker::make('payment_date'),
                Textarea::make('payment_instructions')
                    ->rows(3)
                    ->helperText('Shown on the invoice. Example: Pay via M-Pesa to +254746761556 and send confirmation.')
                    ->columnSpanFull(),
                Textarea::make('admin_notes')
                    ->rows(4)
                    ->helperText('Private notes for follow-up, delivery, payments, or client preferences.')
                    ->columnSpanFull(),
            ]);
    }
}
