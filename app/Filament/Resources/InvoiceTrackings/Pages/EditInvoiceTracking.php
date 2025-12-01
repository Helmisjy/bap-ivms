<?php

namespace App\Filament\Resources\InvoiceTrackings\Pages;

use App\Filament\Resources\InvoiceTrackings\InvoiceTrackingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceTracking extends EditRecord
{
    protected static string $resource = InvoiceTrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
