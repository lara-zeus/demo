<?php

namespace App\Mason;

use Awcodes\Mason\Brick;
use Awcodes\Mason\EditorCommand;
use Awcodes\Mason\Mason;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Wiebenieuwenhuis\FilamentCodeEditor\Components\CodeEditor;

class Code
{
    public static function make(): Brick
    {
        return Brick::make('code')
            ->label('Code')
            ->modalHeading('Code Settings')
            ->icon('heroicon-o-cube-transparent')
            ->slideOver()
            ->fillForm(fn (array $arguments): array => [
                'language' => $arguments['language'] ?? null,
                'code' => $arguments['code'] ?? null,
            ])
            ->form([
                Select::make('language')
                    ->searchable()
                    ->options([
                        'php' => 'php',
                        'html' => 'html',
                        'js' => 'javascript',
                    ]),
                CodeEditor::make('code')
                    ->dehydrateStateUsing(fn (string $state): string => htmlspecialchars($state)),
            ])
            ->action(function (array $arguments, array $data, Mason $component) {
                $component->runCommands(
                    [
                        new EditorCommand(
                            name: 'setBrick',
                            arguments: [[
                                'identifier' => 'code',
                                'values' => $data,
                                'path' => 'mason.code',
                                'view' => view('mason.code', $data)->toHtml(),
                            ]],
                        ),
                    ],
                    editorSelection: $arguments['editorSelection'],
                );
            });
    }
}
