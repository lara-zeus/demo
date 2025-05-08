<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Pages\Page;

class Athena extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.clusters.components-demo.pages.athena';

    protected static ?string $cluster = ComponentsDemo::class;
}
