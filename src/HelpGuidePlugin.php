<?php

namespace PaperLeaf\HelpGuide;

use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use PaperLeaf\HelpGuide\Filament\Resources\HelpPages\HelpPagesResource;

class HelpGuidePlugin implements Plugin
{
    use EvaluatesClosures;

    public const ID = 'help-guide';

    protected ?string $login_url = '/admin/login';

    protected $manage_guide_permission = '';

    protected $available_permissions = [];

    public function getId(): string
    {
        return static::ID;
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            HelpPagesResource::class,
        ]);
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

    /**
     * Setting the permission of when the guide can be edited
     */
    public function manageGuidePermission(string | Closure | null $manage_guide_permission): static
    {
        $this->manage_guide_permission = $manage_guide_permission;

        return $this;
    }

    public function getManageGuidePermission(): ?string
    {
        return $this->evaluate($this->manage_guide_permission);
    }

    /**
     * Setting the list of Permissions that are in the system
     * These must be connected to the Gates in the base system
     */
    public function availablePermissions(bool | Closure | null $available_permissions): static
    {
        $this->available_permissions = $available_permissions;

        return $this;
    }

    public function getavailablePermissions(): ?bool
    {
        return $this->evaluate($this->available_permissions);
    }
}
