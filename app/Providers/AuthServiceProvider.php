<?php

namespace App\Providers;

use App\Policies\CategoryPolicy;
use App\Policies\CollectionPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\FaqPolicy;
use App\Policies\FormPolicy;
use App\Policies\LayoutPolicy;
use App\Policies\LetterPolicy;
use App\Policies\LibraryPolicy;
use App\Policies\NavigationPolicy;
use App\Policies\OfficePolicy;
use App\Policies\OperationsPolicy;
use App\Policies\PostPolicy;
use App\Policies\ResponsePolicy;
use App\Policies\RolePolicy;
use App\Policies\TagPolicy;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaraZeus\Bolt\Models\Category;
use LaraZeus\Bolt\Models\Collection;
use LaraZeus\Bolt\Models\Form;
use LaraZeus\Bolt\Models\Response;
use LaraZeus\Rain\Models\Layout;
use LaraZeus\Sky\Models\Faq;
use LaraZeus\Sky\Models\Library;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
use LaraZeus\Thunder\Models\Office;
use LaraZeus\Thunder\Models\Operations;
use LaraZeus\Thunder\Models\Ticket;
use LaraZeus\Wind\Models\Department;
use LaraZeus\Wind\Models\Letter;
use RyanChandler\FilamentNavigation\Models\Navigation;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
       //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
