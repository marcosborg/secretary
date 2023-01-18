<?php

namespace App\Http\Requests;

use App\Models\LifeMinistryEvent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLifeMinistryEventRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('life_ministry_event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:life_ministry_events,id',
        ];
    }
}
