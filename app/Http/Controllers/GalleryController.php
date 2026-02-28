<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\StoreGalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(
        private readonly GalleryService $service
    ) {}

    public function index(Request $request): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));

        return view('gallery.index', [
            'items' => $this->service->paginate($perPage),
        ]);
    }

    public function create(): View
    {
        return view('gallery.create');
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $this->service->createMany($request->file('images', []));

        return redirect()->route('gallery.index')->with('status', 'تمت إضافة الصور بنجاح.');
    }

    public function show(Gallery $gallery): View
    {
        return view('gallery.show', [
            'item' => $this->service->findOrFail((int) $gallery->id),
        ]);
    }

    public function delete(Gallery $gallery): View
    {
        return view('gallery.delete', [
            'item' => $this->service->findOrFail((int) $gallery->id),
        ]);
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $this->service->delete($gallery);

        return redirect()->route('gallery.index')->with('status', 'تم حذف الصورة بنجاح.');
    }
}
