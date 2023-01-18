<?php

namespace App\Http\Requests;

use App\Models\Meeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMeetingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('meeting_create');
    }

    public function rules()
    {
        return [
            'month_id' => [
                'required',
                'integer',
            ],
            'week' => [
                'required',
            ],
            'meeting' => [
                'required',
            ],
            'presences' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
