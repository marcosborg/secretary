<?php

namespace App\Http\Requests;

use App\Models\ClmMeeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClmMeetingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('clm_meeting_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
