<?php

namespace App\Filament\Resources\InvoiceInstructions;

use App\Filament\Resources\InvoiceInstructions\Pages\CreateInvoiceInstructions;
use App\Filament\Resources\InvoiceInstructions\Pages\EditInvoiceInstructions;
use App\Filament\Resources\InvoiceInstructions\Pages\ListInvoiceInstructions;
use App\Filament\Resources\InvoiceInstructions\Schemas\InvoiceInstructionsForm;
use App\Filament\Resources\InvoiceInstructions\Tables\InvoiceInstructionsTable;
use App\Models\InvoiceInstructions;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InvoiceInstructionsResource extends Resource
{
    protected static ?string $model = InvoiceInstructions::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentCheck;

    protected static ?string $recordTitleAttribute = 'InvoiceInstruction';

    public static function form(Schema $schema): Schema
    {
        return InvoiceInstructionsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoiceInstructionsTable::configure($table);
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
            'index' => ListInvoiceInstructions::route('/'),
            'create' => CreateInvoiceInstructions::route('/create'),
            'edit' => EditInvoiceInstructions::route('/{record}/edit'),
        ];
    }
}
