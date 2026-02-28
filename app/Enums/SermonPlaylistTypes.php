<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;
use InvalidArgumentException;

class SermonPlaylistTypes
{
    public const TRIPS = 1;
    public const HISTORICAL = 2;

    private static array $translations = [
        self::TRIPS => [
            'en' => 'Trips',
            'ar' => 'رحلات',
        ],
        self::HISTORICAL => [
            'en' => 'Historical',
            'ar' =>  'تاريخي',
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
            throw new InvalidArgumentException("Invalid listing type value: {$value}");
        }

        return self::$translations[$value][App::isLocale('ar') ? 'ar' : 'en'];
    }

    public static function getValues(): array
    {
        return array_keys(self::$translations);
    }
}
