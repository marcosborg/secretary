<?php

namespace App\Http\Requests;

use App\Models\ShepherdingReason;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShepherdingReasonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shepherding_reason_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
