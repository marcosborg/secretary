<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPublisherRequest;
use App\Http\Requests\StorePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Models\Group;
use App\Models\Publisher;
use App\Models\Responsibility;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('publisher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Publisher::with(['responsibilities', 'group'])->select(sprintf('%s.*', (new Publisher())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'publisher_show';
                $editGate = 'publisher_edit';
                $deleteGate = 'publisher_delete';
                $crudRoutePart = 'publishers';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('emergency', function ($row) {
                return $row->emergency ? $row->emergency : '';
            });
            $table->editColumn('celphone', function ($row) {
                return $row->celphone ? $row->celphone : '';
            });

            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('responsibilities', function ($row) {
                $labels = [];
                foreach ($row->responsibilities as $responsibility) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $responsibility->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('rgpd', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->rgpd ? 'checked' : null) . '>';
            });
            $table->editColumn('dav', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->dav ? 'checked' : null) . '>';
            });

            $table->addColumn('group_number', function ($row) {
                return $row->group ? $row->group->number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'responsibilities', 'rgpd', 'dav', 'group']);

            return $table->make(true);
        }

        return view('admin.publishers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('publisher_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsibilities = Responsibility::pluck('name', 'id');

        $groups = Group::pluck('number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.publishers.create', compact('groups', 'responsibilities'));
    }

    public function store(StorePublisherRequest $request)
    {
        $publisher = Publisher::create($request->all());
        $publisher->responsibilities()->sync($request->input('responsibilities', []));

        return redirect()->route('admin.publishers.index');
    }

    public function edit(Publisher $publisher)
    {
        abort_if(Gate::denies('publisher_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsibilities = Responsibility::pluck('name', 'id');

        $groups = Group::pluck('number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $publisher->load('responsibilities', 'group');

        return view('admin.publishers.edit', compact('groups', 'publisher', 'responsibilities'));
    }

    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        $publisher->update($request->all());
        $publisher->responsibilities()->sync($request->input('responsibilities', []));

        return redirect()->route('admin.publishers.index');
    }

    public function show(Publisher $publisher)
    {
        abort_if(Gate::denies('publisher_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publisher->load('responsibilities', 'group', 'overseerGroups', 'helperGroups');

        return view('admin.publishers.show', compact('publisher'));
    }

    public function destroy(Publisher $publisher)
    {
        abort_if(Gate::denies('publisher_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publisher->delete();

        return back();
    }

    public function massDestroy(MassDestroyPublisherRequest $request)
    {
        Publisher::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
