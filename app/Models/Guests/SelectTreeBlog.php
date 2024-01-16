<?php

namespace App\Models\Guests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SelectTreeBlog extends Model
{
    protected $fillable = [
        'name',
        'category_id'
    ];

    public function categories(): belongsToMany
    {
        return $this->belongsToMany(SelectTreeCategory::class);
    }
}
