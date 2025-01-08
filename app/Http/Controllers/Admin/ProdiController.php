<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProdiRequest;
use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;
use App\Models\Faculty;
use App\Models\Jenjang;
use App\Models\Prodi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\ProdiImport;
use Alert;
use Excel;

class ProdiController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('prodi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Prodi::with(['fakultas', 'jenjang'])->select(sprintf('%s.*', (new Prodi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'prodi_show';
                $editGate      = 'prodi_edit';
                $deleteGate    = 'prodi_delete';
                $crudRoutePart = 'prodis';

                return view('partials.akreditasiActions', compact(
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
            $table->addColumn('fakultas_name', function ($row) {
                return $row->fakultas ? $row->fakultas->name : '';
            });

            $table->addColumn('jenjang_name', function ($row) {
                return $row->jenjang ? $row->jenjang->name : '';
            });

            $table->editColumn('name_dikti', function ($row) {
                return $row->name_dikti ? $row->name_dikti : '';
            });
            $table->editColumn('name_en', function ($row) {
                return $row->name_en ? $row->name_en : '';
            });
            $table->editColumn('gelar', function ($row) {
                return $row->gelar ? $row->gelar : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'jenjang']);

            return $table->make(true);
        }

        return view('admin.prodis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('prodi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.prodis.create', compact('fakultas', 'jenjangs'));
    }

    public function store(StoreProdiRequest $request)
    {
        $prodi = Prodi::create($request->all());

        foreach ($request->input('file_sk_pendirian', []) as $file) {
            $prodi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_sk_pendirian');
        }

        return redirect()->route('admin.prodis.index');
    }

    public function edit(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodi->load('fakultas', 'jenjang');

        return view('admin.prodis.edit', compact('fakultas', 'jenjangs', 'prodi'));
    }

    public function uploadSertifikat(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodi->load('fakultas', 'jenjang');

        return view('admin.prodis.upload_sertif', compact('prodi'));
    }

    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {
        $prodi->update($request->all());

        if (count($prodi->file_sk_pendirian) > 0) {
            foreach ($prodi->file_sk_pendirian as $media) {
                if (! in_array($media->file_name, $request->input('file_sk_pendirian', []))) {
                    $media->delete();
                }
            }
        }
        $media = $prodi->file_sk_pendirian->pluck('file_name')->toArray();
        foreach ($request->input('file_sk_pendirian', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $prodi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_sk_pendirian');
            }
        }

        return redirect()->route('admin.prodis.index');
    }

    public function show(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodi->load('fakultas', 'jenjang');

        return view('admin.prodis.show', compact('prodi'));
    }

    public function destroy(Prodi $prodi)
    {
        abort_if(Gate::denies('prodi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prodi->delete();

        return back();
    }

    public function massDestroy(MassDestroyProdiRequest $request)
    {
        $prodis = Prodi::find(request('ids'));

        foreach ($prodis as $prodi) {
            $prodi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function import(Request $request)
    {
        $file = $request->file('import_file');
        $request->validate([
            'import_file' => 'mimes:csv,xls,xlsx',
        ]);

        Excel::import(new ProdiImport(), $file);

        Alert::success('Success', 'Prodi berhasil di import');
        return redirect()->back();
    }

    public function getProdisWithFakultas(Request $request)
    {
        $query = $request->input('q');

        $prodis = Prodi::where('name_dikti', 'like', '%' . $query . '%')
            ->orWhere('name_akreditasi', 'like', '%' . $query . '%')
            ->orWhere('name_en', 'like', '%' . $query . '%')
            ->orWhereHas('fakultas', function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->with('fakultas')
            ->get();

        $results = [];
        foreach ($prodis as $prodi) {
            $fakultas = $prodi->fakultas->name;
            if (!isset($results[$fakultas])) {
                $results[$fakultas] = [];
            }
            $results[$fakultas][] = [
                'id' => $prodi->id,
                'text' => $prodi->jenjang->name . ' - ' . $prodi->name_dikti
            ];
        }

        $formattedResults = [];
        foreach ($results as $fakultas => $prodi) {
            $formattedResults[] = [
                'text' => $fakultas,
                'children' => $prodi
            ];
        }

        return response()->json($formattedResults);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('prodi_create') && Gate::denies('prodi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Prodi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
