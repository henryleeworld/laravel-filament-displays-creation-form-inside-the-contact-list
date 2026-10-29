<?php

namespace App\Filament\Resources\Contacts\Schemas;

use App\Models\Contact;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->label(__('First name'))
                    ->maxLength(255)
                    ->required(),
                TextInput::make('last_name')
                    ->label(__('Last name'))
                    ->maxLength(255)
                    ->required(),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->maxLength(255)
                    ->email()
                    ->unique(Contact::class, 'email', ignoreRecord: true)
                    ->required(),
            ]);
    }
}
