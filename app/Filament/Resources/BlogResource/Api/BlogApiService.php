<?php
namespace App\Filament\Resources\BlogResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\BlogResource;
use Illuminate\Routing\Router;


class BlogApiService extends ApiService
{
    protected static string | null $resource = BlogResource::class;

    public static function allRoutes(Router $router)
    {
        Handlers\CreateHandler::route($router);
        Handlers\UpdateHandler::route($router);
        Handlers\DeleteHandler::route($router);
        Handlers\PaginationHandler::route($router);
        Handlers\DetailHandler::route($router);
    }
}
