<?php

namespace App\Filament\Resources\ContactResource\Widgets;

use App\Models\Contact;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class CreateContactWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.resources.contact-resource.widgets.create-contact-widget';

    protected int | string | array $columnSpan = 'full';

    public ?array $data = [];

    public function create(): void
    {
        Contact::create($this->form->getState());
        $this->form->fill();
        $this->dispatch('contact-created');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
