<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLifeMinistryRequest;
use App\Http\Requests\StoreLifeMinistryRequest;
use App\Http\Requests\UpdateLifeMinistryRequest;
use App\Models\LifeMinistry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LifeMinistryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('life_ministry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lifeMinistries = LifeMinistry::all();

        return view('admin.lifeMinistries.index', compact('lifeMinistries'));
    }

    public function create()
    {
        abort_if(Gate::denies('life_ministry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lifeMinistries.create');
    }

    public function store(StoreLifeMinistryRequest $request)
    {
        $lifeMinistry = LifeMinistry::create($request->all());

        return redirect()->route('admin.life-ministries.index');
    }

    public function edit(LifeMinistry $lifeMinistry)
    {
        abort_if(Gate::denies('life_ministry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lifeMinistries.edit', compact('lifeMinistry'));
    }

    public function update(UpdateLifeMinistryRequest $request, LifeMinistry $lifeMinistry)
    {
        $lifeMinistry->update($request->all());

        return redirect()->route('admin.life-ministries.index');
    }

    public function show(LifeMinistry $lifeMinistry)
    {
        abort_if(Gate::denies('life_ministry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lifeMinistries.show', compact('lifeMinistry'));
    }

    public function destroy(LifeMinistry $lifeMinistry)
    {
        abort_if(Gate::denies('life_ministry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lifeMinistry->delete();

        return back();
    }

    public function massDestroy(MassDestroyLifeMinistryRequest $request)
    {
        LifeMinistry::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
