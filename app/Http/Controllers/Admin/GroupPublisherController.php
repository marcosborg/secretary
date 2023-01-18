<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Group;

class GroupPublisherController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('group_publisher_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = Auth::user()->with('group.groupPublishers.responsibilities')->first();

        return view('admin.groupPublishers.index')->with('user', $user);
    }

}
