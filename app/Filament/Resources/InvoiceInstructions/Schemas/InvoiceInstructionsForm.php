<?php

namespace App\Filament\Resources\InvoiceInstructions\Schemas;

use App\Models\Clients;
use App\Models\Equipments;
use App\Models\Projects;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InvoiceInstructionsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Placeholder::make('trx_code')
                    ->label('TRX Code')
                    ->content(function ($record) {
                            if (!$record) return '-';

                            return "<span class='px-3 py-1 rounded-lg bg-primary-100 text-primary-800 text-xl font-semibold'>
                                        {$record->trx_code}
                                    </span>";
                        })
                        ->extraAttributes(['class' => 'pt-2'])
                        ->html(),
                    // ->content(fn($record) => $record?->trx_code ?? '-')
                    // ->extraAttributes([
                    //     'class' => 'text-2xl font-bold text-primary-600',
                    // ]),

                TextInput::make('sale_order')
                    ->default(null),

                Select::make('client_id')
                    ->required()
                    ->options(Clients::query()->pluck('name', 'id'))
                    ->getSearchResultsUsing(fn (string $search): array => Clients::query()
                        ->where('name', 'like', "%{$search}%")
                        ->limit(50)
                        ->pluck('name', 'id')
                        ->all())
                    ->getOptionLabelUsing(fn ($value): ?string => Clients::find($value)?->name)
                    ->searchable(),

                Select::make('project_id')
                    ->default(null)
                    ->options(Projects::query()->pluck('name', 'id'))
                    ->getSearchResultsUsing(fn (string $search): array => Projects::query()
                        ->where('name', 'like', "%{$search}%")
                        ->limit(50)
                        ->pluck('name', 'id')
                        ->all())
                    ->getOptionLabelUsing(fn ($value): ?string => Projects::find($value)?->name)
                    ->searchable(),

                Toggle::make('status')
                    ->required(),

                TextInput::make('po_number')
                    ->default(null),

                Select::make('equipment_id')
                    ->options(Equipments::query()->pluck('name', 'id'))
                    ->getSearchResultsUsing(fn (string $search): array => Equipments::query()
                        ->where('name', 'like', "%{$search}%")
                        ->limit(50)
                        ->pluck('name', 'id')
                        ->all())
                    ->getOptionLabelUsing(fn ($value): ?string => Equipments::find($value)?->name)
                    ->searchable()
                    ->default(null),

                DatePicker::make('start_date'),

                DatePicker::make('end_date'),

                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
