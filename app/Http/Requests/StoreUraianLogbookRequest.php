<?php

namespace App\Http\Requests;

use App\Models\UraianLogbook;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUraianLogbookRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('uraian_logbook_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
