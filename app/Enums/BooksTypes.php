<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;
use InvalidArgumentException;

class BooksTypes
{
    public const HISTORICAL = 1;

    public const PRODUCED = 2;

    public const ARTICAL = 3;

    private static array $translations = [
        self::HISTORICAL => [
            'en' => 'Historical',
            'ar' => 'تاريخية',
        ],
        self::PRODUCED => [
            'en' => 'Produced',
            'ar' => 'اصدارات المركز',
        ],
        self::ARTICAL => [
            'en' => 'Artical',
            'ar' => 'مقالات',
        ],
    ];

    public static function all(): array
    {
        $locale = App::isLocale('ar') ? 'ar' : 'en';

        return array_map(
            fn ($value) => [
                'name' => self::$translations[$value][$locale],
                'value' => $value,
            ],
            array_keys(self::$translations)
        );
    }

    public static function getStringValue(int $value): string
    {
        if (! isset(self::$translations[$value])) {
            throw new InvalidArgumentException("Invalid books type value: {$value}");
        }

        return self::$translations[$value][App::isLocale('ar') ? 'ar' : 'en'];
    }

    public static function getValues(): array
    {
        return array_keys(self::$translations);
    }
}
