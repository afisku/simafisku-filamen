<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class Profil extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.profil';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];
 
    public function mount(): void
    {
        $this->form->fill(
            auth()->user()->attributesToArray()
        );
    }

    public function form(Form $form): Form
{
    return $form
        ->schema([
            Section::make('User')
            ->description('Prevent abuse by limiting the number of requests per period')
            ->schema([
                TextInput::make('name')
                ->autofocus()
                ->required(),
                TextInput::make('email')
                ->required(),
                TextInput::make('password')
                ->password()
                ->maxLength(255)
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),
            ])->columns(2)
            ])
            ->statePath('data')
        ->model(auth()->user());
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('Update')
                ->color('primary')
                ->submit('update'),
        ];
    }
 
    public function update()
    {
        auth()->user()->update(
            $this->form->getState()
        );

        Notification::make()
            ->title('Profil berhasil diubah!')
            ->success()
            ->send();
    }
}
