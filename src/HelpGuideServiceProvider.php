<?php

namespace PaperLeaf\HelpGuide;

use Filament\Facades\Filament;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use PaperLeaf\HelpGuide\Commands\HelpGuideCommand;
use PaperLeaf\HelpGuide\Providers\HelpGuidePanelProvider;
use PaperLeaf\HelpGuide\Testing\TestsHelpGuide;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HelpGuideServiceProvider extends PackageServiceProvider
{
    public static string $name = 'help-guide';

    public static string $viewNamespace = 'help-guide';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('paper-leaf/help-guide');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
        // $this->app->registered(function () {
        //     if (collect(Filament::getPanels())->has('help-guide')) {
        //         return;
        //     }

            // Register the custom Help Guide panel
            $this->app->register(HelpGuidePanelProvider::class);
        // });
    }

    public function packageBooted(): void
    {
        // Filament::serving(function () {
        //     // Prevent double execution loops during login redirects
        //     if (! collect(Filament::getPanels())->has('help-guide')) {
        //         $this->app->register(HelpGuidePanelProvider::class);
        //         // Filament::registerPanel(
        //             // HelpGuidePanel::make()
        //         // );
        //     }
        // });

        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/help-guide/{$file->getFilename()}"),
                ], 'help-guide-stubs');
            }
        }

        // Points safely to your local package's database folder
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Testing
        Testable::mixin(new TestsHelpGuide);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'paper-leaf/help-guide';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('help-guide', __DIR__ . '/../resources/dist/components/help-guide.js'),
            // Css::make('help-guide-styles', __DIR__ . '/../resources/dist/help-guide.css'),
            // Js::make('help-guide-scripts', __DIR__ . '/../resources/dist/help-guide.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            HelpGuideCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_help_guide_tables',
        ];
    }
}
