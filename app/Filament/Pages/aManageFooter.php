<?php

namespace App\Filament\Pages;

use App\Settings\FooterSettings;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageFooter extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-m-cog';
    protected static ?string $navigationLabel = 'تظیمات';
    // protected static ?int $navigationSort = 9;

    protected static string $settings = FooterSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('copyright')
                    ->label('Copyright notice')
                    ->required(),
                Repeater::make('links')
                    ->schema([
                        TextInput::make('label')->required(),
                        TextInput::make('url')
                            ->url()
                            ->required(),
                    ]),
            ]);
    }
}
