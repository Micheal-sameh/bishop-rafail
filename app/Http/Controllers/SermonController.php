<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sermon\StoreSermonRequest;
use App\Http\Requests\Sermon\UpdateSermonRequest;
use App\Models\Sermon;
use App\Services\SermonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SermonController extends Controller
{
    public function __construct(
        private readonly SermonService $service
    ) {}

    public function index(Request $request): View
    {
        return $this->indexByType($request, 'historical');
    }

    public function indexHistorical(Request $request): View
    {
        return $this->indexByType($request, 'historical');
    }

    public function indexTrips(Request $request): View
    {
        return $this->indexByType($request, 'trips');
    }

    public function create(): View
    {
        return $this->createByType('historical');
    }

    public function createHistorical(): View
    {
        return $this->createByType('historical');
    }

    public function createTrips(): View
    {
        return $this->createByType('trips');
    }

    public function storeHistorical(StoreSermonRequest $request): RedirectResponse
    {
        return $this->storeByType($request, 'historical');
    }

    public function storeTrips(StoreSermonRequest $request): RedirectResponse
    {
        return $this->storeByType($request, 'trips');
    }

    public function store(StoreSermonRequest $request): RedirectResponse
    {
        return $this->storeByType($request, 'historical');
    }

    private function indexByType(Request $request, string $type): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));
        $typeValue = $this->service->typeFromSlug($type);

        return view('sermons.index', [
            'sermons' => $this->service->paginateByType($typeValue, $perPage),
            'activeType' => $type,
        ]);
    }

    private function createByType(string $type): View
    {
        $typeValue = $this->service->typeFromSlug($type);

        return view('sermons.create', [
            'playlists' => $this->service->playlistOptionsByType($typeValue),
            'activeType' => $type,
        ]);
    }

    private function storeByType(StoreSermonRequest $request, string $type): RedirectResponse
    {
        $payload = $request->validated();
        $payload['file'] = $request->file('file');

        $typeValue = $this->service->typeFromSlug($type);

        if (! $this->service->isPlaylistInType((int) $payload['sermon_playlist_id'], $typeValue)) {
            return back()
                ->withErrors(['sermon_playlist_id' => 'قائمة العظات لا تنتمي إلى هذا القسم.'])
                ->withInput();
        }

        $this->service->create($payload);

        return redirect()
            ->route("sermons.{$type}.index")
            ->with('status', 'تم إنشاء العظة بنجاح.');
    }

    public function show(Sermon $sermon): View
    {
        return view('sermons.show', [
            'sermon' => $this->service->findOrFail((int) $sermon->id),
        ]);
    }

    public function edit(Sermon $sermon): View
    {
        return view('sermons.update', [
            'sermon' => $this->service->findOrFail((int) $sermon->id),
            'playlists' => $this->service->playlistOptions(),
        ]);
    }

    public function update(UpdateSermonRequest $request, Sermon $sermon): RedirectResponse
    {
        $payload = $request->validated();
        $payload['file'] = $request->file('file');

        $this->service->update($sermon, $payload);

        return redirect()
            ->route('sermons.show', $sermon)
            ->with('status', 'تم تحديث العظة بنجاح.');
    }

    public function delete(Sermon $sermon): View
    {
        return view('sermons.delete', [
            'sermon' => $this->service->findOrFail((int) $sermon->id),
        ]);
    }

    public function destroy(Sermon $sermon): RedirectResponse
    {
        $this->service->delete($sermon);

        return redirect()
            ->route('sermons.index')
            ->with('status', 'تم حذف العظة بنجاح.');
    }
}
