<?php

namespace App\Http\Requests;

use App\Models\LogbookAkreditasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLogbookAkreditasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('logbook_akreditasi_create');
    }

    public function rules()
    {
        return [
            'detail' => [
                'string',
                'nullable',
            ],
            'tanggal' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'jumlah' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'satuan' => [
                'string',
                'nullable',
            ],
            'hasil_pekerjaan' => [
                'array',
            ],
        ];
    }
}
