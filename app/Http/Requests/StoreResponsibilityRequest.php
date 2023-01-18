<?php

namespace App\Http\Requests;

use App\Models\Responsibility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreResponsibilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('responsibility_create');
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
