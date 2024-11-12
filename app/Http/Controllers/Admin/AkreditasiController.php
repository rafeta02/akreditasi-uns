<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAkreditasiRequest;
use App\Http\Requests\StoreAkreditasiRequest;
use App\Http\Requests\UpdateAkreditasiRequest;
use App\Models\Akreditasi;
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
use Illuminate\Support\Str;
use Alert;
use DB;
use App\Imports\AkreditasiImport;

class AkreditasiController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('akreditasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Akreditasi::with(['fakultas', 'prodi', 'jenjang', 'lembaga'])->select(sprintf('%s.*', (new Akreditasi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'akreditasi_show';
                $editGate      = 'akreditasi_edit';
                $deleteGate    = 'akreditasi_delete';
                $crudRoutePart = 'akreditasis';

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
                return $row->peringkat ? Akreditasi::PERINGKAT_SELECT[$row->peringkat] : '';
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

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'prodi', 'lembaga', 'sertifikat']);

            return $table->make(true);
        }

        return view('admin.akreditasis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('akreditasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lembagas = LembagaAkreditasi::where('type', 'nasional')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.akreditasis.create', compact('lembagas'));
    }

    public function store(StoreAkreditasiRequest $request)
    {
        $prodi = Prodi::find($request->input('prodi_id'));
        $lembaga = LembagaAkreditasi::find($request->input('lembaga_id'));
        $request->request->add(['fakultas_id' => $prodi->fakultas_id]);
        $request->request->add(['jenjang_id' => $prodi->jenjang_id]);
        $request->request->add(['tahun_expired' => Carbon::parse($request->input('tgl_akhir_sk'))->format('Y')]);

        try {
            DB::transaction(function () use ($request, $prodi, $lembaga) {
                $akreditasi = Akreditasi::create($request->all());

                $prodi_name = Str::slug($prodi->jenjang->name . '-' . $prodi->name_dikti);

                if ($request->input('sertifikat', false)) {
                    $lembaga = Str::slug($lembaga->name);
                    $tgl_awal = Carbon::parse($request->input('tgl_sk'))->format('d-m-Y');
                    $tgl_akhir = Carbon::parse($request->input('tgl_akhir_sk'))->format('d-m-Y');

                    $filePath = storage_path('tmp/uploads/' . basename($request->input('sertifikat')));
                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

                    $sertifikatNewName = 'sertifikat_' . $prodi_name . '_' . $lembaga . '_' . $tgl_awal . '_sd_' . $tgl_akhir . '_' . uniqid(). '.' . $extension;

                    $newFilePath = storage_path('tmp/uploads/' . $sertifikatNewName);
                    rename($filePath, $newFilePath);

                    if (file_exists($newFilePath)) {
                        $akreditasi->addMedia($newFilePath)->toMediaCollection('sertifikat');
                    } else {
                        throw new \Exception('File does not exist at path: ' . $newFilePath);
                    }
                }

                foreach ($request->input('file_penunjang', []) as $file) {
                    $filePath = storage_path('tmp/uploads/' . basename($file));
                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);

                    $filePenunjangNewName = 'file_penunjang_' . $prodi_name . '_' . uniqid() . '.' . $extension;

                    $newFilePath = storage_path('tmp/uploads/' . $filePenunjangNewName);
                    rename($filePath, $newFilePath);

                    if (file_exists($newFilePath)) {
                        $akreditasi->addMedia($newFilePath)->toMediaCollection('file_penunjang');
                    } else {
                        throw new \Exception('File does not exist at path: ' . $newFilePath);
                    }
                }

                if ($media = $request->input('ck-media', false)) {
                    Media::whereIn('id', $media)->update(['model_id' => $akreditasi->id]);
                }
            });

            Alert::success('Success', 'Akreditasi Berhasil Disimpan');
        } catch (\Exception $e) {
            Alert::error('Error', "Failed: " . $e->getMessage());
        }

        return redirect()->route('admin.akreditasis.index');
    }

    public function edit(Akreditasi $akreditasi)
    {
        abort_if(Gate::denies('akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $akreditasi->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.akreditasis.edit', compact('akreditasi', 'fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function uploadSertifikat(Akreditasi $akreditasi)
    {
        abort_if(Gate::denies('akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $akreditasi->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.akreditasis.upload_sertif', compact('akreditasi', 'fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function update(UpdateAkreditasiRequest $request, Akreditasi $akreditasi)
    {
        $akreditasi->update($request->all());

        if ($request->input('sertifikat', false)) {
            if (! $akreditasi->sertifikat || $request->input('sertifikat') !== $akreditasi->sertifikat->file_name) {
                if ($akreditasi->sertifikat) {
                    $akreditasi->sertifikat->delete();
                }
                $akreditasi->addMedia(storage_path('tmp/uploads/' . basename($request->input('sertifikat'))))->toMediaCollection('sertifikat');
            }
        } elseif ($akreditasi->sertifikat) {
            $akreditasi->sertifikat->delete();
        }

        if (count($akreditasi->file_penunjang) > 0) {
            foreach ($akreditasi->file_penunjang as $media) {
                if (! in_array($media->file_name, $request->input('file_penunjang', []))) {
                    $media->delete();
                }
            }
        }
        $media = $akreditasi->file_penunjang->pluck('file_name')->toArray();
        foreach ($request->input('file_penunjang', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $akreditasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_penunjang');
            }
        }

        return redirect()->route('admin.akreditasis.index');
    }

    public function show(Akreditasi $akreditasi)
    {
        abort_if(Gate::denies('akreditasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $akreditasi->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.akreditasis.show', compact('akreditasi'));
    }

    public function destroy(Akreditasi $akreditasi)
    {
        abort_if(Gate::denies('akreditasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $akreditasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyAkreditasiRequest $request)
    {
        $akreditasis = Akreditasi::find(request('ids'));

        foreach ($akreditasis as $akreditasi) {
            $akreditasi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('akreditasi_create') && Gate::denies('akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Akreditasi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function import(Request $request)
    {
        $file = $request->file('import_file');
        $request->validate([
            'import_file' => 'mimes:csv,xls,xlsx',
        ]);

        Excel::import(new AkreditasiImport(), $file);

        Alert::success('Success', 'Akreditasi Nasional berhasil di import');
        return redirect()->back();
    }
}
