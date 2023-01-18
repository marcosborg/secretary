<?php

namespace App\Http\Requests;

use App\Models\EldersMeeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEldersMeetingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('elders_meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:elders_meetings,id',
        ];
    }
}
