<?php

namespace App\Filament\Resources\Bills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_no')
                    ->searchable(),
                TextColumn::make('customer_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('subtotal')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('vat')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('discount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('grand_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->badge(),
                TextColumn::make('status')
                    ->badge(),
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
