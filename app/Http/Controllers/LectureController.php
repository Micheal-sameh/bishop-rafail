<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lecture\StoreLectureRequest;
use App\Http\Requests\Lecture\UpdateLectureRequest;
use App\Models\Lecture;
use App\Services\LectureService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LectureController extends Controller
{
    public function __construct(
        private readonly LectureService $service
    ) {}

    public function index(Request $request): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));

        return view('lectures.index', [
            'lectures' => $this->service->paginate($perPage),
        ]);
    }

    public function create(): View
    {
        return view('lectures.create', [
            'subjects' => $this->service->subjectOptions(),
        ]);
    }

    public function store(StoreLectureRequest $request): RedirectResponse
    {
        $payload = $request->validated();
        $payload['media'] = $request->file('media');

        $this->service->create($payload);

        return redirect()->route('lectures.index')->with('status', 'تم إنشاء المحاضرة بنجاح.');
    }

    public function show(Lecture $lecture): View
    {
        return view('lectures.show', [
            'lecture' => $this->service->findOrFail((int) $lecture->id),
        ]);
    }

    public function edit(Lecture $lecture): View
    {
        return view('lectures.update', [
            'lecture' => $this->service->findOrFail((int) $lecture->id),
            'subjects' => $this->service->subjectOptions(),
        ]);
    }

    public function update(UpdateLectureRequest $request, Lecture $lecture): RedirectResponse
    {
        $payload = $request->validated();
        $payload['media'] = $request->file('media');

        $this->service->update($lecture, $payload);

        return redirect()->route('lectures.show', $lecture)->with('status', 'تم تحديث المحاضرة بنجاح.');
    }

    public function delete(Lecture $lecture): View
    {
        return view('lectures.delete', [
            'lecture' => $this->service->findOrFail((int) $lecture->id),
        ]);
    }

    public function destroy(Lecture $lecture): RedirectResponse
    {
        $this->service->delete($lecture);

        return redirect()->route('lectures.index')->with('status', 'تم حذف المحاضرة بنجاح.');
    }
}
