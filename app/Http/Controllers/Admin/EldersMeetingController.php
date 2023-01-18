<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEldersMeetingRequest;
use App\Http\Requests\StoreEldersMeetingRequest;
use App\Http\Requests\UpdateEldersMeetingRequest;
use App\Models\EldersMeeting;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Publisher;
use App\Models\Responsibility;

class EldersMeetingController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('elders_meeting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EldersMeeting::query()->select(sprintf('%s.*', (new EldersMeeting())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'elders_meeting_show';
                $editGate = 'elders_meeting_edit';
                $deleteGate = 'elders_meeting_delete';
                $crudRoutePart = 'elders-meetings';

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

            $table->editColumn('subject', function ($row) {
                return $row->subject ? $row->subject : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.eldersMeetings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('elders_meeting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eldersMeetings.create');
    }

    public function store(StoreEldersMeetingRequest $request)
    {
        $eldersMeeting = EldersMeeting::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $eldersMeeting->id]);
        }

        return redirect()->route('admin.elders-meetings.index');
    }

    public function edit(EldersMeeting $eldersMeeting)
    {
        abort_if(Gate::denies('elders_meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eldersMeetings.edit', compact('eldersMeeting'));
    }

    public function update(UpdateEldersMeetingRequest $request, EldersMeeting $eldersMeeting)
    {
        $eldersMeeting->update($request->all());

        return redirect()->route('admin.elders-meetings.index');
    }

    public function show(EldersMeeting $eldersMeeting)
    {
        abort_if(Gate::denies('elders_meeting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.eldersMeetings.show', compact('eldersMeeting'));
    }

    public function destroy(EldersMeeting $eldersMeeting)
    {
        abort_if(Gate::denies('elders_meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eldersMeeting->delete();

        return back();
    }

    public function massDestroy(MassDestroyEldersMeetingRequest $request)
    {
        EldersMeeting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('elders_meeting_create') && Gate::denies('elders_meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new EldersMeeting();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function sendByEmail(Request $request)
    {

        $meeting = EldersMeeting::find($request->id);
        return $meeting;
    }
}
