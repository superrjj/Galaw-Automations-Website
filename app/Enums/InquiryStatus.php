<?php

namespace App\Enums;

enum InquiryStatus: string
{
    case New = 'new';
    case Reviewing = 'reviewing';
    case Contacted = 'contacted';
    case Quoted = 'quoted';
    case Completed = 'completed';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Reviewing => 'Reviewing',
            self::Contacted => 'Contacted',
            self::Quoted => 'Quoted',
            self::Completed => 'Completed',
            self::Rejected => 'Rejected',
        };
    }

    public function isActive(): bool
    {
        return in_array($this, [
            self::New,
            self::Reviewing,
            self::Contacted,
            self::Quoted,
        ], true);
    }
}
