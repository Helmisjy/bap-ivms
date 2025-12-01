<?php

namespace App\Filament\Resources\Equipments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Symfony\Contracts\Service\Attribute\Required;

class EquipmentsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('eq_number')
                    ->label('Equipment Number')
                    ->required(),

                TextInput::make('eq_code')
                    ->label('Equipment Code')
                    ->required(),

                Select::make('status')
                    ->options([
                        'Draft' => 'Draft',
                        'Ready' => 'Ready',
                        'Work'  => 'Work',
                    ])
                    ->default('Draft')
                    ->required(),
            ]);
    }
}
