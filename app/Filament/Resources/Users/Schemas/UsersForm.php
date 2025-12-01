<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MultiSelect;
use Filament\Schemas\Schema;

class UsersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
             ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                     TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->required(),
                      TextInput::make('business_name')
                    ->label('Business Name')
                    ->required(),
                         TextInput::make('address')
                    ->label('Address')
                    ->required(),
                    MultiSelect::make('roles')
                    ->relationship('roles', 'name')
                    ->preload(),
                      TextInput::make('password')
                    ->password()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
            ]);
    }
}
