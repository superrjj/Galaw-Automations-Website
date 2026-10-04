<?php

namespace App\Enums;

enum TechnologyCategory: string
{
    case Frontend = 'frontend';
    case Backend = 'backend';
    case Mobile = 'mobile';
    case Database = 'database';
    case Ai = 'ai';
    case Infrastructure = 'infrastructure';

    public function label(): string
    {
        return match ($this) {
            self::Frontend => 'Frontend',
            self::Backend => 'Backend',
            self::Mobile => 'Mobile',
            self::Database => 'Database',
            self::Ai => 'AI',
            self::Infrastructure => 'Infrastructure',
        };
    }
}
