<?php

namespace App\Filament\Resources\Contacts\Widgets;

use App\Models\Contact;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Widgets\Widget;

class CreateContactWidget extends Widget implements HasSchemas
{
    use InteractsWithSchemas;

    /**
     * @var view-string
     */
    protected string $view = 'filament.app.widgets.resources.views.create-contact-widget';

    protected int|string|array $columnSpan = 'full';

    public ?array $data = [];

    public function create(): void
    {
        Contact::create($this->form->getState());
        $this->form->fill();
        $this->dispatch('contact-created');
    }

    public function form(Schema $schema): Schema
    {
        return  $schema
            ->components([
                TextInput::make('first_name')
                    ->label(__('First name'))
                    ->required(),
                TextInput::make('last_name')
                    ->label(__('Last name'))
                    ->required(),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->required(),
            ])
            ->statePath('data');
    }

    public function mount(): void
    {
        $this->form->fill();
    }
}
