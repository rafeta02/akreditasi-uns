<?php

namespace App\Http\Requests;

use App\Models\LembagaAkreditasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLembagaAkreditasiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lembaga_akreditasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lembaga_akreditasis,id',
        ];
    }
}
