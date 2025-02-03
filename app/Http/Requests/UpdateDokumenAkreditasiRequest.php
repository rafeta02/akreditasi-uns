<?php

namespace App\Http\Requests;

use App\Models\DokumenAkreditasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDokumenAkreditasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dokumen_akreditasi_edit');
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
