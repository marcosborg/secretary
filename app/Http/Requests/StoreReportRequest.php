<?php

namespace App\Http\Requests;

use App\Models\Report;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('report_create');
    }

    public function rules()
    {
        return [
            'month_id' => [
                'required',
                'integer',
            ],
            'publisher_id' => [
                'required',
                'integer',
            ],
            'publications' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'videos' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'hours' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'revisits' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'studies' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
