<?php

namespace App\Http\Controllers;

use App\Http\Requests\Film\StoreFilmRequest;
use App\Http\Requests\Film\UpdateFilmRequest;
use App\Models\Film;
use App\Services\FilmService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FilmController extends Controller
{
    public function __construct(
        private readonly FilmService $service
    ) {}

    public function index(Request $request): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));

        return view('films.index', [
            'films' => $this->service->paginate($perPage),
        ]);
    }

    public function create(): View
    {
        return view('films.create');
    }

    public function store(StoreFilmRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('films.index')->with('status', 'تم إنشاء الفيلم بنجاح.');
    }

    public function show(Film $film): View
    {
        return view('films.show', [
            'film' => $this->service->findOrFail((int) $film->id),
        ]);
    }

    public function edit(Film $film): View
    {
        return view('films.update', [
            'film' => $this->service->findOrFail((int) $film->id),
        ]);
    }

    public function update(UpdateFilmRequest $request, Film $film): RedirectResponse
    {
        $this->service->update($film, $request->validated());

        return redirect()->route('films.show', $film)->with('status', 'تم تحديث الفيلم بنجاح.');
    }

    public function delete(Film $film): View
    {
        return view('films.delete', [
            'film' => $this->service->findOrFail((int) $film->id),
        ]);
    }

    public function destroy(Film $film): RedirectResponse
    {
        $this->service->delete($film);

        return redirect()->route('films.index')->with('status', 'تم حذف الفيلم بنجاح.');
    }
}
