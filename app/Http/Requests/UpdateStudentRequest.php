<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('student_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'gender' => [
                'required',
            ],
            'responsibility' => [
                'required',
            ],
            'assignments.*' => [
                'integer',
            ],
            'assignments' => [
                'array',
            ],
        ];
    }
}
