<?php

namespace App\Repositories;

use App\Enums\BooksTypes;
use App\Enums\SermonsTypes;
use App\Models\Setting;
use App\Models\Subject;

class SettingsRepository
{
    public function __construct(protected Setting $model) {}

    public function enums(): array
    {
        return [
            'years' => Subject::query()
                ->select('year')
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year'),
            'books_types' => BooksTypes::all(),
            'sermons_types' => SermonsTypes::all(),
            'sermons_playlist_types' => SermonsTypes::all(),
        ];
    }

    public function aboutUsShow(): ?Setting
    {
        return $this->model->first(['key' => 'about_us']);
    }
}
