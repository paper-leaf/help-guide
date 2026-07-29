<?php

namespace PaperLeaf\HelpGuide\Models\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasColor, HasLabel
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::PUBLISHED => 'success',
        };
    }
}
