<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FilamentViewsDemo extends Command
{
    protected $signature = 'demo:filament';

    protected $description = 'Command description';

    public function handle(): void
    {
        $this->call('vendor:publish', ['--tag' => 'filament-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'filament-actions-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'filament-forms-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'filament-infolists-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'filament-notifications-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'filament-panels-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'filament-tables-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'filament-widgets-views', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'zeus-matrix-choice-views', '--force' => true]);

        $filamentViews = [
            resource_path('views/vendor/filament'),
            resource_path('views/vendor/filament-actions'),
            resource_path('views/vendor/filament-forms'),
            resource_path('views/vendor/filament-infolists'),
            resource_path('views/vendor/filament-notifications'),
            resource_path('views/vendor/filament-panels'),
            resource_path('views/vendor/filament-tables'),
            resource_path('views/vendor/filament-widgets'),
            resource_path('views/vendor/zeus-matrix-choice'),
        ];

        foreach ($filamentViews as $package) {
            $dir = File::allFiles($package);
            foreach ($dir as $view) {
                $file = file_get_contents($view);
                $str = str_replace('-primary-', '-custom-', $file);
                file_put_contents($view, $str);
            }
        }
    }
}
