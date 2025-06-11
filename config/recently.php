<?php

use App\Models\User;

// config for Awcodes/Recently
return [
    'user_model' => User::class,
    'max_items' => 20,
    'width' => 'xs',
    'global_search' => true,
    'menu' => true,
    'icon' => 'heroicon-o-arrow-uturn-left',
];
