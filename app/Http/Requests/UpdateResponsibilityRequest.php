<?php

namespace App\Http\Requests;

use App\Models\Responsibility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateResponsibilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('responsibility_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:255',
                'required',
            ],
        ];
    }
}
