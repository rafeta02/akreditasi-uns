<?php

namespace App\Http\Requests;

use App\Models\DokumenAkreditasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDokumenAkreditasiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('dokumen_akreditasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:dokumen_akreditasis,id',
        ];
    }
}
