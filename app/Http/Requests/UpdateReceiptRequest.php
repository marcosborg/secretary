<?php

namespace App\Http\Requests;

use App\Models\Receipt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReceiptRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('receipt_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'photo' => [
                'required',
            ],
            'completed_by_id' => [
                'required',
                'integer',
            ],
            'verified_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
