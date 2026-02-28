<?php

namespace App\Repositories;

use App\Models\Document;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DocumentRepository
{
    public function __construct(protected Document $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->latest('id')
            ->paginate($perPage);
    }

    public function paginateByType(int $type, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('type', $type)
            ->latest('id')
            ->paginate($perPage);
    }

    public function allByType(int $type): Collection
    {
        return $this->model->query()
            ->where('type', $type)
            ->latest('id')
            ->get();
    }

    public function create(array $data): Document
    {
        return $this->model->query()->create($data);
    }

    public function findOrFail(int $id): Document
    {
        return $this->model->query()->findOrFail($id);
    }

    public function update(Document $document, array $data): Document
    {
        $document->update($data);

        return $document->refresh();
    }

    public function delete(Document $document): bool
    {
        return (bool) $document->delete();
    }
}
