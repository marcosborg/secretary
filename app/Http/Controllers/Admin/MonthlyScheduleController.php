<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeMinistry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonthlyScheduleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('monthly_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.monthlySchedules.index');
    }

    public function addMeeting(Request $request)
    {

        if ($request->disabled) {
            $request->validate([
                'date' => 'required|date',
                'reason' => 'required'
            ], [], [
                    'date' => 'Data da reunião',
                    'reason' => 'Motivo'
                ]);
        } else {
            $request->validate([
                'date' => 'required|date',
            ], [], [
                    'date' => 'Data da reunião'
                ]);
        }

        $lifeMinistry = new LifeMinistry;
        $lifeMinistry->date = $request->date;
        if($request->disabled) {
            $lifeMinistry->disabled = true;
        }
        $lifeMinistry->reason = $request->reason;
        $lifeMinistry->save();

        return $lifeMinistry;
    }

}