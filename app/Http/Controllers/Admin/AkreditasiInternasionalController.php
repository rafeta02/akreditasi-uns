<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAkreditasiInternasionalRequest;
use App\Http\Requests\StoreAkreditasiInternasionalRequest;
use App\Http\Requests\UpdateAkreditasiInternasionalRequest;
use App\Models\AkreditasiInternasional;
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
use App\Imports\AkreditasiInternasionalImport;
use Excel;


class AkreditasiInternasionalController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('akreditasi_internasional_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AkreditasiInternasional::with(['fakultas', 'prodi', 'jenjang', 'lembaga'])->select(sprintf('%s.*', (new AkreditasiInternasional)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'akreditasi_internasional_show';
                $editGate      = 'akreditasi_internasional_edit';
                $deleteGate    = 'akreditasi_internasional_delete';
                $crudRoutePart = 'akreditasi-internasionals';

                return view('partials.akreditasiActions', compact(
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

            $table->editColumn('diakui_dikti', function ($row) {
                return $row->diakui_dikti ? "<span class='badge badge-info'>Sudah</span>" : '<span class="badge badge-danger">Belum</span>';
            });

            $table->editColumn('peringkat', function ($row) {
                return $row->peringkat ? AkreditasiInternasional::PERINGKAT_SELECT[$row->peringkat] : '';
            });
            $table->editColumn('nilai', function ($row) {
                return $row->nilai ? $row->nilai : '';
            });
            $table->editColumn('sertifikat', function ($row) {
                if ($photo = $row->sertifikat) {
                    return sprintf(
                        '<a href="%s" class="image-popup"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'fakultas', 'prodi', 'lembaga', 'sertifikat', 'diakui_dikti']);

            return $table->make(true);
        }

        return view('admin.akreditasiInternasionals.index');
    }

    public function create()
    {
        abort_if(Gate::denies('akreditasi_internasional_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lembagas = LembagaAkreditasi::where('type', 'internasional')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.akreditasiInternasionals.create', compact('lembagas'));
    }

    public function store(StoreAkreditasiInternasionalRequest $request)
    {
        $prodi = Prodi::find($request->input('prodi_id'));
        $lembaga = LembagaAkreditasi::find($request->input('lembaga_id'));
        $request->request->add(['fakultas_id' => $prodi->fakultas_id]);
        $request->request->add(['jenjang_id' => $prodi->jenjang_id]);
        $request->request->add(['tahun_expired' => Carbon::parse($request->input('tgl_akhir_sk'))->format('Y')]);

        try {
            DB::transaction(function () use ($request, $prodi, $lembaga) {
                $akreditasiInternasional = AkreditasiInternasional::create($request->all());

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
                        $akreditasiInternasional->addMedia($newFilePath)->toMediaCollection('sertifikat');
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
                        $akreditasiInternasional->addMedia($newFilePath)->toMediaCollection('file_penunjang');
                    } else {
                        throw new \Exception('File does not exist at path: ' . $newFilePath);
                    }
                }

                if ($media = $request->input('ck-media', false)) {
                    Media::whereIn('id', $media)->update(['model_id' => $akreditasiInternasional->id]);
                }
            });

            Alert::success('Success', 'Akreditasi Internasional Berhasil Disimpan');
        } catch (\Exception $e) {
            Alert::error('Error', "Failed: " . $e->getMessage());
        }

        return redirect()->route('admin.akreditasi-internasionals.index');
    }

    public function edit(AkreditasiInternasional $akreditasiInternasional)
    {
        abort_if(Gate::denies('akreditasi_internasional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $akreditasiInternasional->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.akreditasiInternasionals.edit', compact('akreditasiInternasional', 'fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function uploadSertifikat(AkreditasiInternasional $akreditasiInternasional)
    {
        abort_if(Gate::denies('akreditasi_internasional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $akreditasiInternasional->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.akreditasiInternasionals.upload_sertif', compact('akreditasiInternasional', 'fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function update(UpdateAkreditasiInternasionalRequest $request, AkreditasiInternasional $akreditasiInternasional)
    {
        $akreditasiInternasional->update($request->all());

        if ($request->input('sertifikat', false)) {
            if (! $akreditasiInternasional->sertifikat || $request->input('sertifikat') !== $akreditasiInternasional->sertifikat->file_name) {
                if ($akreditasiInternasional->sertifikat) {
                    $akreditasiInternasional->sertifikat->delete();
                }
                $akreditasiInternasional->addMedia(storage_path('tmp/uploads/' . basename($request->input('sertifikat'))))->toMediaCollection('sertifikat');
            }
        } elseif ($akreditasiInternasional->sertifikat) {
            $akreditasiInternasional->sertifikat->delete();
        }

        if (count($akreditasiInternasional->file_penunjang) > 0) {
            foreach ($akreditasiInternasional->file_penunjang as $media) {
                if (! in_array($media->file_name, $request->input('file_penunjang', []))) {
                    $media->delete();
                }
            }
        }
        $media = $akreditasiInternasional->file_penunjang->pluck('file_name')->toArray();
        foreach ($request->input('file_penunjang', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $akreditasiInternasional->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file_penunjang');
            }
        }

        return redirect()->route('admin.akreditasi-internasionals.index');
    }

    public function show(AkreditasiInternasional $akreditasiInternasional)
    {
        abort_if(Gate::denies('akreditasi_internasional_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $akreditasiInternasional->load('fakultas', 'prodi', 'jenjang', 'lembaga');

        return view('admin.akreditasiInternasionals.show', compact('akreditasiInternasional'));
    }

    public function destroy(AkreditasiInternasional $akreditasiInternasional)
    {
        abort_if(Gate::denies('akreditasi_internasional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $akreditasiInternasional->delete();

        return back();
    }

    public function massDestroy(MassDestroyAkreditasiInternasionalRequest $request)
    {
        $akreditasiInternasionals = AkreditasiInternasional::find(request('ids'));

        foreach ($akreditasiInternasionals as $akreditasiInternasional) {
            $akreditasiInternasional->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('akreditasi_internasional_create') && Gate::denies('akreditasi_internasional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AkreditasiInternasional();
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

        Excel::import(new AkreditasiInternasionalImport(), $file);

        Alert::success('Success', 'Akreditasi Internasional berhasil di import');
        return redirect()->back();
    }
}
