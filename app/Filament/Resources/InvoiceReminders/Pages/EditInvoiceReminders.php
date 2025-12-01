<?php

namespace App\Filament\Resources\InvoiceReminders\Pages;

use App\Filament\Resources\InvoiceReminders\InvoiceRemindersResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceReminders extends EditRecord
{
    protected static string $resource = InvoiceRemindersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
