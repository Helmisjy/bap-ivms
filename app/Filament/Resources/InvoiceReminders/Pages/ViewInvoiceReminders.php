<?php

namespace App\Filament\Resources\InvoiceReminders\Pages;

use App\Filament\Resources\InvoiceReminders\InvoiceRemindersResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInvoiceReminders extends ViewRecord
{
    protected static string $resource = InvoiceRemindersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
