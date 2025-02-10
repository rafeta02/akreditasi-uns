<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUraianLogbookRequest;
use App\Http\Requests\StoreUraianLogbookRequest;
use App\Http\Requests\UpdateUraianLogbookRequest;
use App\Models\UraianLogbook;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UraianLogbookController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('uraian_logbook_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UraianLogbook::query()->select(sprintf('%s.*', (new UraianLogbook)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'uraian_logbook_show';
                $editGate      = 'uraian_logbook_edit';
                $deleteGate    = 'uraian_logbook_delete';
                $crudRoutePart = 'uraian-logbooks';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? UraianLogbook::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.uraianLogbooks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('uraian_logbook_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.uraianLogbooks.create');
    }

    public function store(StoreUraianLogbookRequest $request)
    {
        $uraianLogbook = UraianLogbook::create($request->all());

        return redirect()->route('admin.uraian-logbooks.index');
    }

    public function edit(UraianLogbook $uraianLogbook)
    {
        abort_if(Gate::denies('uraian_logbook_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.uraianLogbooks.edit', compact('uraianLogbook'));
    }

    public function update(UpdateUraianLogbookRequest $request, UraianLogbook $uraianLogbook)
    {
        $uraianLogbook->update($request->all());

        return redirect()->route('admin.uraian-logbooks.index');
    }

    public function show(UraianLogbook $uraianLogbook)
    {
        abort_if(Gate::denies('uraian_logbook_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.uraianLogbooks.show', compact('uraianLogbook'));
    }

    public function destroy(UraianLogbook $uraianLogbook)
    {
        abort_if(Gate::denies('uraian_logbook_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uraianLogbook->delete();

        return back();
    }

    public function massDestroy(MassDestroyUraianLogbookRequest $request)
    {
        $uraianLogbooks = UraianLogbook::find(request('ids'));

        foreach ($uraianLogbooks as $uraianLogbook) {
            $uraianLogbook->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getUraian(Request $request)
    {
        $search = $request->search;
        $type = $request->tugas;
        
        $query = UraianLogbook::query()->where('type', $type);
        
        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }
        
        $uraians = $query->select('id', 'name as text')->get();
        
        return response()->json($uraians);
    }
}
