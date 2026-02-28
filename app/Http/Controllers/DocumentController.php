<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Requests\Document\UpdateDocumentRequest;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function __construct(
        private readonly DocumentService $service
    ) {}

    public function index(Request $request): View
    {
        return $this->indexByType($request, 'historical');
    }

    public function indexHistorical(Request $request): View
    {
        return $this->indexByType($request, 'historical');
    }

    public function indexProduced(Request $request): View
    {
        return $this->indexByType($request, 'produced');
    }

    public function indexArtical(Request $request): View
    {
        return $this->indexByType($request, 'artical');
    }

    public function create(): View
    {
        return $this->createByType('historical');
    }

    public function createHistorical(): View
    {
        return $this->createByType('historical');
    }

    public function createProduced(): View
    {
        return $this->createByType('produced');
    }

    public function createArtical(): View
    {
        return $this->createByType('artical');
    }

    public function store(StoreDocumentRequest $request): RedirectResponse
    {
        return $this->storeByType($request, 'historical');
    }

    public function storeHistorical(StoreDocumentRequest $request): RedirectResponse
    {
        return $this->storeByType($request, 'historical');
    }

    public function storeProduced(StoreDocumentRequest $request): RedirectResponse
    {
        return $this->storeByType($request, 'produced');
    }

    public function storeArtical(StoreDocumentRequest $request): RedirectResponse
    {
        return $this->storeByType($request, 'artical');
    }

    private function indexByType(Request $request, string $type): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));
        $typeValue = $this->service->typeFromSlug($type);

        return view('documents.index', [
            'documents' => $this->service->paginateByType($typeValue, $perPage),
            'activeType' => $type,
        ]);
    }

    private function createByType(string $type): View
    {
        return view('documents.create', [
            'activeType' => $type,
        ]);
    }

    private function storeByType(StoreDocumentRequest $request, string $type): RedirectResponse
    {
        $payload = $request->validated();
        $payload['file'] = $request->file('file');
        $payload['type'] = $this->service->typeFromSlug($type);

        $this->service->create($payload);

        return redirect()
            ->route("documents.{$type}.index")
            ->with('status', 'تم إنشاء المستند بنجاح.');
    }

    public function show(Document $document): View
    {
        return view('documents.show', [
            'document' => $this->service->findOrFail((int) $document->id),
        ]);
    }

    public function edit(Document $document): View
    {
        return view('documents.update', [
            'document' => $this->service->findOrFail((int) $document->id),
        ]);
    }

    public function update(UpdateDocumentRequest $request, Document $document): RedirectResponse
    {
        $payload = $request->validated();
        $payload['file'] = $request->file('file');

        $updatedDocument = $this->service->update($document, $payload);

        return redirect()
            ->route('documents.show', $updatedDocument)
            ->with('status', 'تم تحديث المستند بنجاح.');
    }

    public function delete(Document $document): View
    {
        return view('documents.delete', [
            'document' => $this->service->findOrFail((int) $document->id),
        ]);
    }

    public function destroy(Document $document): RedirectResponse
    {
        $type = $this->service->typeSlugFromValue((int) $document->type);

        $this->service->delete($document);

        return redirect()
            ->route("documents.{$type}.index")
            ->with('status', 'تم حذف المستند بنجاح.');
    }
}
