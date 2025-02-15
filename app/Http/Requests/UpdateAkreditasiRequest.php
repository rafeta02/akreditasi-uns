<?php

namespace App\Http\Requests;

use App\Models\Akreditasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAkreditasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('akreditasi_edit');
    }

    public function rules()
    {
        return [
            'no_sk' => [
                'string',
                'nullable',
            ],
            'tgl_sk' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'tgl_akhir_sk' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'tahun_expired' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'nilai' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'file_penunjang' => [
                'array',
            ],
        ];
    }
}
