<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShepherdingReasonRequest;
use App\Http\Requests\StoreShepherdingReasonRequest;
use App\Http\Requests\UpdateShepherdingReasonRequest;
use App\Models\ShepherdingReason;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShepherdingReasonsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shepherding_reason_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shepherdingReasons = ShepherdingReason::all();

        return view('admin.shepherdingReasons.index', compact('shepherdingReasons'));
    }

    public function create()
    {
        abort_if(Gate::denies('shepherding_reason_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shepherdingReasons.create');
    }

    public function store(StoreShepherdingReasonRequest $request)
    {
        $shepherdingReason = ShepherdingReason::create($request->all());

        return redirect()->route('admin.shepherding-reasons.index');
    }

    public function edit(ShepherdingReason $shepherdingReason)
    {
        abort_if(Gate::denies('shepherding_reason_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shepherdingReasons.edit', compact('shepherdingReason'));
    }

    public function update(UpdateShepherdingReasonRequest $request, ShepherdingReason $shepherdingReason)
    {
        $shepherdingReason->update($request->all());

        return redirect()->route('admin.shepherding-reasons.index');
    }

    public function show(ShepherdingReason $shepherdingReason)
    {
        abort_if(Gate::denies('shepherding_reason_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shepherdingReasons.show', compact('shepherdingReason'));
    }

    public function destroy(ShepherdingReason $shepherdingReason)
    {
        abort_if(Gate::denies('shepherding_reason_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shepherdingReason->delete();

        return back();
    }

    public function massDestroy(MassDestroyShepherdingReasonRequest $request)
    {
        ShepherdingReason::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
