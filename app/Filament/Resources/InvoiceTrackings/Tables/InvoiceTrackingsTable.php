<?php

namespace App\Filament\Resources\InvoiceTrackings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoiceTrackingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_instructions.status')
                    ->sortable(),
                TextColumn::make('inv_number')
                    ->searchable(),

                TextColumn::make('aging_days')
                    ->numeric()
                    ->formatStateUsing(fn ($state) => ($state >= 0 ? '+' : '') . $state . ' days') // optional + sign
                    ->sortable(),

                TextColumn::make('aging_status')
                    ->badge()
                    ->searchable()
                    ->colors([
                        'success' => ['early'],
                        'warning' => ['warning'],
                        'orange'  => ['overdue'],
                        'danger'  => ['critical'],
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('payment_status')
                    ->searchable(),

                TextColumn::make('amount')
                    ->prefix('IDR ')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('risk_level')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'Low' => 'success',
                        'Medium' => 'warning',
                        'High' => 'primary',
                        'Critical' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),

                TextColumn::make('inv_target')
                    ->date()
                    ->sortable(),

                TextColumn::make('inv_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('inv_delivery')
                    ->date()
                    ->sortable(),

                TextColumn::make('payment_due_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('collection_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('payment_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
            
    }
}
