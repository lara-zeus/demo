<?php

namespace App\Filament\Guests\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\IconSize;

class RadioDeck extends Page
{
    protected static string $view = 'filament.guests.pages.radio-deck';

    protected static ?string $navigationIcon = 'tabler-aspect-ratio';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Plugins';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                \JaOcero\RadioDeck\Forms\Components\RadioDeck::make('select-os-1')
                    ->label('Select OS')
                    ->options([
                        'ios' => 'iOS',
                        'android' => 'Android',
                        'web' => 'Web',
                        'windows' => 'Windows',
                        'mac' => 'Mac',
                        'linux' => 'Linux',
                    ])
                    ->descriptions([
                        'ios' => 'iOS Mobile App',
                        'android' => 'Android Mobile App',
                        'web' => 'Web App',
                        'windows' => 'Windows Desktop App',
                        'mac' => 'Mac Desktop App',
                        'linux' => 'Linux Desktop App',
                    ])
                    ->icons([
                        'ios' => 'heroicon-m-device-phone-mobile',
                        'android' => 'heroicon-m-device-phone-mobile',
                        'web' => 'heroicon-m-globe-alt',
                        'windows' => 'heroicon-m-computer-desktop',
                        'mac' => 'heroicon-m-computer-desktop',
                        'linux' => 'heroicon-m-computer-desktop',
                    ])
                    ->required()
                    ->iconSize(IconSize::Large) // Small | Medium | Large | (string - sm | md | lg)
                    ->iconPosition(IconPosition::Before) // Before | After | (string - before | after)
                    ->alignment(Alignment::Center) // Start | Center | End | (string - start | center | end)
                    ->color('primary') // supports all color custom or not
                    ->columns(3),

                \JaOcero\RadioDeck\Forms\Components\RadioDeck::make('select-os-2')
                    ->label('custom color')
                    ->options([
                        'ios' => 'iOS',
                        'android' => 'Android',
                        'web' => 'Web',
                        'windows' => 'Windows',
                        'mac' => 'Mac',
                        'linux' => 'Linux',
                    ])
                    ->descriptions([
                        'ios' => 'iOS Mobile App',
                        'android' => 'Android Mobile App',
                        'web' => 'Web App',
                        'windows' => 'Windows Desktop App',
                        'mac' => 'Mac Desktop App',
                        'linux' => 'Linux Desktop App',
                    ])
                    ->icons([
                        'ios' => 'heroicon-m-device-phone-mobile',
                        'android' => 'heroicon-m-device-phone-mobile',
                        'web' => 'heroicon-m-globe-alt',
                        'windows' => 'heroicon-m-computer-desktop',
                        'mac' => 'heroicon-m-computer-desktop',
                        'linux' => 'heroicon-m-computer-desktop',
                    ])
                    ->required()
                    ->iconSize(IconSize::Large) // Small | Medium | Large | (string - sm | md | lg)
                    ->iconPosition(IconPosition::Before) // Before | After | (string - before | after)
                    ->alignment(Alignment::End) // Start | Center | End | (string - start | center | end)
                    ->color(Color::hex('#45B39D'))
                    ->columns(3),

                \JaOcero\RadioDeck\Forms\Components\RadioDeck::make('select-os-3')
                    ->label('custom icon size and alignment')
                    ->options([
                        'ios' => 'iOS',
                        'android' => 'Android',
                        'web' => 'Web',
                        'windows' => 'Windows',
                        'mac' => 'Mac',
                        'linux' => 'Linux',
                    ])
                    ->descriptions([
                        'ios' => 'iOS Mobile App',
                        'android' => 'Android Mobile App',
                        'web' => 'Web App',
                        'windows' => 'Windows Desktop App',
                        'mac' => 'Mac Desktop App',
                        'linux' => 'Linux Desktop App',
                    ])
                    ->icons([
                        'ios' => 'heroicon-m-device-phone-mobile',
                        'android' => 'heroicon-m-device-phone-mobile',
                        'web' => 'heroicon-m-globe-alt',
                        'windows' => 'heroicon-m-computer-desktop',
                        'mac' => 'heroicon-m-computer-desktop',
                        'linux' => 'heroicon-m-computer-desktop',
                    ])
                    ->required()
                    ->iconSize(IconSize::Small) // Small | Medium | Large | (string - sm | md | lg)
                    ->iconPosition(IconPosition::After) // Before | After | (string - before | after)
                    ->alignment(Alignment::End) // Start | Center | End | (string - start | center | end)
                    ->color(Color::hex('#F1948A'))
                    ->columns(3),
            ]);
    }
}
