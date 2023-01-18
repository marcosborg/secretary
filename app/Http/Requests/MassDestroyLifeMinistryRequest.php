<?php

namespace App\Http\Requests;

use App\Models\LifeMinistry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLifeMinistryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('life_ministry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:life_ministries,id',
        ];
    }
}
