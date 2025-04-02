<?php

namespace App\Mason;

use Awcodes\Mason\Brick;
use Awcodes\Mason\EditorCommand;
use Awcodes\Mason\Mason;
use Filament\Forms\Components\Radio;
use Illuminate\Support\HtmlString;

class Batman
{
    public static function make(): Brick
    {
        return Brick::make('batman')
            ->label('Batman')
            ->modalHeading('Batman Settings')
            ->icon(new HtmlString('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12.525 16q.95 0 1.863-.4t1.587-1.2q.175-.2.075-.45t-.35-.3q-.95-.15-1.8-.713t-1.375-1.487q-.5-.875-.587-1.887T12.2 7.6q.1-.25-.062-.45T11.7 7q-1.725.325-2.725 1.625t-1 2.875q0 1.875 1.338 3.188T12.525 16M12 22q-3.475-.875-5.738-3.988T4 11.1V5l8-3l8 3v6.1q0 3.8-2.262 6.913T12 22m0-2.1q2.6-.825 4.3-3.3t1.7-5.5V6.375l-6-2.25l-6 2.25V11.1q0 3.025 1.7 5.5t4.3 3.3m0-7.9"/></svg>'))
            ->slideOver()
            ->fillForm(fn (array $arguments): array => [
                'name' => 'Batman',
                'color' => 'black',
                'side' => 'hero',
            ])
            ->form([
                Radio::make('name')
                    ->options([
                        'Batman' => 'Batman',
                        'Robin' => 'Robin',
                        'Joker' => 'Joker',
                        'Poison Ivy' => 'Poison Ivy',
                        'Harley Quinn' => 'Harley Quinn',
                    ])
                    ->inline()
                    ->inlineLabel(false),
                Radio::make('color')
                    ->options([
                        'black' => 'black',
                        'yellow' => 'yellow',
                        'purple' => 'purple',
                        'green' => 'green',
                        'red' => 'red',
                    ])
                    ->inline()
                    ->inlineLabel(false),
                Radio::make('side')
                    ->options([
                        'hero' => 'Hero',
                        'villain' => 'Villain',
                    ])
                    ->inline()
                    ->inlineLabel(false),
            ])
            ->action(function (array $arguments, array $data, Mason $component) {
                $component->runCommands(
                    [
                        new EditorCommand(
                            name: 'setBrick',
                            arguments: [[
                                'identifier' => 'batman',
                                'path' => 'mason.batman',
                                'values' => [
                                    'name' => $data['name'],
                                    'color' => $data['color'],
                                    'side' => $data['side'],
                                ],
                                'view' => view('mason.batman', $data)->toHtml(),
                            ]],
                        ),
                    ],
                    editorSelection: $arguments['editorSelection'],
                );
            });
    }
}
