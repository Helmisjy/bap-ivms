<?php

namespace App\Filament\Resources\InvoiceInstructions\Pages;

use App\Filament\Resources\InvoiceInstructions\InvoiceInstructionsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceInstructions extends EditRecord
{
    protected static string $resource = InvoiceInstructionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
