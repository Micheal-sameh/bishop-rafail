<?php

namespace App\Services;

use App\Enums\BooksTypes;
use App\Models\Document;
use App\Repositories\DocumentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DocumentService
{
    public function __construct(
        private readonly DocumentRepository $repository
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function paginateByType(int $type, int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateByType($type, $perPage);
    }

    public function allByType(int $type): Collection
    {
        return $this->repository->allByType($type);
    }

    public function create(array $data): Document
    {
        $file = $data['file'] ?? null;
        unset($data['file']);

        $document = $this->repository->create($data);

        if ($file) {
            $document->addMedia($file)->toMediaCollection('documents');
        }

        return $document->refresh();
    }

    public function findOrFail(int $id): Document
    {
        return $this->repository->findOrFail($id);
    }

    public function update(Document $document, array $data): Document
    {
        $file = $data['file'] ?? null;
        unset($data['file']);

        if (! empty($data['url'])) {
            $document->clearMediaCollection('documents');
        }

        if ($file) {
            $data['url'] = null;
        }

        $document = $this->repository->update($document, $data);

        if ($file) {
            $document->clearMediaCollection('documents');
            $document->addMedia($file)->toMediaCollection('documents');
        }

        return $document->refresh();
    }

    public function delete(Document $document): bool
    {
        $document->clearMediaCollection('documents');

        return $this->repository->delete($document);
    }

    public function typeFromSlug(string $type): int
    {
        return match ($type) {
            'produced' => BooksTypes::PRODUCED,
            'artical' => BooksTypes::ARTICAL,
            default => BooksTypes::HISTORICAL,
        };
    }

    public function typeSlugFromValue(int $type): string
    {
        return match ($type) {
            BooksTypes::PRODUCED => 'produced',
            BooksTypes::ARTICAL => 'artical',
            default => 'historical',
        };
    }
}
