<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait HasCreatedBy
{
    protected static array $createdByColumnCache = [];

    public static function bootHasCreatedBy(): void
    {
        static::creating(function ($model): void {
            if (! static::hasCreatedByColumn($model) || ! empty($model->created_by)) {
                return;
            }

            if (Auth::check()) {
                $model->forceFill(['created_by' => Auth::id()]);
            }
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function hasCreatedByColumn($model): bool
    {
        $table = $model->getTable();

        if (! array_key_exists($table, static::$createdByColumnCache)) {
            static::$createdByColumnCache[$table] = Schema::hasColumn($table, 'created_by');
        }

        return static::$createdByColumnCache[$table];
    }
}
