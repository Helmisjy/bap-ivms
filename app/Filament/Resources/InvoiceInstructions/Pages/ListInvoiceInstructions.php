<?php

namespace App\Filament\Resources\InvoiceInstructions\Pages;

use App\Filament\Resources\InvoiceInstructions\InvoiceInstructionsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInvoiceInstructions extends ListRecords
{
    protected static string $resource = InvoiceInstructionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
