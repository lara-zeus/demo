<?php

namespace App\Models;

use Archilex\AdvancedTables\Concerns\HasViews;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LaraZeus\Athena\Models\Concerns\BelongToAthena;
use LaraZeus\Bolt\Models\Concerns\BelongToBolt;
use LaraZeus\Boredom\Concerns\HasBoringAvatar;
use LaraZeus\Thunder\Concerns\ManageOffice;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use BelongToAthena;
    use BelongToBolt;
    use HasApiTokens;
    use HasBoringAvatar;
    use HasFactory;
    use HasViews;
    use ManageOffice;
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'options' => 'array',
        'options_two' => 'array',
        'qr_code' => 'array',
    ];

    public function isSuperAdmin(): bool
    {
        return str_ends_with($this->email, '@larazeus.com');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->avatar_url
        );
    }

    public function canImpersonate(): bool
    {
        return $this->id === 1;
    }

    public function canBeImpersonated(): bool
    {
        return $this->id !== 1;
    }

    public function isServicesManager(): bool
    {
        return $this->email === 'info@larazeus.com';
    }
}
