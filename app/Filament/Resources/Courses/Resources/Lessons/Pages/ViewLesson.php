<?php

namespace App\Filament\Resources\Courses\Resources\Lessons\Pages;

use App\Filament\Resources\Courses\Resources\Lessons\LessonResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLesson extends ViewRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
