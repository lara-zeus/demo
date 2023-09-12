<?php

namespace App\Models;

use BezhanSalleh\FilamentShield\Traits\HasFilamentShield;
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
    use HasFilamentShield;
    use ManageOffice;
    use Notifiable;

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
            get: fn () => $this->getFilamentAvatarUrl(),
        );
    }

    public function canImpersonate()
    {
        return $this->id === 1;
    }

    public function canBeImpersonated()
    {
        return $this->id !== 1;
    }
}
