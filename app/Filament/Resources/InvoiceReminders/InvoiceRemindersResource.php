<?php

namespace App\Filament\Resources\InvoiceReminders;

use App\Filament\Resources\InvoiceReminders\Pages\CreateInvoiceReminders;
use App\Filament\Resources\InvoiceReminders\Pages\EditInvoiceReminders;
use App\Filament\Resources\InvoiceReminders\Pages\ListInvoiceReminders;
use App\Filament\Resources\InvoiceReminders\Pages\ViewInvoiceReminders;
use App\Filament\Resources\InvoiceReminders\Schemas\InvoiceRemindersForm;
use App\Filament\Resources\InvoiceReminders\Schemas\InvoiceRemindersInfolist;
use App\Filament\Resources\InvoiceReminders\Tables\InvoiceRemindersTable;
use App\Models\InvoiceReminders;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InvoiceRemindersResource extends Resource
{
    protected static ?string $model = InvoiceReminders::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'yes';

    public static function form(Schema $schema): Schema
    {
        return InvoiceRemindersForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InvoiceRemindersInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoiceRemindersTable::configure($table);
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
            'index' => ListInvoiceReminders::route('/'),
            'create' => CreateInvoiceReminders::route('/create'),
            'view' => ViewInvoiceReminders::route('/{record}'),
            'edit' => EditInvoiceReminders::route('/{record}/edit'),
        ];
    }
}
