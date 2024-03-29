<?php

namespace App\Providers\Filament;

use Awcodes\FilamentVersions\Providers\Contracts\VersionProvider;

class MyCustomVersionProvider implements VersionProvider
{
    public function getName(): string
    {
        return 'Zeus Core';
    }

    public function getVersion(): string
    {
        return \Composer\InstalledVersions::getPrettyVersion('lara-zeus/core');
    }
}
