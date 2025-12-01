<?php

namespace App\Filament\Resources\InvoiceTrackings;

use App\Filament\Resources\InvoiceTrackings\Pages\CreateInvoiceTracking;
use App\Filament\Resources\InvoiceTrackings\Pages\EditInvoiceTracking;
use App\Filament\Resources\InvoiceTrackings\Pages\ListInvoiceTrackings;
use App\Filament\Resources\InvoiceTrackings\Schemas\InvoiceTrackingForm;
use App\Filament\Resources\InvoiceTrackings\Tables\InvoiceTrackingsTable;
use App\Models\InvoiceTracking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InvoiceTrackingResource extends Resource
{
    protected static ?string $model = InvoiceTracking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCurrencyPound;

    protected static ?string $recordTitleAttribute = 'InvoiceTrakings';

    public static function form(Schema $schema): Schema
    {
        return InvoiceTrackingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoiceTrackingsTable::configure($table);
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
            'index' => ListInvoiceTrackings::route('/'),
            'create' => CreateInvoiceTracking::route('/create'),
            'edit' => EditInvoiceTracking::route('/{record}/edit'),
        ];
    }
}
