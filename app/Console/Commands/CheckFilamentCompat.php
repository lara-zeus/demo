<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

/**
 * Credit: https://gist.github.com/CharlieEtienne/18957d7bb28735ab3872027de2043355
 */
class CheckFilamentCompat extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'zeus:plugins-check';

    /**
     * The console command description.
     */
    protected $description = 'Check if installed Filament plugins are compatible with Filament v4';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $composerPath = base_path('composer.json');

        if (!file_exists($composerPath)) {
            $this->error('composer.json not found.');
            return 1;
        }

        $composer = json_decode(file_get_contents($composerPath), true);
        $dependencies = $composer['require'] ?? [];

        $allPackages = collect($dependencies)->keys();

        // Filter packages to only those that require filament/filament
        $filamentPlugins = $allPackages->filter(function ($package) {
            return $this->packageRequiresFilament($package);
        });

        $this->info("Found " . $filamentPlugins->count() . " packages that require filament/filament");

        $results = [];

        foreach ($filamentPlugins as $package) {
            $compatibility = $this->checkFilamentV4Compatibility($package);
            $versionDisplay = '–';

            if ($compatibility !== null) {
                $versionDisplay = $compatibility['version'];
                if ($compatibility['isPrerelease']) {
                    $versionDisplay .= ' (prerelease)';
                }
            }

            if(!$compatibility) {
                $results[] = [
                    'package' => $package,
                    'installed' => $dependencies[$package],
                    'compatible' => $compatibility ? '✅' : '❌',
                    'latest_v4_version' => $versionDisplay,
                ];
            }
        }

        // Display result in a formatted table
        $this->table(
            ['Package', 'Installed Version', 'Compatible with v4?', 'Latest Compatible v4 Version'],
            $results
        );

        return 0;
    }

    /**
     * Checks on Packagist whether the given package has any version compatible with Filament v4.
     *
     * @param string $package The full package name (e.g. vendor/package)
     * @return array|null Array with version string and isPrerelease flag, or null if not found
     */
    protected function checkFilamentV4Compatibility(string $package): ?array
    {
        // First check regular releases
        $url = "https://repo.packagist.org/p2/{$package}.json";
        $compatibleVersion = $this->checkPackageCompatibility($package, $url);

        if ($compatibleVersion !== null) {
            return [
                'version' => $compatibleVersion,
                'isPrerelease' => false
            ];
        }

        // If no compatible version found, check dev versions
        $devUrl = "https://repo.packagist.org/p2/{$package}~dev.json";
        $compatibleVersion = $this->checkPackageCompatibility($package, $devUrl);

        if ($compatibleVersion !== null) {
            return [
                'version' => $compatibleVersion,
                'isPrerelease' => true
            ];
        }

        return null;
    }

    /**
     * Checks a specific package URL for Filament v4 compatibility
     *
     * @param string $package The full package name
     * @param string $url The Packagist API URL to check
     * @return string|null The compatible version string or null if not found
     */
    protected function checkPackageCompatibility(string $package, string $url): ?string
    {
        try {
            $response = Http::get($url);

            if (!$response->ok()) {
                return null;
            }

            $data = $response->json();
            $versions = $data['packages'][$package] ?? [];

            foreach ($versions as $version) {
                $requires = $version['require'] ?? [];

                if (isset($requires['filament/filament'])) {
                    $constraint = $requires['filament/filament'];

                    // Match common constraint patterns for v4
                    if (preg_match('/\^4\.|~4\.|>=4\./', $constraint)) {
                        return $version['version'];
                    }
                }
            }

        } catch (\Exception $e) {
            $this->error("Error checking {$package} at {$url}: " . $e->getMessage());
        }

        return null;
    }

    /**
     * Checks if a package requires filament/filament
     *
     * @param string $package The full package name
     * @return bool True if the package requires filament/filament
     */
    protected function packageRequiresFilament(string $package): bool
    {
        // Skip filament/filament itself
        if ($package === 'filament/filament') {
            return true;
        }

        // Skip filament/* packages as they're part of the Filament ecosystem
        if (str_starts_with($package, 'filament/')) {
            return true;
        }

        try {
            // Check regular releases
            $url = "https://repo.packagist.org/p2/{$package}.json";
            $response = Http::get($url);

            if ($response->ok()) {
                $data = $response->json();
                $versions = $data['packages'][$package] ?? [];

                // Check all versions, not just the latest
                foreach ($versions as $version) {
                    $requires = $version['require'] ?? [];

                    if (isset($requires['filament/filament'])) {
                        return true;
                    }
                }
            }

            // If not found in regular releases, check dev versions
            $devUrl = "https://repo.packagist.org/p2/{$package}~dev.json";
            $devResponse = Http::get($devUrl);

            if ($devResponse->ok()) {
                $devData = $devResponse->json();
                $devVersions = $devData['packages'][$package] ?? [];

                foreach ($devVersions as $version) {
                    $requires = $version['require'] ?? [];

                    if (isset($requires['filament/filament'])) {
                        return true;
                    }
                }
            }
        } catch (\Exception $e) {
            $this->error("Error checking if {$package} requires filament/filament: " . $e->getMessage());
        }

        return false;
    }
}
