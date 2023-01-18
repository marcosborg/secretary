<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyShepherdingVisitRequest;
use App\Http\Requests\StoreShepherdingVisitRequest;
use App\Http\Requests\UpdateShepherdingVisitRequest;
use App\Models\Group;
use App\Models\Publisher;
use App\Models\ShepherdingReason;
use App\Models\ShepherdingVisit;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShepherdingVisitsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('shepherding_visit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ShepherdingVisit::with(['group', 'publisher', 'shepherding_reason'])->select(sprintf('%s.*', (new ShepherdingVisit())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'shepherding_visit_show';
                $editGate = 'shepherding_visit_edit';
                $deleteGate = 'shepherding_visit_delete';
                $crudRoutePart = 'shepherding-visits';

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
            $table->addColumn('group_number', function ($row) {
                return $row->group ? $row->group->number : '';
            });

            $table->addColumn('publisher_name', function ($row) {
                return $row->publisher ? $row->publisher->name : '';
            });

            $table->addColumn('shepherding_reason_name', function ($row) {
                return $row->shepherding_reason ? $row->shepherding_reason->name : '';
            });

            $table->editColumn('accomplished', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->accomplished ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'group', 'publisher', 'shepherding_reason', 'accomplished']);

            return $table->make(true);
        }

        return view('admin.shepherdingVisits.index');
    }

    public function create()
    {
        abort_if(Gate::denies('shepherding_visit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $publishers = Publisher::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shepherding_reasons = ShepherdingReason::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.shepherdingVisits.create', compact('groups', 'publishers', 'shepherding_reasons'));
    }

    public function store(StoreShepherdingVisitRequest $request)
    {
        $shepherdingVisit = ShepherdingVisit::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $shepherdingVisit->id]);
        }

        return redirect()->route('admin.shepherding-visits.index');
    }

    public function edit(ShepherdingVisit $shepherdingVisit)
    {
        abort_if(Gate::denies('shepherding_visit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::pluck('number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $publishers = Publisher::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shepherding_reasons = ShepherdingReason::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shepherdingVisit->load('group', 'publisher', 'shepherding_reason');

        return view('admin.shepherdingVisits.edit', compact('groups', 'publishers', 'shepherdingVisit', 'shepherding_reasons'));
    }

    public function update(UpdateShepherdingVisitRequest $request, ShepherdingVisit $shepherdingVisit)
    {
        $shepherdingVisit->update($request->all());

        return redirect()->route('admin.shepherding-visits.index');
    }

    public function show(ShepherdingVisit $shepherdingVisit)
    {
        abort_if(Gate::denies('shepherding_visit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shepherdingVisit->load('group', 'publisher', 'shepherding_reason');

        return view('admin.shepherdingVisits.show', compact('shepherdingVisit'));
    }

    public function destroy(ShepherdingVisit $shepherdingVisit)
    {
        abort_if(Gate::denies('shepherding_visit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shepherdingVisit->delete();

        return back();
    }

    public function massDestroy(MassDestroyShepherdingVisitRequest $request)
    {
        ShepherdingVisit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('shepherding_visit_create') && Gate::denies('shepherding_visit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ShepherdingVisit();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
