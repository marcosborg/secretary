<?php

namespace App\Http\Requests;

use App\Models\Responsibility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyResponsibilityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('responsibility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:responsibilities,id',
        ];
    }
}
