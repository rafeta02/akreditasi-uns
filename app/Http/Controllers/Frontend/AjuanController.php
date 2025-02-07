<?php

namespace App\Http\Controllers\Frontend;

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
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AjuanController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('ajuan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ajuans = Ajuan::with([ 'asesors', 'diajukan_by', 'media'])->get();

        return view('frontend.ajuans.index', compact('ajuans'));
    }

    public function create()
    {
        abort_if(Gate::denies('ajuan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.ajuans.create', compact('lembagas'));
    }

    public function store(StoreAjuanRequest $request)
    {   
        dd($request->all());
        $ajuan = Ajuan::create($request->all());
        // $ajuan->asesors()->sync($request->input('asesors', []));
        // foreach ($request->input('surat_tugas', []) as $file) {
        //     $ajuan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('surat_tugas');
        // }

        // foreach ($request->input('surat_pernyataan', []) as $file) {
        //     $ajuan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('surat_pernyataan');
        // }

        // foreach ($request->input('bukti_upload', []) as $file) {
        //     $ajuan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('bukti_upload');
        // }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ajuan->id]);
        }

        foreach($request->nama_dokumen as $index => $nama) {
            $dokumen = DokumenAkreditasi::create([
                'ajuan_id' => $ajuan->id,
                'name' => $nama,
                'type' => $request->tipe_dokumen[$index] ,
                'counter',
                'owned_by_id',

                'nama' => $nama,
                'tipe' => $request->tipe_dokumen[$index],
                'owned_by' => auth()->id()
            ]);

            if(isset($request->dokumen[$index])) {
                foreach($request->dokumen[$index] as $file) {
                    $fileName = $request->tipe_dokumen[$index] . '_' . $nama . '_' . uniqid() . '.' . pathinfo($file, PATHINFO_EXTENSION);
                    
                    $dokumen->addMedia(storage_path('tmp/uploads/' . $file))
                        ->usingName($fileName)
                        ->usingFileName($fileName)
                        ->toMediaCollection('dokumen');
                }
            }
        }

        return redirect()->route('frontend.ajuans.index');
    }

    public function edit(Ajuan $ajuan)
    {
        abort_if(Gate::denies('ajuan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas = Faculty::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prodis = Prodi::pluck('name_dikti', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jenjangs = Jenjang::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lembagas = LembagaAkreditasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asesors = User::pluck('name', 'id');

        $diajukan_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ajuan->load('fakultas', 'prodi', 'jenjang', 'lembaga', 'asesors', 'diajukan_by');

        return view('frontend.ajuans.edit', compact('ajuan', 'asesors', 'diajukan_bies', 'fakultas', 'jenjangs', 'lembagas', 'prodis'));
    }

    public function update(UpdateAjuanRequest $request, Ajuan $ajuan)
    {
        $ajuan->update($request->all());
        $ajuan->asesors()->sync($request->input('asesors', []));
        if (count($ajuan->surat_tugas) > 0) {
            foreach ($ajuan->surat_tugas as $media) {
                if (! in_array($media->file_name, $request->input('surat_tugas', []))) {
                    $media->delete();
                }
            }
        }
        $media = $ajuan->surat_tugas->pluck('file_name')->toArray();
        foreach ($request->input('surat_tugas', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $ajuan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('surat_tugas');
            }
        }

        if (count($ajuan->surat_pernyataan) > 0) {
            foreach ($ajuan->surat_pernyataan as $media) {
                if (! in_array($media->file_name, $request->input('surat_pernyataan', []))) {
                    $media->delete();
                }
            }
        }
        $media = $ajuan->surat_pernyataan->pluck('file_name')->toArray();
        foreach ($request->input('surat_pernyataan', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $ajuan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('surat_pernyataan');
            }
        }

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

        return redirect()->route('frontend.ajuans.index');
    }

    public function show(Ajuan $ajuan)
    {
        abort_if(Gate::denies('ajuan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ajuan->load('fakultas', 'prodi', 'jenjang', 'lembaga', 'asesors', 'diajukan_by');

        return view('frontend.ajuans.show', compact('ajuan'));
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
