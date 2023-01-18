<?php

namespace App\Http\Requests;

use App\Models\LifeMinistry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLifeMinistryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('life_ministry_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'reason' => [
                'string',
                'nullable',
            ],
        ];
    }
}
