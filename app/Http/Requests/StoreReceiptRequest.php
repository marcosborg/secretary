<?php

namespace App\Http\Requests;

use App\Models\Receipt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReceiptRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('receipt_create');
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
