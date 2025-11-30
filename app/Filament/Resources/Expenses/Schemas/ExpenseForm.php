<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               TextInput::make('title')
                            ->label('খরচের শিরোনাম')
                            ->required()
                            ->maxLength(255),
               Textarea::make('description')
                            ->label('বিবরণ')
                            ->rows(3),
             TextInput::make('amount')
                            ->label('পরিমাণ (টাকা)')
                            ->numeric()
                            ->prefix('৳')
                            ->required()
                            ->rule('numeric'),
              DatePicker::make('date')
                            ->label('তারিখ')
                            ->default(today())
                            ->required(),
                Select::make('category')
                            ->label('ক্যাটাগরি')
                            ->options([
                                'food' => 'খাবার',
                                'transport' => 'যাতায়াত',
                                'shopping' => 'কেনাকাটা',
                                'bills' => 'বিল',
                                'entertainment' => 'বিনোদন',
                                'health' => 'স্বাস্থ্য',
                                'other' => 'অন্যান্য',
                            ])
                            ->searchable(),
                            
                // TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),
            ]);
            
    }
}
