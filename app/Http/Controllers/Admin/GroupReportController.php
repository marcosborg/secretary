<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Year;
use App\Models\User;
use App\Models\Group;
use App\Models\Report;
use App\Models\Publisher;

class GroupReportController extends Controller
{
    public function index()
    {

        abort_if(Gate::denies('group_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = Auth::user();
        
        $group = Group::where('id', $user->group->id)
            ->first();
        $years = Year::with('months')
            ->get();
        $user->group = $group;
        if ($group) {
            foreach ($years as $year) {
                foreach ($year->months as $month) {
                    $publishers = Publisher::where('group_id', $group->id)->with('responsibilities')->orderBy('name')->get();
                    $regularPioneersCount = 0;
                    $pioneerCount = 0;
                    $publicationsTotal = 0;
                    $publicationsPioneersTotal = 0;
                    $publicationsRegularPioneersTotal = 0;
                    $videosTotal = 0;
                    $videosPioneersTotal = 0;
                    $videosRegularPioneersTotal = 0;
                    $hoursTotal = 0;
                    $hoursPioneersTotal = 0;
                    $hoursRegularPioneersTotal = 0;
                    $revisitsTotal = 0;
                    $revisitsPioneersTotal = 0;
                    $revisitsRegularPioneersTotal = 0;
                    $studiesTotal = 0;
                    $studiesPioneersTotal = 0;
                    $studiesRegularPioneersTotal = 0;
                    foreach ($publishers as $publisher) {
                        $pioneer = false;
                        $pioneer_name = '';
                        foreach ($publisher->responsibilities as $key => $responsability) {
                            if ($key == 0) {
                                $pioneer = false;
                            }
                            if ($responsability->pioneer == 1) {
                                $pioneer = true;
                                $pioneer_name = $responsability->name;
                                $regularPioneersCount++;
                            }
                            if ($responsability->tik_pioneer == 1) {
                                $pioneer = true;
                                $pioneer_name = $responsability->name;
                                $pioneerCount++;
                            }
                        }
                        $publisher->pioneer = $pioneer;
                        $publisher->pioneer_name = $pioneer_name;
                        $report = Report::where([
                            'publisher_id' => $publisher->id,
                            'month_id' => $month->id,
                        ])->first();
                        if ($report) {
                            $publisher->report = $report;
                            if ($report->pioneer == 1) {
                                $pioneerCount++;
                                $publicationsPioneersTotal = $publicationsPioneersTotal + $report->publications;
                                $videosPioneersTotal = $videosPioneersTotal + $report->videos;
                                $hoursPioneersTotal = $hoursPioneersTotal + $report->hours;
                                $revisitsPioneersTotal = $revisitsPioneersTotal + $report->revisits;
                                $studiesPioneersTotal = $studiesPioneersTotal + $report->studies;
                            }
                            if ($pioneer) {
                                $publicationsRegularPioneersTotal = $publicationsRegularPioneersTotal + $report->publications;
                                $videosRegularPioneersTotal = $videosRegularPioneersTotal + $report->videos;
                                $hoursRegularPioneersTotal = $hoursRegularPioneersTotal + $report->hours;
                                $revisitsRegularPioneersTotal = $revisitsRegularPioneersTotal + $report->revisits;
                                $studiesRegularPioneersTotal = $studiesRegularPioneersTotal + $report->studies;
                            }
                            $publicationsTotal = $publicationsTotal + $report->publications;
                            $videosTotal = $videosTotal + $report->videos;
                            $hoursTotal = $hoursTotal + $report->hours;
                            $revisitsTotal = $revisitsTotal + $report->revisits;
                            $studiesTotal = $studiesTotal + $report->studies;
                        }
                        else {
                            $report = new Report;
                            $report->publications = 0;
                            $report->videos = 0;
                            $report->hours = 0;
                            $report->revisits = 0;
                            $report->studies = 0;
                            $report->month_id = $month->id;
                            $report->publisher_id = $publisher->id;
                            $report->save();
                            $publisher->report = $report;
                        }
                    }
                    $month->publishers = $publishers;
                    $month->pioneerCount = $pioneerCount;
                    $month->regularPioneersCount = $regularPioneersCount;
                    $month->publicationsTotal = $publicationsTotal;
                    $month->publicationsPioneersTotal = $publicationsPioneersTotal;
                    $month->publicationsRegularPioneersTotal = $publicationsRegularPioneersTotal;
                    $month->videosTotal = $videosTotal;
                    $month->videosPioneersTotal = $videosPioneersTotal;
                    $month->videosRegularPioneersTotal = $videosRegularPioneersTotal;
                    $month->hoursTotal = $hoursTotal;
                    $month->hoursPioneersTotal = $hoursPioneersTotal;
                    $month->hoursRegularPioneersTotal = $hoursRegularPioneersTotal;
                    $month->revisitsTotal = $revisitsTotal;
                    $month->revisitsPioneersTotal = $revisitsPioneersTotal;
                    $month->revisitsRegularPioneersTotal = $revisitsRegularPioneersTotal;
                    $month->studiesTotal = $studiesTotal;
                    $month->studiesPioneersTotal = $studiesPioneersTotal;
                    $month->studiesRegularPioneersTotal = $studiesRegularPioneersTotal;
                }
            }
        }

        return view('admin.groupReports.index')->with([
            'user' => $user,
            'years' => $years,
        ]);
    }

    public function updateReport(Request $request)
    {
        $forms = [];
        foreach ($request->all() as $key => $value) {
            if ($key != '_token') {
                $input = explode('-', $key);
                $forms[] = [
                    'report_id' => $input[1],
                    'column' => $input[2],
                    'value' => $value
                ];
            }
        }
        $forms = collect($forms)->groupBy('report_id');
        foreach ($forms as $report_id => $form) {
            $report = Report::find($report_id);
            $pioneer = false;
            $preached = false;
            foreach ($form as $value) {
                $column = $value['column'];
                if ($column == 'pioneer') {
                    $pioneer = true;
                }
                $report->$column = $value['value'];
                if ($pioneer == false) {
                    $report->pioneer = 0;
                }
                $column = $value['column'];
                if ($column == 'preached') {
                    $preached = true;
                }
                $report->$column = $value['value'];
                if ($preached == false) {
                    $report->preached = 0;
                }
            }
            $report->save();
        }
        return redirect()->back()->with('status', 'Atualizado com sucesso.');
    }

}