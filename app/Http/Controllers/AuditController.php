<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditController extends Controller
{
    private const HIDDEN_CHANGE_KEYS = [
        'remember_token',
    ];

    public function index(Request $request): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));
        $filters = [
            'event' => (string) $request->query('event', ''),
            'auditable_type' => (string) $request->query('auditable_type', ''),
            'user_id' => (int) $request->integer('user_id', 0),
            'from_date' => (string) $request->query('from_date', ''),
            'to_date' => (string) $request->query('to_date', ''),
        ];

        $query = Audit::query()
            ->with(['user:id,name', 'creator:id,name'])
            ->latest('id');

        if ($filters['event'] !== '') {
            $query->where('event', $filters['event']);
        }

        if ($filters['auditable_type'] !== '') {
            $query->where('auditable_type', $filters['auditable_type']);
        }

        if ($filters['user_id'] > 0) {
            $query->where('user_id', $filters['user_id']);
        }

        if ($filters['from_date'] !== '') {
            $query->whereDate('created_at', '>=', $filters['from_date']);
        }

        if ($filters['to_date'] !== '') {
            $query->whereDate('created_at', '<=', $filters['to_date']);
        }

        $audits = $query->paginate($perPage)->appends($request->query());

        $eventOptions = Audit::query()
            ->select('event')
            ->distinct()
            ->orderBy('event')
            ->pluck('event')
            ->values();

        $typeOptions = Audit::query()
            ->select('auditable_type')
            ->distinct()
            ->orderBy('auditable_type')
            ->pluck('auditable_type')
            ->values();

        $userOptions = Audit::query()
            ->with('user:id,name')
            ->whereNotNull('user_id')
            ->get()
            ->pluck('user')
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();

        return view('audits.index', [
            'audits' => $audits,
            'filters' => $filters,
            'eventOptions' => $eventOptions,
            'typeOptions' => $typeOptions,
            'userOptions' => $userOptions,
        ]);
    }

    public function show(Audit $audit): View
    {
        $audit->load(['user:id,name', 'creator:id,name']);

        $oldValues = $this->filterSensitiveValues(is_array($audit->old_values) ? $audit->old_values : []);
        $newValues = $this->filterSensitiveValues(is_array($audit->new_values) ? $audit->new_values : []);
        $keys = array_values(array_unique(array_merge(array_keys($oldValues), array_keys($newValues))));
        sort($keys);

        return view('audits.show', [
            'audit' => $audit,
            'changesKeys' => $keys,
            'oldValues' => $oldValues,
            'newValues' => $newValues,
        ]);
    }

    private function filterSensitiveValues(array $values): array
    {
        return collect($values)
            ->reject(function ($value, $key): bool {
                $normalizedKey = strtolower((string) $key);

                return str_contains($normalizedKey, 'password')
                    || in_array($normalizedKey, self::HIDDEN_CHANGE_KEYS, true);
            })
            ->all();
    }
}
