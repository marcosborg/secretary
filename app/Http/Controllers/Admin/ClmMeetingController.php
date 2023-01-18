<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClmMeetingRequest;
use App\Http\Requests\StoreClmMeetingRequest;
use App\Http\Requests\UpdateClmMeetingRequest;
use App\Models\ClmMeeting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClmMeetingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('clm_meeting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clmMeetings = ClmMeeting::all();

        return view('admin.clmMeetings.index', compact('clmMeetings'));
    }

    public function create()
    {
        abort_if(Gate::denies('clm_meeting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clmMeetings.create');
    }

    public function store(StoreClmMeetingRequest $request)
    {
        $clmMeeting = ClmMeeting::create($request->all());

        return redirect()->route('admin.clm-meetings.index');
    }

    public function edit(ClmMeeting $clmMeeting)
    {
        abort_if(Gate::denies('clm_meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clmMeetings.edit', compact('clmMeeting'));
    }

    public function update(UpdateClmMeetingRequest $request, ClmMeeting $clmMeeting)
    {
        $clmMeeting->update($request->all());

        return redirect()->route('admin.clm-meetings.index');
    }

    public function show(ClmMeeting $clmMeeting)
    {
        abort_if(Gate::denies('clm_meeting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clmMeetings.show', compact('clmMeeting'));
    }

    public function destroy(ClmMeeting $clmMeeting)
    {
        abort_if(Gate::denies('clm_meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clmMeeting->delete();

        return back();
    }

    public function massDestroy(MassDestroyClmMeetingRequest $request)
    {
        ClmMeeting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
