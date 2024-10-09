<?php

namespace App\Http\Requests;

use App\Models\Ajuan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAjuanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ajuan_edit');
    }

    public function rules()
    {
        return [
            'tgl_ajuan' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'tgl_diterima' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'bukti_upload' => [
                'array',
            ],
        ];
    }
}
