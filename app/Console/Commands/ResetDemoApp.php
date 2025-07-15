<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ResetDemoApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zeus:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset database and storage folder';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // $this->call('down');

        $this->resetStorage();
        $this->resetDatabase();

        // $this->call('up');
    }

    public function resetStorage(): void
    {
        $storage = Storage::disk('public');

        foreach ($storage->files('', true) as $file) {
            if ($file !== '.gitignore') {
                $storage->delete($file);
            }
        }

        foreach ($storage->allDirectories() as $directory) {
            $storage->deleteDirectory($directory);
        }
    }

    public function resetDatabase(): void
    {
        $this->call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
            '--quiet' => true,
        ]);
    }
}
