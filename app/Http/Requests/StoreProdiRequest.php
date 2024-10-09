<?php

namespace App\Http\Requests;

use App\Models\Prodi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProdiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prodi_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
            'fakultas_id' => [
                'required',
                'integer',
            ],
            'jenjang_id' => [
                'required',
                'integer',
            ],
            'code_siakad' => [
                'string',
                'nullable',
            ],
            'nim' => [
                'string',
                'nullable',
            ],
            'name_dikti' => [
                'string',
                'nullable',
            ],
            'name_akreditasi' => [
                'string',
                'nullable',
            ],
            'name_en' => [
                'string',
                'nullable',
            ],
            'gelar' => [
                'string',
                'nullable',
            ],
            'gelar_en' => [
                'string',
                'nullable',
            ],
            'tanggal_berdiri' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'sk_izin' => [
                'string',
                'nullable',
            ],
            'tgl_sk_izin' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
