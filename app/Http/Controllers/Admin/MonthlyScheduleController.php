<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\LifeMinistry;
use App\Models\LifeMinistryEvent;
use App\Models\Student;
use Carbon\Carbon;
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

    public function ajax()
    {
        $query = LifeMinistry::orderBy('date')
            ->with('lifeMinistryEvents.student')
            ->with('lifeMinistryEvents.assignment')
            ->get();

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
            foreach ($lifeMinistry->lifeMinistryEvents as $lifeMinistryEvent) {
                $studentLifeMinistryEventsCount = LifeMinistryEvent::where([
                    'life_ministry_id' => $lifeMinistry->id,
                    'student_id' => $lifeMinistryEvent->student_id
                ])->count();
                $lifeMinistryEvent->student_count = $studentLifeMinistryEventsCount;
            }
            $years->add($lifeMinistry);
        }

        $years = $years->groupBy('year');

        foreach ($years as $key => $year) {
            $year = $year->groupBy('month');
            $lifeMinistries[$key] = $year;
        }

        return view('admin.monthlySchedules.ajax')->with([
            'lifeMinistries' => $lifeMinistries,
        ]);
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

    public function deleteMeeting(Request $request)
    {
        return LifeMinistry::find($request->meeting_id)->delete();
    }

    public function getMeeting(Request $request)
    {
        return LifeMinistry::find($request->meeting_id);
    }

    public function updateMeeting(Request $request)
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

        $lifeMinistry = LifeMinistry::find($request->id);
        $lifeMinistry->date = $request->date;
        if ($request->disabled) {
            $lifeMinistry->disabled = true;
            $lifeMinistry->reason = $request->reason;
        } else {
            $lifeMinistry->disabled = false;
            $lifeMinistry->reason = null;
        }

        $lifeMinistry->save();

        return $lifeMinistry;
    }

    public function getAssignments()
    {

        $technical = session()->get('technical');

        if ($technical) {
            return Assignment::where('technical', $technical)->get();
        } else {
            return Assignment::where('technical', 0)->get();
        }

    }

    public function getPublishers(Request $request)
    {
        $studants = Student::whereHas('assignments', function ($query) use ($request) {
            $query->where('id', $request->assignment);
        })
            ->get();

        $orderedStudents = [];

        foreach ($studants as $student) {

            $lifeMinistryEvent = LifeMinistryEvent::where([
                'assignment_id' => $request->assignment,
                'student_id' => $student->id,
            ])
                ->with('life_ministry')
                ->orderBy(LifeMinistry::select('date')->whereColumn('id', 'life_ministry_id'), 'desc')
                ->first();

            if (isset($lifeMinistryEvent->life_ministry)) {
                $orderedStudents[] = [
                    'student' => $student->name,
                    'student_id' => $student->id,
                    'date' => $lifeMinistryEvent->life_ministry->date,
                ];
            } else {
                $orderedStudents[] = [
                    'student' => $student->name,
                    'student_id' => $student->id,
                    'date' => null,
                ];
            }
        }

        return collect($orderedStudents)->sortBy('date')->values()->all();
    }

    public function addEvent(Request $request)
    {

        $request->validate([
            'assignment' => 'required',
            'publisher' => 'required',
        ], [], [
            'assignment' => 'Designação',
            'publisher' => 'Irmão/ irmã designado(a)',
        ]);

        $lifeMinistryEvent = new LifeMinistryEvent;
        $lifeMinistryEvent->life_ministry_id = $request->meeting_id;
        $lifeMinistryEvent->assignment_id = $request->assignment;
        $lifeMinistryEvent->student_id = $request->publisher;
        $lifeMinistryEvent->save();
    }

    public function getEvent(Request $request)
    {
        return LifeMinistryEvent::where('id', $request->event_id)
            ->with([
                'life_ministry',
                'assignment',
                'student'
            ])
            ->first();

    }

    public function getFreePublishers($assignment_id, $event_id)
    {

        $event = LifeMinistryEvent::find($event_id)->load(['life_ministry', 'assignment']);

        $students = Student::whereHas('assignments', function ($assignment) use ($event) {
            $assignment->where('id', $event->assignment->id);
        })
            ->get();

        $freeStudents = collect();

        foreach ($students as $student) {
            $life_ministry_event = LifeMinistryEvent::where([
                'life_ministry_id' => $event->life_ministry_id,
                'student_id' => $student->id
            ])->first();
            if (!$life_ministry_event) {
                $freeStudents->add($student);
            }
        }

        return $freeStudents;
    }

    public function updateEvent(Request $request)
    {
        $request->validate([
            'publisher' => 'required',
        ], [], [
            'publisher' => 'Irmão/ irmã a designar',
        ]);
        $lifeMinistryEvent = LifeMinistryEvent::find($request->event_id);
        $lifeMinistryEvent->student_id = $request->publisher;
        $lifeMinistryEvent->save();

    }

    public function sortEvents(Request $request)
    {
        $events = json_decode($request->json);
        foreach ($events as $event) {
            $lifeMinistryEvent = LifeMinistryEvent::find($event->event);
            $lifeMinistryEvent->position = $event->position;
            $lifeMinistryEvent->save();
        }
    }

    public function deleteEvent(Request $request)
    {
        return LifeMinistryEvent::find($request->event_id)->delete();
    }

    public function monthToExcel(Request $request)
    {
        $meeting_id = $request->meeting_id;
        $lifeMinistryEvent = LifeMinistryEvent::where('life_ministry_id', $meeting_id)->first();
        $lifeMinistry = LifeMinistry::find($lifeMinistryEvent->life_ministry_id);
        $startdate = Carbon::createFromFormat('Y-m-d', $lifeMinistry->date)->startOfMonth()->toDateString();
        $enddate = Carbon::createFromFormat('Y-m-d', $lifeMinistry->date)->endOfMonth()->toDateString();
        $lifeMinistries = LifeMinistry::where('date', '>=', $startdate)
            ->where('date', '<=', $enddate)
            ->with([
                'lifeMinistryEvents.student',
                'lifeMinistryEvents.assignment',
            ])
            ->get();

        return view('admin.monthlySchedules.excel', compact('lifeMinistries'));
    }

    public function changeTechnical()
    {
        $technical = session()->get('technical');
        if ($technical) {
            session()->forget('technical');
        } else {
            session()->put('technical', true);
        }
    }

}