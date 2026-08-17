<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('invoice')
                ->label('Invoice')
                ->url(fn () => route('admin.orders.invoice', $this->getRecord()))
                ->openUrlInNewTab(),
            Action::make('receipt')
                ->label('Receipt')
                ->url(fn () => route('admin.orders.receipt', $this->getRecord()))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
