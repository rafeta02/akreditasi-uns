<?php

namespace App\Http\Requests;

use App\Models\UraianLogbook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUraianLogbookRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('uraian_logbook_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:uraian_logbooks,id',
        ];
    }
}
