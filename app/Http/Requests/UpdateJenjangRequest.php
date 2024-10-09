<?php

namespace App\Http\Requests;

use App\Models\Jenjang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJenjangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jenjang_edit');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
