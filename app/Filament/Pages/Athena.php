<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use BackedEnum;
use Filament\Pages\Page;

class Athena extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.clusters.components-demo.pages.athena';

    protected static ?string $cluster = ComponentsDemo::class;

    public static function canAccess(): bool
    {
        return false;
    }
}
