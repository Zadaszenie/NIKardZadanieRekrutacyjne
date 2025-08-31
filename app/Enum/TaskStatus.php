<?php

namespace App\Enum;

enum TaskStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Done = 'done';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return string[]
     */
    public static function labels(): array
    {
        return [
            self::New->value => 'Nowe',
            self::InProgress->value => 'W toku',
            self::Done->value => 'Zakończone',
        ];
    }
}
