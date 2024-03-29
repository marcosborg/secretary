<?php

namespace App\Http\Requests;

use App\Models\EldersMeeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEldersMeetingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('elders_meeting_edit');
    }

    public function rules()
    {
        return [
            'datetime' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'subject' => [
                'string',
                'max:255',
                'required',
            ],
        ];
    }
}
