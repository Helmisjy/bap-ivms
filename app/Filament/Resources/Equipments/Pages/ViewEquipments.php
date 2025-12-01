<?php

namespace App\Filament\Resources\Equipments\Pages;

use App\Filament\Resources\Equipments\EquipmentsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEquipments extends ViewRecord
{
    protected static string $resource = EquipmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
