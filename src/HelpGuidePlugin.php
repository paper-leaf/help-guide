<?php

namespace PaperLeaf\HelpGuide;

use Filament\Contracts\Plugin;
use Filament\Panel;

class HelpGuidePlugin implements Plugin
{
    public const ID = 'help-guide';

    protected ?string $login_url = '/admin/login';

    public function getId(): string
    {
        return static::ID;
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    /*************************************
     * CONFIGURATION
     *************************************/

    /**
     * Login URL
     */
    public function loginUrl(?string $login_url): static
    {
        $this->login_url = $login_url;

        return $this;
    }

    public function getloginUrl(): ?string
    {
        return value($this->login_url);
    }
}
