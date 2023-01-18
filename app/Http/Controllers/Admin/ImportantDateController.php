<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyImportantDateRequest;
use App\Http\Requests\StoreImportantDateRequest;
use App\Http\Requests\UpdateImportantDateRequest;
use App\Models\ImportantDate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImportantDateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('important_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $importantDates = ImportantDate::all();

        return view('admin.importantDates.index', compact('importantDates'));
    }

    public function create()
    {
        abort_if(Gate::denies('important_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantDates.create');
    }

    public function store(StoreImportantDateRequest $request)
    {
        $importantDate = ImportantDate::create($request->all());

        return redirect()->route('admin.important-dates.index');
    }

    public function edit(ImportantDate $importantDate)
    {
        abort_if(Gate::denies('important_date_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantDates.edit', compact('importantDate'));
    }

    public function update(UpdateImportantDateRequest $request, ImportantDate $importantDate)
    {
        $importantDate->update($request->all());

        return redirect()->route('admin.important-dates.index');
    }

    public function show(ImportantDate $importantDate)
    {
        abort_if(Gate::denies('important_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantDates.show', compact('importantDate'));
    }

    public function destroy(ImportantDate $importantDate)
    {
        abort_if(Gate::denies('important_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $importantDate->delete();

        return back();
    }

    public function massDestroy(MassDestroyImportantDateRequest $request)
    {
        ImportantDate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
