<?php

namespace App\Mason;

use Awcodes\Mason\Brick;
use Awcodes\Mason\EditorCommand;
use Awcodes\Mason\Mason;

class SupportCenter
{
    public static function make(): Brick
    {
        return Brick::make('supportCenter')
            ->label('Support center')
            ->icon('heroicon-o-lifebuoy')
            ->action(function (array $arguments, Mason $component) {
                $component->runCommands(
                    [
                        new EditorCommand(
                            name: 'setBrick',
                            arguments: [[
                                'identifier' => 'supportCenter',
                                'values' => null,
                                'path' => 'mason.support-center',
                                'view' => view('mason.support-center')->toHtml(),
                            ]],
                        ),
                    ],
                    editorSelection: $arguments['editorSelection'],
                );
            });
    }
}
