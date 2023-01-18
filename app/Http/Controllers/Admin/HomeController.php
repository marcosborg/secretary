<?php

namespace App\Http\Controllers\Admin;

use App\Models\Month;
use App\Models\Publisher;
use App\Models\Year;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController
{
    public function index(Request $request)
    {
        //CHECK MONTH VS CARBON MONTH

        $date = Carbon::now();

        //CHECK YEAR

        $year = Year::where('name', $date->year)->first();

        if (!$year) {
            $year = Year::orderBy('id', 'DESC')->first();
        }
        $current_month = Month::where(
            [
                'year_id' => $year->id,
                'number' => $date->month,
            ]
        )->first(
            );

        if(!$current_month){
            $month = Month::orderBy('id', 'DESC')->first();
        } else {
            $month = Month::where('id', '<', $current_month->id)->orderBy('id', 'desc')->first();
        }

        if (!$month) {
            $month = Month::orderBy('id', 'DESC')->first();
        }

        return redirect('admin/dashboard/' . $month->id);

    }

    public function changeMonth(Request $request)
    {
        return redirect('admin/dashboard/' . $request->month_id);
    }

    public function dashboard(Request $request)
    {

        $months = Month::with('year')->get();
        $month = Month::where(
            'id', $request->month_id
        )
            ->with(
                'reports.publisher'
            )
            ->first(
            );

        $pioneers = Publisher::whereHas(
            'responsibilities', function (Builder $query) {
                $query->where('pioneer', 1);
            }
        )->get(
            );

        $collectedMonths = Month::where('id', '<=', $month->id)->with('reports')->take(12)->get();

        foreach ($collectedMonths as $collectedMonth) {
            $collectedMonth->publications = $collectedMonth->reports->sum('publications');
            $collectedMonth->videos = $collectedMonth->reports->sum('videos');
            $collectedMonth->hours = $collectedMonth->reports->sum('hours');
            $collectedMonth->revisits = $collectedMonth->reports->sum('revisits');
            $collectedMonth->studies = $collectedMonth->reports->sum('studies');
        }

        $settings1 = [
            'chart_title' => 'Publicadores ativos',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Publisher',
            'group_by_field' => 'baptism',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
            'translation_key' => 'publisher',
            'total_number' => $month->reports->where('hours', '>', 0)->count(),
        ];

        $settings2 = [
            'chart_title' => 'Publicadores irregulares',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Publisher',
            'group_by_field' => 'baptism',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
            'translation_key' => 'publisher',
            'total_number' => $month->reports->where('hours', 0)->count(),
        ];

        $settings3 = [
            'chart_title' => 'Pioneiros regulares',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Publisher',
            'group_by_field' => 'baptism',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
            'translation_key' => 'publisher',
            'total_number' => $pioneers->count(),
        ];

        $settings4 = [
            'chart_title' => 'Pioneiros auxiliares',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Publisher',
            'group_by_field' => 'baptism',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
            'group_by_field_format' => 'Y-m-d',
            'column_class' => 'col-md-3',
            'entries_number' => '5',
            'translation_key' => 'publisher',
            'total_number' => $month->reports->where('pioneer', 1)->count(),
        ];

        return view('home', compact('settings1', 'settings2', 'settings3', 'settings4', 'months', 'month', 'collectedMonths'));
    }
}