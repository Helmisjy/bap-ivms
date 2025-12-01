<?php

namespace App\Filament\Resources\InvoiceTrackings\Pages;

use App\Filament\Resources\InvoiceTrackings\InvoiceTrackingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceTrackings extends ListRecords
{
    protected static string $resource = InvoiceTrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
