<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeMinistry;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonthlyScheduleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('monthly_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $query = LifeMinistry::orderBy('date')->get();

        $lifeMinistries = collect();
        $years = collect();
        foreach ($query as $lifeMinistry) {
            $year = Carbon::createFromFormat('Y-m-d', $lifeMinistry->date)->year;
            $month = Carbon::createFromFormat('Y-m-d', $lifeMinistry->date)->month;
            switch ($month) {
                case 1:
                    $month = 'Janeiro';
                    break;
                case 2:
                    $month = 'Fevereiro';
                    break;
                case 3:
                    $month = 'Março';
                    break;
                case 4:
                    $month = 'Abril';
                    break;
                case 5:
                    $month = 'Maio';
                    break;
                case 6:
                    $month = 'Junho';
                    break;
                case 7:
                    $month = 'Julho';
                    break;
                case 8:
                    $month = 'Agosto';
                    break;
                case 9:
                    $month = 'Setembro';
                    break;
                case 10:
                    $month = 'Outubro';
                    break;
                case 11:
                    $month = 'Novembro';
                    break;
                case 12:
                    $month = 'Dezembro';
                    break;
                default:
                    # code...
                    break;
            }
            $lifeMinistry->year = $year;
            $lifeMinistry->month = $month;
            $years->add($lifeMinistry);
        }

        $years = $years->groupBy('year');

        foreach ($years as $key => $year) {
            $year = $year->groupBy('month');
            $lifeMinistries[$key] = $year;
        }

        return view('admin.monthlySchedules.index')->with('lifeMinistries', $lifeMinistries);
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
        if ($request->disabled) {
            $lifeMinistry->disabled = true;
        }
        $lifeMinistry->reason = $request->reason;
        $lifeMinistry->save();

        return $lifeMinistry;
    }
}
