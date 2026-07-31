<?php

namespace PaperLeaf\HelpGuide\Services;

use Filament\Facades\Filament;
use PaperLeaf\HelpGuide\HelpGuidePlugin;

class PermissionsService
{
    public $plugin;

    public $user;

    public function __construct()
    {
        $this->plugin = Filament::getDefaultPanel()->getPlugin(HelpGuidePlugin::ID);
        $this->user = Filament::auth()->user();
    }

    /**
     * Check if the current user has permission to edit the guide
     *
     * @return bool
     */
    public function canManageGuide()
    {
        $edit_permission = $this->plugin->getManageGuidePermission();

        return $this->user->can($edit_permission);
    }

    /**
     * Get the list of permission options
     *
     * @return array
     */
    public function permissionsList()
    {
        return $this->plugin->getAvailablePermissions();
    }

    /**
     * Check if a user has any of an array of permissions
     * 
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermissions($permissions)
    {
        return $this->user->canAny($permissions);
    }
}
