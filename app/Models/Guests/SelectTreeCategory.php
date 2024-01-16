<?php

namespace App\Models\Guests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SelectTreeCategory extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(SelectTreeCategory::class);
    }
}
