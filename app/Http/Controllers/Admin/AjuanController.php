<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAjuanRequest;
use App\Http\Requests\StoreAjuanRequest;
use App\Http\Requests\UpdateAjuanRequest;
use App\Models\Ajuan;
use App\Models\Faculty;
use App\Models\Jenjang;
use App\Models\LembagaAkreditasi;
use App\Models\Prodi;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AjuanController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ajuan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ajuan::with(['fakultas', 'prodi', 'jenjang', 'lembaga'])->select(sprintf('%s.*', (new Ajuan)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'ajuan_show';
                $editGate      = 'ajuan_edit';
                $deleteGate    = 'ajuan_delete';
                $crudRoutePart = 'ajuans';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('fakultas_name', function ($row) {
                return $row->fakultas ? $row->fakultas->name : '';
            });

            $table->addColumn('prodi_name_dikti', function ($row) {
                return $row->prodi ? $row->jenjang->name. ' - '.  $row->prodi->name_dikti : '';
            });

            $table->addColumn('lembaga_name', function ($row) {
                return $row->lembaga ? $row->lembaga->name : '';
            });

            $table->editColumn('status_ajuan', function ($row) {
                return $row->status_ajuan ? Ajuan::STATUS_AJUAN_SELECT[$row->status_ajuan] : '';
            });
            $table->editColumn('bukti_upload', function ($row) {
                if (! $row->bukti_upload) {
                    return '';
                }
                $links = [];
                foreach ($row->bukti_upload as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'prodi', 'lembaga', 'bukti_upload']);

            return $table->make(true);
        }

        return view('admin.ajuans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ajuan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ajuans.create', compact('fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function store(StoreAjuanRequest $request)
    {
        $prodi = Prodi::find($request->input('prodi_id'));
        $request->request->add(['jenjang_id' => $prodi->jenjang_id]);

        $ajuan = Ajuan::create($request->all());

        foreach ($request->input('bukti_upload', []) as $file) {
            $ajuan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_upload');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ajuan->id]);
        }

        return redirect()->route('admin.ajuans.index');
    }

    public function edit(Ajuan $ajuan)
    {
        abort_if(Gate::denies('ajuan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ajuan->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.ajuans.edit', compact('ajuan', 'fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function update(UpdateAjuanRequest $request, Ajuan $ajuan)
    {
        $ajuan->update($request->all());

        if (count($ajuan->bukti_upload) > 0) {
            foreach ($ajuan->bukti_upload as $media) {
                if (! in_array($media->file_name, $request->input('bukti_upload', []))) {
                    $media->delete();
                }
            }
        }
        $media = $ajuan->bukti_upload->pluck('file_name')->toArray();
        foreach ($request->input('bukti_upload', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $ajuan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_upload');
            }
        }

        return redirect()->route('admin.ajuans.index');
    }

    public function show(Ajuan $ajuan)
    {
        abort_if(Gate::denies('ajuan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ajuan->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.ajuans.show', compact('ajuan'));
    }

    public function destroy(Ajuan $ajuan)
    {
        abort_if(Gate::denies('ajuan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ajuan->delete();

        return back();
    }

    public function massDestroy(MassDestroyAjuanRequest $request)
    {
        $ajuans = Ajuan::find(request('ids'));

        foreach ($ajuans as $ajuan) {
            $ajuan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ajuan_create') && Gate::denies('ajuan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Ajuan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
