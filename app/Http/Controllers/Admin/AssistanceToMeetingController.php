<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Month;
use Illuminate\Support\Carbon;
use App\Models\Meeting;

class AssistanceToMeetingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('assistance_to_meeting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Month::with('year')
            ->with('meetings')
            ->get();

        return view('admin.assistanceToMeetings.index')->with([
            'months' => $months,
        ]);
    }

    public function saveAssistance(Request $request)
    {
        if ($request->has('meeting1')) {
            $meeting1 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 1,
                'meeting' => 1
            ])->first();
            $meeting1->presences = $request->meeting1;
            $meeting1->save();
        }
        if ($request->has('meeting2')) {
            $meeting2 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 1,
                'meeting' => 2
            ])->first();
            $meeting2->presences = $request->meeting2;
            $meeting2->save();
        }
        if ($request->has('meeting3')) {
            $meeting3 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 2,
                'meeting' => 1
            ])->first();
            $meeting3->presences = $request->meeting3;
            $meeting3->save();
        }
        if ($request->has('meeting4')) {
            $meeting4 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 2,
                'meeting' => 2
            ])->first();
            $meeting4->presences = $request->meeting4;
            $meeting4->save();
        }
        if ($request->has('meeting5')) {
            $meeting5 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 3,
                'meeting' => 1
            ])->first();
            $meeting5->presences = $request->meeting5;
            $meeting5->save();
        }
        if ($request->has('meeting6')) {
            $meeting6 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 3,
                'meeting' => 2
            ])->first();
            $meeting6->presences = $request->meeting6;
            $meeting6->save();
        }
        if ($request->has('meeting7')) {
            $meeting7 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 4,
                'meeting' => 1
            ])->first();
            $meeting7->presences = $request->meeting7;
            $meeting7->save();
        }
        if ($request->has('meeting8')) {
            $meeting8 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 4,
                'meeting' => 2
            ])->first();
            $meeting8->presences = $request->meeting8;
            $meeting8->save();
        }
        if ($request->has('meeting9')) {
            $meeting9 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 5,
                'meeting' => 1
            ])->first();
            $meeting9->presences = $request->meeting9;
            $meeting9->save();
        }
        if ($request->has('meeting10')) {
            $meeting10 = Meeting::where([
                'month_id' => $request->month_id,
                'week' => 5,
                'meeting' => 2
            ])->first();
            $meeting10->presences = $request->meeting10;
            $meeting10->save();
        }
        return redirect()->back()->with('status', 'Atualizado com sucesso');
    }

}