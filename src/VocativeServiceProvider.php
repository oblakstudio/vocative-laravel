<?php

namespace Oblak\Vocative;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Oblak\Vocative\Commands\VocativeCommand;

class VocativeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('vocative')
            ->hasConfigFile();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function packageRegistered(): void
    {
        $this->app->singleton('vocative', function ($app) {
            $config = $app['config']->get('vocative', []);

            // Create a custom dictionary with config entries
            $dictionary = new ConfigDictionary($config['dictionary'] ?? []);

            // Create the vocative instance
            $vocative = new \Oblak\Vocative\Vocative($dictionary);

            return $vocative;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function packageBooted(): void
    {
        // Register blade directive @vocative
        Blade::directive('vocative', function ($expression) {
            return "<?php echo app('vocative')->make($expression, config('vocative.ignore_dictionary', false)); ?>";
        });

        // Register blade directive @voc as alias
        Blade::directive('voc', function ($expression) {
            return "<?php echo app('vocative')->make($expression, config('vocative.ignore_dictionary', false)); ?>";
        });
    }
}
