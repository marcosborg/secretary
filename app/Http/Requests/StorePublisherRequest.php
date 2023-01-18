<?php

namespace App\Http\Requests;

use App\Models\Publisher;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePublisherRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('publisher_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:255',
                'required',
            ],
            'full_name' => [
                'string',
                'max:255',
                'nullable',
            ],
            'address' => [
                'string',
                'max:255',
                'nullable',
            ],
            'phone' => [
                'string',
                'max:255',
                'nullable',
            ],
            'emergency' => [
                'string',
                'max:255',
                'nullable',
            ],
            'celphone' => [
                'string',
                'max:255',
                'nullable',
            ],
            'baptism' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'responsibilities.*' => [
                'integer',
            ],
            'responsibilities' => [
                'array',
            ],
            'dav_expiration' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
