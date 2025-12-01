<?php

namespace App\Filament\Resources\InvoiceReminders\Pages;

use App\Filament\Resources\InvoiceReminders\InvoiceRemindersResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceReminders extends ListRecords
{
    protected static string $resource = InvoiceRemindersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
