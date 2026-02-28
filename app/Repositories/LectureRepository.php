<?php

namespace App\Repositories;

use App\Models\Lecture;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LectureRepository
{
    public function __construct(protected Lecture $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()->with('subject')->latest('id')->paginate($perPage);
    }

    public function allBySubject(int $subjectId): Collection
    {
        return $this->model->query()
            ->with('subject')
            ->where('subject_id', $subjectId)
            ->latest('id')
            ->get();
    }

    public function create(array $data): Lecture
    {
        return $this->model->query()->create($data);
    }

    public function findOrFail(int $id): Lecture
    {
        return $this->model->query()->with('subject')->findOrFail($id);
    }

    public function update(Lecture $lecture, array $data): Lecture
    {
        $lecture->update($data);

        return $lecture->refresh()->load('subject');
    }

    public function delete(Lecture $lecture): bool
    {
        return (bool) $lecture->delete();
    }
}
