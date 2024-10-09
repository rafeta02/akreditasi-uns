<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Akreditasi',
            'date_field' => 'tgl_akhir_sk',
            'field'      => 'no_sk',
            'prefix'     => 'NO SK',
            'suffix'     => 'Berakhir',
            'route'      => 'admin.akreditasis.edit',
        ],
        [
            'model'      => '\App\Models\AkreditasiIntenasional',
            'date_field' => 'tgl_akhir_sk',
            'field'      => 'no_sk',
            'prefix'     => 'NO SK',
            'suffix'     => 'Has Ended',
            'route'      => 'admin.akreditasi-intenasionals.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (! $crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
