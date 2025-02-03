<?php

namespace App\Http\Requests;

use App\Models\DokumenAkreditasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDokumenAkreditasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dokumen_akreditasi_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'note' => [
                'string',
                'nullable',
            ],
        ];
    }
}
