<?php

namespace App\Http\Requests;

use App\Models\ClmMeeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyClmMeetingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('clm_meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:clm_meetings,id',
        ];
    }
}
