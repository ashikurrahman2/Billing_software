<?php

namespace App\Filament\Resources\Bills\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('invoice_no')
                    ->required(),
                TextInput::make('customer_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                TextInput::make('vat')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('grand_total')
                    ->required()
                    ->numeric(),
                Select::make('payment_method')
                    ->options(['cash' => 'Cash', 'bkash' => 'Bkash', 'nagad' => 'Nagad', 'bank' => 'Bank', 'card' => 'Card'])
                    ->required(),
                Select::make('status')
                    ->options(['paid' => 'Paid', 'pending' => 'Pending', 'due' => 'Due'])
                    ->default('pending')
                    ->required(),
                Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }
}
