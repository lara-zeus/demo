<?php

namespace App\Filament\Resources\ResponseResource\Pages;

use App\Filament\Resources\ResponseResource;
use Filament\Resources\Pages\Page;

class BrowseResponses extends Page
{
    protected static string $resource = ResponseResource::class;

    protected static string $view = 'filament.resources.response-resource.pages.browse-responses';
}
