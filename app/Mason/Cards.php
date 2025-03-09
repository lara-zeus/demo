<?php

namespace App\Mason;

use Awcodes\Mason\Brick;
use Awcodes\Mason\EditorCommand;
use Awcodes\Mason\Mason;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\HtmlString;

class Cards
{
    public static function make(): Brick
    {
        return Brick::make('cards')
            ->label('Cards')
            ->modalHeading('Cards Settings')
            ->icon(new HtmlString('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M6.77 11.116V6.769h4.346v4.347zm0 6.115v-4.347h4.346v4.347zm6.115-6.116V6.77h4.346v4.347zm0 6.116v-4.347h4.346v4.347zM5.615 20q-.69 0-1.152-.462T4 18.384V5.616q0-.691.463-1.153T5.616 4h12.769q.69 0 1.153.463T20 5.616v12.769q0 .69-.462 1.153T18.384 20zm0-1h12.77q.23 0 .423-.192t.192-.424V5.616q0-.231-.192-.424T18.384 5H5.616q-.231 0-.424.192T5 5.616v12.769q0 .23.192.423t.423.192"/></svg>'))
            ->slideOver()
            ->fillForm(fn (array $arguments): array => [
                'background_color' => $arguments['background_color'] ?? 'white',
                'cards' => $arguments['cards'] ?? null,
            ])
            ->form([
                Radio::make('background_color')
                    ->options([
                        'white' => 'White',
                        'gray' => 'Gray',
                        'primary' => 'Primary',
                    ])
                    ->inline()
                    ->inlineLabel(false),
                Repeater::make('cards')
                    ->label('Cards')
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['heading'] ?? null)
                    ->schema([
                        TextInput::make('heading')
                            ->label('Heading')
                            ->live(onBlur: true)
                            ->columnSpanFull(),
                        RichEditor::make('body')
                            ->columnSpanFull()
                            ->required(),
                        RichEditor::make('footer')
                            ->columnSpanFull(),
                    ]),
            ])
            ->action(function (array $arguments, array $data, Mason $component) {
                $component->runCommands(
                    [
                        new EditorCommand(
                            name: 'setBrick',
                            arguments: [[
                                'identifier' => 'cards',
                                'values' => $data,
                                'path' => 'mason.cards',
                                'view' => view('mason.cards', $data)->toHtml(),
                            ]],
                        ),
                    ],
                    editorSelection: $arguments['editorSelection'],
                );
            });
    }
}
