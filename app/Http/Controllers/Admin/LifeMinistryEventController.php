<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLifeMinistryEventRequest;
use App\Http\Requests\StoreLifeMinistryEventRequest;
use App\Http\Requests\UpdateLifeMinistryEventRequest;
use App\Models\Assignment;
use App\Models\LifeMinistry;
use App\Models\LifeMinistryEvent;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LifeMinistryEventController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('life_ministry_event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lifeMinistryEvents = LifeMinistryEvent::with(['life_ministry', 'assignment', 'student'])->get();

        return view('admin.lifeMinistryEvents.index', compact('lifeMinistryEvents'));
    }

    public function create()
    {
        abort_if(Gate::denies('life_ministry_event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $life_ministries = LifeMinistry::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignments = Assignment::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lifeMinistryEvents.create', compact('assignments', 'life_ministries', 'students'));
    }

    public function store(StoreLifeMinistryEventRequest $request)
    {
        $lifeMinistryEvent = LifeMinistryEvent::create($request->all());

        return redirect()->route('admin.life-ministry-events.index');
    }

    public function edit(LifeMinistryEvent $lifeMinistryEvent)
    {
        abort_if(Gate::denies('life_ministry_event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $life_ministries = LifeMinistry::pluck('date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignments = Assignment::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = Student::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lifeMinistryEvent->load('life_ministry', 'assignment', 'student');

        return view('admin.lifeMinistryEvents.edit', compact('assignments', 'lifeMinistryEvent', 'life_ministries', 'students'));
    }

    public function update(UpdateLifeMinistryEventRequest $request, LifeMinistryEvent $lifeMinistryEvent)
    {
        $lifeMinistryEvent->update($request->all());

        return redirect()->route('admin.life-ministry-events.index');
    }

    public function show(LifeMinistryEvent $lifeMinistryEvent)
    {
        abort_if(Gate::denies('life_ministry_event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lifeMinistryEvent->load('life_ministry', 'assignment', 'student');

        return view('admin.lifeMinistryEvents.show', compact('lifeMinistryEvent'));
    }

    public function destroy(LifeMinistryEvent $lifeMinistryEvent)
    {
        abort_if(Gate::denies('life_ministry_event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lifeMinistryEvent->delete();

        return back();
    }

    public function massDestroy(MassDestroyLifeMinistryEventRequest $request)
    {
        LifeMinistryEvent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
