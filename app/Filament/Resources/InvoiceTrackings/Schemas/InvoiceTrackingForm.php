<?php

namespace App\Filament\Resources\InvoiceTrackings\Schemas;

use App\Models\InvoiceInstructions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InvoiceTrackingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('invoice_instruction_id')
                    ->options(InvoiceInstructions::query()->pluck('trx_code', 'id'))
                    ->required(),
                TextInput::make('inv_number')
                    ->default(null),
                Textarea::make('inv_instruction')
                    ->default(null)
                    ->columnSpanFull(),
                DatePicker::make('inv_target'),
                DatePicker::make('inv_date'),
                DatePicker::make('inv_delivery'),
                DatePicker::make('payment_due_date'),
                DatePicker::make('collection_date'),
                DatePicker::make('payment_date'),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                TextInput::make('aging_days')
                    ->numeric()
                    ->default(null)
                    ->dehydrated()
                    ->disabled(),
                TextInput::make('aging_status')
                    ->disabled()
                    ->default(null),
                Radio::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid'   => 'Paid',
                    ])
                    ->default('unpaid')
                    ->inline(),
                TextInput::make('risk_level')
                    ->default(null)
                    ->disabled(),
            ]);
    }
}
