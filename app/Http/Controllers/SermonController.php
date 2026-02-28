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
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));

        return view('sermons.index', [
            'sermons' => $this->service->paginate($perPage),
        ]);
    }

    public function create(): View
    {
        return view('sermons.create', [
            'playlists' => $this->service->playlistOptions(),
        ]);
    }

    public function store(StoreSermonRequest $request): RedirectResponse
    {
        $payload = $request->validated();
        $payload['file'] = $request->file('file');

        $this->service->create($payload);

        return redirect()
            ->route('sermons.index')
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
