<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                   ->label('নাম')
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                ->label('মোবাইল')
                    ->unique(ignoreRecord: true)
                    ->tel()
                    ->required(),
                Textarea::make('address')
                 ->label('ঠিকানা')
                    ->rows(3),
                TextInput::make('total_billed')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_paid')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('due_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
