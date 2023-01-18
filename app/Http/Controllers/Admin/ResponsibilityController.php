<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyResponsibilityRequest;
use App\Http\Requests\StoreResponsibilityRequest;
use App\Http\Requests\UpdateResponsibilityRequest;
use App\Models\Responsibility;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponsibilityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('responsibility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsibilities = Responsibility::all();

        return view('admin.responsibilities.index', compact('responsibilities'));
    }

    public function create()
    {
        abort_if(Gate::denies('responsibility_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.responsibilities.create');
    }

    public function store(StoreResponsibilityRequest $request)
    {
        $responsibility = Responsibility::create($request->all());

        return redirect()->route('admin.responsibilities.index');
    }

    public function edit(Responsibility $responsibility)
    {
        abort_if(Gate::denies('responsibility_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.responsibilities.edit', compact('responsibility'));
    }

    public function update(UpdateResponsibilityRequest $request, Responsibility $responsibility)
    {
        $responsibility->update($request->all());

        return redirect()->route('admin.responsibilities.index');
    }

    public function show(Responsibility $responsibility)
    {
        abort_if(Gate::denies('responsibility_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.responsibilities.show', compact('responsibility'));
    }

    public function destroy(Responsibility $responsibility)
    {
        abort_if(Gate::denies('responsibility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsibility->delete();

        return back();
    }

    public function massDestroy(MassDestroyResponsibilityRequest $request)
    {
        Responsibility::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
