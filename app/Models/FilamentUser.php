<?php

namespace App\Models;

use Archilex\AdvancedTables\Concerns\HasViews;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LaraZeus\Athena\Models\Concerns\BelongToAthena;
use LaraZeus\Bolt\Models\Concerns\BelongToBolt;
use LaraZeus\Boredom\Concerns\HasBoringAvatar;
use LaraZeus\Thunder\Concerns\ManageOffice;

class FilamentUser extends Authenticatable implements \Filament\Models\Contracts\FilamentUser
{
    use BelongToAthena;
    use BelongToBolt;
    use HasApiTokens;
    use HasBoringAvatar;
    use HasViews;
    use ManageOffice;
    use Notifiable;

    protected $table = 'users';

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function isSuperAdmin(): bool
    {
        return true;

        return str_ends_with($this->email, '@larazeus.com');
    }
}
