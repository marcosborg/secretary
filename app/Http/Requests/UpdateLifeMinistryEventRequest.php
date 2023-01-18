<?php

namespace App\Http\Requests;

use App\Models\LifeMinistryEvent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLifeMinistryEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('life_ministry_event_edit');
    }

    public function rules()
    {
        return [
            'life_ministry_id' => [
                'required',
                'integer',
            ],
            'assignment_id' => [
                'required',
                'integer',
            ],
            'student_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
