<?php

namespace App\Http\Requests;

use App\Models\LogbookAkreditasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLogbookAkreditasiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('logbook_akreditasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:logbook_akreditasis,id',
        ];
    }
}
