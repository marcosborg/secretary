<?php

namespace App\Http\Requests;

use App\Models\ImportantDate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyImportantDateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('important_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:important_dates,id',
        ];
    }
}
