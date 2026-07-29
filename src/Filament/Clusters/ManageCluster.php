<?php

namespace PaperLeaf\HelpGuide\Filament\Clusters;

use Filament\Clusters\Cluster;

class ManageCluster extends Cluster
{
    protected static ?int $navigationSort = 1;

    // protected static string | \UnitEnum | null $navigationGroup = 'Settings and Permissions';
    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Guide Management';
}
