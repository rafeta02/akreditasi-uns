<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLembagaAkreditasiRequest;
use App\Http\Requests\StoreLembagaAkreditasiRequest;
use App\Http\Requests\UpdateLembagaAkreditasiRequest;
use App\Models\LembagaAkreditasi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LembagaAkreditasiController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lembaga_akreditasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LembagaAkreditasi::query()->select(sprintf('%s.*', (new LembagaAkreditasi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'lembaga_akreditasi_show';
                $editGate      = 'lembaga_akreditasi_edit';
                $deleteGate    = 'lembaga_akreditasi_delete';
                $crudRoutePart = 'lembaga-akreditasis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? LembagaAkreditasi::TYPE_SELECT[$row->type] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.lembagaAkreditasis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lembaga_akreditasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lembagaAkreditasis.create');
    }

    public function store(StoreLembagaAkreditasiRequest $request)
    {
        $lembagaAkreditasi = LembagaAkreditasi::create($request->all());

        return redirect()->route('admin.lembaga-akreditasis.index');
    }

    public function edit(LembagaAkreditasi $lembagaAkreditasi)
    {
        abort_if(Gate::denies('lembaga_akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lembagaAkreditasis.edit', compact('lembagaAkreditasi'));
    }

    public function update(UpdateLembagaAkreditasiRequest $request, LembagaAkreditasi $lembagaAkreditasi)
    {
        $lembagaAkreditasi->update($request->all());

        return redirect()->route('admin.lembaga-akreditasis.index');
    }

    public function show(LembagaAkreditasi $lembagaAkreditasi)
    {
        abort_if(Gate::denies('lembaga_akreditasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lembagaAkreditasis.show', compact('lembagaAkreditasi'));
    }

    public function destroy(LembagaAkreditasi $lembagaAkreditasi)
    {
        abort_if(Gate::denies('lembaga_akreditasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lembagaAkreditasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyLembagaAkreditasiRequest $request)
    {
        $lembagaAkreditasis = LembagaAkreditasi::find(request('ids'));

        foreach ($lembagaAkreditasis as $lembagaAkreditasi) {
            $lembagaAkreditasi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
