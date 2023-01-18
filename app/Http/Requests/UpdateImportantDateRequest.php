<?php

namespace App\Http\Requests;

use App\Models\ImportantDate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateImportantDateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('important_date_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:255',
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
