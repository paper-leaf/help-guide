<?php

namespace PaperLeaf\HelpGuide\Filament\Clusters;

use Filament\Clusters\Cluster;
use PaperLeaf\HelpGuide\Services\PermissionsService;

class ManageCluster extends Cluster
{
    protected static ?int $navigationSort = 1;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Guide Management';

    protected static ?string $clusterBreadcrumb = 'Guide Management';

    public static function canAccess(): bool
    {
        $service = new PermissionsService;

        return $service->canManageGuide();
    }
}
