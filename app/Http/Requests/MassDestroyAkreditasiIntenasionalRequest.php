<?php

namespace App\Http\Requests;

use App\Models\AkreditasiIntenasional;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAkreditasiIntenasionalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('akreditasi_intenasional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:akreditasi_intenasionals,id',
        ];
    }
}
