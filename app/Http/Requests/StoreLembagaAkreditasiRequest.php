<?php

namespace App\Http\Requests;

use App\Models\LembagaAkreditasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLembagaAkreditasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lembaga_akreditasi_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
