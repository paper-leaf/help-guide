<?php

namespace PaperLeaf\HelpGuide\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PaperLeaf\HelpGuide\HelpGuide
 */
class HelpGuide extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \PaperLeaf\HelpGuide\HelpGuide::class;
    }
}
