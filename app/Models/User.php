<?php

namespace App\Models;

use Archilex\AdvancedTables\Concerns\HasViews;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use LaraZeus\Thunder\Concerns\ManageOffice;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use ManageOffice;
    use Notifiable;
    use HasViews;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => 'https://ui-avatars.com/api/?name=' . urlencode($this->email ?? 'Guest') . '&color=FFFFFF&background=000000',
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
}
