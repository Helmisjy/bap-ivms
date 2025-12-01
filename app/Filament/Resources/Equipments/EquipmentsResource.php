<?php

namespace App\Filament\Resources\Equipments;

use App\Filament\Resources\Equipments\Pages\CreateEquipments;
use App\Filament\Resources\Equipments\Pages\EditEquipments;
use App\Filament\Resources\Equipments\Pages\ListEquipments;
use App\Filament\Resources\Equipments\Pages\ViewEquipments;
use App\Filament\Resources\Equipments\Schemas\EquipmentsForm;
use App\Filament\Resources\Equipments\Schemas\EquipmentsInfolist;
use App\Filament\Resources\Equipments\Tables\EquipmentsTable;
use App\Models\Equipments;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EquipmentsResource extends Resource
{
    protected static ?string $model = Equipments::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Truck;

    protected static ?string $recordTitleAttribute = 'Equipments';

    public static function form(Schema $schema): Schema
    {
        return EquipmentsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EquipmentsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EquipmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEquipments::route('/'),
            'create' => CreateEquipments::route('/create'),
            'view' => ViewEquipments::route('/{record}'),
            'edit' => EditEquipments::route('/{record}/edit'),
        ];
    }
}
