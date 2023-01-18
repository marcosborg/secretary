<?php

namespace App\Http\Requests;

use App\Models\ShepherdingVisit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShepherdingVisitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shepherding_visit_create');
    }

    public function rules()
    {
        return [
            'group_id' => [
                'required',
                'integer',
            ],
            'publisher_id' => [
                'required',
                'integer',
            ],
            'datetime' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'shepherding_reason_id' => [
                'required',
                'integer',
            ],
            'next_visit' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
