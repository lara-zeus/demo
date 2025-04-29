<?php

namespace App\Filament\Resources\Courses\Resources\Lessons\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->columnSpanFull(),
                RichEditor::make('desc')
                    ->columnSpanFull(),
            ]);
    }
}
