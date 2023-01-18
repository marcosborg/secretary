<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\ShepherdingVisit',
            'date_field' => 'datetime',
            'field'      => 'id',
            'prefix'     => 'Pastoreio a',
            'suffix'     => '',
            'route'      => 'admin.shepherding-visits.edit',
        ],
        [
            'model'      => '\App\Models\EldersMeeting',
            'date_field' => 'datetime',
            'field'      => 'subject',
            'prefix'     => 'Renião de anciãos -',
            'suffix'     => '',
            'route'      => 'admin.elders-meetings.edit',
        ],
        [
            'model'      => '\App\Models\ImportantDate',
            'date_field' => 'date',
            'field'      => 'name',
            'prefix'     => 'Tarefa:',
            'suffix'     => '',
            'route'      => 'admin.important-dates.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}