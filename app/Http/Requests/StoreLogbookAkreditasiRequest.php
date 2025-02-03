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
                'required',
            ],
            'tanggal' => [
                'date_format:' . config('panel.date_format'),
                'required',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'satuan' => [
                'required',
                'nullable',
            ],
            'hasil_pekerjaan' => [
                'array',
            ],
        ];
    }
}
