<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Month;
use App\Models\Publisher;
use App\Models\Report;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Report::with(['month', 'publisher'])->select(sprintf('%s.*', (new Report())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'report_show';
                $editGate = 'report_edit';
                $deleteGate = 'report_delete';
                $crudRoutePart = 'reports';

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

            $table->addColumn('publisher_name', function ($row) {
                return $row->publisher ? $row->publisher->name : '';
            });

            $table->editColumn('preached', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->preached ? 'checked' : null) . '>';
            });

            $table->editColumn('publications', function ($row) {
                return $row->publications ? $row->publications : '';
            });
            $table->editColumn('videos', function ($row) {
                return $row->videos ? $row->videos : '';
            });
            $table->editColumn('hours', function ($row) {
                return $row->hours ? $row->hours : '';
            });
            $table->editColumn('revisits', function ($row) {
                return $row->revisits ? $row->revisits : '';
            });
            $table->editColumn('studies', function ($row) {
                return $row->studies ? $row->studies : '';
            });
            $table->editColumn('pioneer', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->pioneer ? 'checked' : null) . '>';
            });
            $table->editColumn('observations', function ($row) {
                return $row->observations ? $row->observations : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'month', 'publisher', 'preached', 'pioneer']);

            return $table->make(true);
        }

        return view('admin.reports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Month::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $publishers = Publisher::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reports.create', compact('months', 'publishers'));
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Month::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $publishers = Publisher::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report->load('month', 'publisher');

        return view('admin.reports.edit', compact('months', 'publishers', 'report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('month', 'publisher');

        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        Report::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
