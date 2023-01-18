<?php

namespace App\Http\Requests;

use App\Models\ShepherdingVisit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyShepherdingVisitRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('shepherding_visit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:shepherding_visits,id',
        ];
    }
}
