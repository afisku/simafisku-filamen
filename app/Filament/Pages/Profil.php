<?php

namespace App\Filament\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

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
            Forms\Components\TextInput::make('name')
                ->autofocus()
                ->required(),
            Forms\Components\TextInput::make('email')
                ->required(),
        ])->columns(2)
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
