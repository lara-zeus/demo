<?php

namespace App\Mason;
use Awcodes\Mason\Brick;
use Awcodes\Mason\EditorCommand;
use Awcodes\Mason\Mason;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;

class Section
{
    public static function make(): Brick
    {
        return Brick::make('section')
            ->label('Section')
            ->modalHeading('Section Settings')
            ->icon('heroicon-o-cube')
            ->slideOver()
            ->fillForm(fn (array $arguments): array => [
                'background_color' => $arguments['background_color'] ?? 'white',
                'text' => $arguments['text'] ?? null,
                'image' => $arguments['image'] ?? null,
            ])
            ->form([
                Radio::make('background_color')
                    ->options([
                        'bg-white-500' => 'White',
                        'bg-gray-500' => 'Gray',
                        'bg-primary-500' => 'Primary',
                    ])
                    ->inline()
                    ->inlineLabel(false),
                FileUpload::make('image'),
                RichEditor::make('text'),
            ])
            ->action(function (array $arguments, array $data, Mason $component) {
                $component->runCommands(
                    [
                        new EditorCommand(
                            name: 'setBrick',
                            arguments: [[
                                'identifier' => 'section',
                                'values' => $data,
                                'path' => 'mason.section',
                                'view' => view('mason.section', $data)->toHtml(),
                            ]],
                        ),
                    ],
                    editorSelection: $arguments['editorSelection'],
                );
            });
    }
}