<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Clients;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('project_code')
                    ->default(null),
                Select::make('client_id')
                    ->label('Client')
                    ->options(Clients::query()->pluck('name', 'id'))
            ]);
    }
}
