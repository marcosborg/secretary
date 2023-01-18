<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMeetingRequest;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Models\Meeting;
use App\Models\Month;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('meeting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Meeting::with(['month'])->select(sprintf('%s.*', (new Meeting())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'meeting_show';
                $editGate = 'meeting_edit';
                $deleteGate = 'meeting_delete';
                $crudRoutePart = 'meetings';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('month_name', function ($row) {
                return $row->month ? $row->month->name : '';
            });

            $table->editColumn('week', function ($row) {
                return $row->week ? Meeting::WEEK_RADIO[$row->week] : '';
            });
            $table->editColumn('meeting', function ($row) {
                return $row->meeting ? Meeting::MEETING_RADIO[$row->meeting] : '';
            });
            $table->editColumn('presences', function ($row) {
                return $row->presences ? $row->presences : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'month']);

            return $table->make(true);
        }

        return view('admin.meetings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('meeting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Month::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.meetings.create', compact('months'));
    }

    public function store(StoreMeetingRequest $request)
    {
        $meeting = Meeting::create($request->all());

        return redirect()->route('admin.meetings.index');
    }

    public function edit(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Month::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $meeting->load('month');

        return view('admin.meetings.edit', compact('meeting', 'months'));
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        $meeting->update($request->all());

        return redirect()->route('admin.meetings.index');
    }

    public function show(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting->load('month');

        return view('admin.meetings.show', compact('meeting'));
    }

    public function destroy(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting->delete();

        return back();
    }

    public function massDestroy(MassDestroyMeetingRequest $request)
    {
        Meeting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
