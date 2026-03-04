<?php

namespace App\Observers;

use App\Models\Audit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ModelAuditObserver
{
    private const HIDDEN_AUDIT_KEYS = [
        'remember_token',
    ];

    public function created(Model $model): void
    {
        $this->storeAudit($model, 'create', null, $this->filterSensitiveValues($model->getAttributes()));
    }

    public function updated(Model $model): void
    {
        $changes = $model->getChanges();

        if (empty($changes)) {
            return;
        }

        $oldValues = [];
        $original = $model->getOriginal();
        foreach (array_keys($changes) as $key) {
            $oldValues[$key] = $original[$key] ?? null;
        }

        $this->storeAudit(
            $model,
            'update',
            $this->filterSensitiveValues($oldValues),
            $this->filterSensitiveValues($changes)
        );
    }

    public function deleted(Model $model): void
    {
        $this->storeAudit($model, 'delete', $this->filterSensitiveValues($model->getOriginal()), null);
    }

    private function storeAudit(Model $model, string $event, ?array $oldValues, ?array $newValues): void
    {
        Audit::query()->create([
            'user_id' => Auth::id(),
            'event' => $event,
            'auditable_type' => $model::class,
            'auditable_id' => (int) $model->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }

    private function filterSensitiveValues(array $values): array
    {
        return collect($values)
            ->reject(function ($value, $key): bool {
                $normalizedKey = strtolower((string) $key);

                return str_contains($normalizedKey, 'password')
                    || in_array($normalizedKey, self::HIDDEN_AUDIT_KEYS, true);
            })
            ->all();
    }
}
