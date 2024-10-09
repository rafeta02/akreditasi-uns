<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAkreditasiIntenasionalRequest;
use App\Http\Requests\StoreAkreditasiIntenasionalRequest;
use App\Http\Requests\UpdateAkreditasiIntenasionalRequest;
use App\Models\AkreditasiIntenasional;
use App\Models\Faculty;
use App\Models\Jenjang;
use App\Models\LembagaAkreditasi;
use App\Models\Prodi;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class AkreditasiIntenasionalController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('akreditasi_intenasional_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AkreditasiIntenasional::with(['fakultas', 'prodi', 'jenjang', 'lembaga'])->select(sprintf('%s.*', (new AkreditasiIntenasional)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'akreditasi_intenasional_show';
                $editGate      = 'akreditasi_intenasional_edit';
                $deleteGate    = 'akreditasi_intenasional_delete';
                $crudRoutePart = 'akreditasi-intenasionals';

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

            $table->editColumn('no_sk', function ($row) {
                return $row->no_sk ? $row->no_sk : '';
            });

            $table->editColumn('peringkat', function ($row) {
                return $row->peringkat ? AkreditasiIntenasional::PERINGKAT_SELECT[$row->peringkat] : '';
            });

            $table->editColumn('diakui_dikti', function ($row) {
                return $row->diakui_dikti ? "<span class='badge badge-info'>Sudah</span>" : '<span class="badge badge-danger">Belum</span>';
            });

            $table->editColumn('nilai', function ($row) {
                return $row->nilai ? $row->nilai : '';
            });
            $table->editColumn('sertifikat', function ($row) {
                if ($photo = $row->sertifikat) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'prodi', 'lembaga', 'sertifikat', 'diakui_dikti']);

            return $table->make(true);
        }

        return view('admin.akreditasiIntenasionals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('akreditasi_intenasional_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::where('type', 'internasional')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.akreditasiIntenasionals.create', compact('fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function store(StoreAkreditasiIntenasionalRequest $request)
    {
        $prodi = Prodi::find($request->input('prodi_id'));
        $request->request->add(['jenjang_id' => $prodi->jenjang_id]);
        $request->request->add(['tahun_expired' => Carbon::parse($request->input('tgl_akhir_sk'))->format('Y')]);

        $akreditasiIntenasional = AkreditasiIntenasional::create($request->all());

        if ($request->input('sertifikat', false)) {
            $akreditasiIntenasional->addMedia(storage_path('tmp/uploads/' . basename($request->input('sertifikat'))))->toMediaCollection('sertifikat');
        }

        foreach ($request->input('file_penunjang', []) as $file) {
            $akreditasiIntenasional->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_penunjang');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $akreditasiIntenasional->id]);
        }

        return redirect()->route('admin.akreditasi-intenasionals.index');
    }

    public function edit(AkreditasiIntenasional $akreditasiIntenasional)
    {
        abort_if(Gate::denies('akreditasi_intenasional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $akreditasiIntenasional->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.akreditasiIntenasionals.edit', compact('akreditasiIntenasional', 'fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function update(UpdateAkreditasiIntenasionalRequest $request, AkreditasiIntenasional $akreditasiIntenasional)
    {
        $akreditasiIntenasional->update($request->all());

        if ($request->input('sertifikat', false)) {
            if (! $akreditasiIntenasional->sertifikat || $request->input('sertifikat') !== $akreditasiIntenasional->sertifikat->file_name) {
                if ($akreditasiIntenasional->sertifikat) {
                    $akreditasiIntenasional->sertifikat->delete();
                }
                $akreditasiIntenasional->addMedia(storage_path('tmp/uploads/' . basename($request->input('sertifikat'))))->toMediaCollection('sertifikat');
            }
        } elseif ($akreditasiIntenasional->sertifikat) {
            $akreditasiIntenasional->sertifikat->delete();
        }

        if (count($akreditasiIntenasional->file_penunjang) > 0) {
            foreach ($akreditasiIntenasional->file_penunjang as $media) {
                if (! in_array($media->file_name, $request->input('file_penunjang', []))) {
                    $media->delete();
                }
            }
        }
        $media = $akreditasiIntenasional->file_penunjang->pluck('file_name')->toArray();
        foreach ($request->input('file_penunjang', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $akreditasiIntenasional->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_penunjang');
            }
        }

        return redirect()->route('admin.akreditasi-intenasionals.index');
    }

    public function show(AkreditasiIntenasional $akreditasiIntenasional)
    {
        abort_if(Gate::denies('akreditasi_intenasional_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $akreditasiIntenasional->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.akreditasiIntenasionals.show', compact('akreditasiIntenasional'));
    }

    public function destroy(AkreditasiIntenasional $akreditasiIntenasional)
    {
        abort_if(Gate::denies('akreditasi_intenasional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $akreditasiIntenasional->delete();

        return back();
    }

    public function massDestroy(MassDestroyAkreditasiIntenasionalRequest $request)
    {
        $akreditasiIntenasionals = AkreditasiIntenasional::find(request('ids'));

        foreach ($akreditasiIntenasionals as $akreditasiIntenasional) {
            $akreditasiIntenasional->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('akreditasi_intenasional_create') && Gate::denies('akreditasi_intenasional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AkreditasiIntenasional();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
