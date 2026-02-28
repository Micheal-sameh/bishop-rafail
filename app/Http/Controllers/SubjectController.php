<?php

namespace App\Http\Controllers;

use App\DTOs\SubjectDataDTO;
use App\Http\Requests\Subject\StoreSubjectRequest;
use App\Http\Requests\Subject\UpdateSubjectRequest;
use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function __construct(
        private readonly SubjectService $service
    ) {}

    public function index(Request $request): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));

        return view('subjects.index', [
            'subjects' => $this->service->paginate($perPage),
        ]);
    }

    public function create(): View
    {
        return view('subjects.create');
    }

    public function store(StoreSubjectRequest $request): RedirectResponse
    {
        $this->service->create(SubjectDataDTO::fromArray($request->validated()));

        return redirect()->route('subjects.index')->with('status', 'تم إنشاء المادة بنجاح.');
    }

    public function show(Subject $subject): View
    {
        return view('subjects.show', [
            'subject' => $this->service->findOrFail((int) $subject->id),
        ]);
    }

    public function edit(Subject $subject): View
    {
        return view('subjects.update', [
            'subject' => $this->service->findOrFail((int) $subject->id),
        ]);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject): RedirectResponse
    {
        $this->service->update($subject, SubjectDataDTO::fromArray($request->validated()));

        return redirect()->route('subjects.show', $subject)->with('status', 'تم تحديث المادة بنجاح.');
    }

    public function delete(Subject $subject): View
    {
        return view('subjects.delete', [
            'subject' => $this->service->findOrFail((int) $subject->id),
        ]);
    }

    public function destroy(Subject $subject): RedirectResponse
    {
        $this->service->delete($subject);

        return redirect()->route('subjects.index')->with('status', 'تم حذف المادة بنجاح.');
    }
}
