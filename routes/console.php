<?php

use Illuminate\Support\Facades\Schedule;


Schedule::command('migrate:fresh --seed --force --quiet')
    ->daily()
    ->at('4:00');

Schedule::command('php artisan seo:scan --quiet')
    ->weekly()
    ->at('5:00');
