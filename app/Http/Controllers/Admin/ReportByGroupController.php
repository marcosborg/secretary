<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Month;
use Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Report;
use App\Models\Publisher;
use App\Models\Year;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class ReportByGroupController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('report_by_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = Group::all();
        $group = Group::where('id', $request->group_id)
            ->first();
        $user = Auth::user()->with('group')->first();
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
                        } else {
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

        return view('admin.reportByGroups.index')->with([
            'user' => $user,
            'years' => $years,
            'groups' => $groups,
        ]);

    }

    public function reportByGroup(Request $request)
    {

        abort_if(Gate::denies('report_by_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (Auth::user()->group_id != $request->group_id) {
            abort_if(!Auth::user()->getIsAdminAttribute(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $publishers = Publisher::where([
            'group_id' => $request->group_id
        ])
            ->with('responsibilities')
            ->get();

        $LastMonths = Month::limit(12)->get();
        $months = collect();

        foreach ($LastMonths as $month) {

            $month->report = Report::with([
                'publisher',
                'month'
            ])
                ->whereHas('publisher', function ($query) use ($request) {
                    $query->where('group_id', $request->group_id);
                })
                ->whereHas('month', function ($query) use ($month) {
                    $query->where('id', $month->id);
                })
                ->get();
            $month->hours = $month->report->sum('hours');
            $month->publications = $month->report->sum('publications');
            $month->videos = $month->report->sum('videos');
            $month->revisits = $month->report->sum('revisits');
            $month->studies = $month->report->sum('studies');

            if ($month && $month->hours > 0) {
                $months->add($month);
            }
        }

        return view('admin.reportByGroups.reportByGroup')->with([
            'publishers' => $publishers,
            'months' => $months,
        ]);
    }

    public function reportByPublisher(Request $request)
    {

        abort_if(Gate::denies('report_by_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publisher = Publisher::where('id', $request->publisher_id)
            ->with('responsibilities')
            ->first();


        if (Auth::user()->group_id != $publisher->group_id) {
            abort_if(!Auth::user()->getIsAdminAttribute(), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $LastMonths = Month::limit(12)->get();
        $months = collect();

        foreach ($LastMonths as $month) {

            $month->report = Report::with([
                'publisher',
                'month'
            ])
                ->whereHas('publisher', function ($query) use ($request) {
                    $query->where('publisher_id', $request->publisher_id);
                })
                ->whereHas('month', function ($query) use ($month) {
                    $query->where('id', $month->id);
                })
                ->get();
            $month->hours = $month->report->sum('hours');
            $month->publications = $month->report->sum('publications');
            $month->videos = $month->report->sum('videos');
            $month->revisits = $month->report->sum('revisits');
            $month->studies = $month->report->sum('studies');

            if ($month && $month->hours > 0) {
                $months->add($month);
            }
        }

        $average = [
            'hours' => round($months->avg('hours')),
            'publications' => round($months->avg('publications')),
            'videos' => round($months->avg('videos')),
            'revisits' => round($months->avg('revisits')),
            'studies' => round($months->avg('studies')),
        ];

        return view('admin.reportByGroups.reportByPublisher')->with([
            'publisher' => $publisher,
            'months' => $months,
            'average' => collect($average),
        ]);

    }

}