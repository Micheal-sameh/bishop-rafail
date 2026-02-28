<?php

namespace App\Http\Controllers;

use App\Enums\SermonsTypes;
use App\Http\Requests\SermonPlaylist\StoreSermonPlaylistRequest;
use App\Http\Requests\SermonPlaylist\UpdateSermonPlaylistRequest;
use App\Models\SermonPlaylist;
use App\Services\SermonPlaylistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SermonPlaylistController extends Controller
{
    public function __construct(
        private readonly SermonPlaylistService $service
    ) {}

    public function index(Request $request): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));

        return view('sermons_playlists.index', [
            'playlists' => $this->service->paginate($perPage),
            'typeLabel' => fn (int $value) => SermonsTypes::getStringValue($value),
        ]);
    }

    public function create(): View
    {
        return view('sermons_playlists.create', [
            'types' => $this->service->typeOptions(),
        ]);
    }

    public function store(StoreSermonPlaylistRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()
            ->route('sermons-playlists.index')
            ->with('status', 'تم إنشاء قائمة العظات بنجاح.');
    }

    public function show(SermonPlaylist $sermons_playlist): View
    {
        return view('sermons_playlists.show', [
            'playlist' => $this->service->findOrFail((int) $sermons_playlist->id),
            'typeLabel' => fn (int $value) => SermonsTypes::getStringValue($value),
        ]);
    }

    public function edit(SermonPlaylist $sermons_playlist): View
    {
        return view('sermons_playlists.update', [
            'playlist' => $this->service->findOrFail((int) $sermons_playlist->id),
            'types' => $this->service->typeOptions(),
        ]);
    }

    public function update(UpdateSermonPlaylistRequest $request, SermonPlaylist $sermons_playlist): RedirectResponse
    {
        $this->service->update($sermons_playlist, $request->validated());

        return redirect()
            ->route('sermons-playlists.show', $sermons_playlist)
            ->with('status', 'تم تحديث قائمة العظات بنجاح.');
    }

    public function delete(SermonPlaylist $sermons_playlist): View
    {
        return view('sermons_playlists.delete', [
            'playlist' => $this->service->findOrFail((int) $sermons_playlist->id),
            'typeLabel' => fn (int $value) => SermonsTypes::getStringValue($value),
        ]);
    }

    public function destroy(SermonPlaylist $sermons_playlist): RedirectResponse
    {
        $this->service->delete($sermons_playlist);

        return redirect()
            ->route('sermons-playlists.index')
            ->with('status', 'تم حذف قائمة العظات بنجاح.');
    }
}
