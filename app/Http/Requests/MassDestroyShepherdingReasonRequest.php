<?php

namespace App\Http\Requests;

use App\Models\ShepherdingReason;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyShepherdingReasonRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('shepherding_reason_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:shepherding_reasons,id',
        ];
    }
}
