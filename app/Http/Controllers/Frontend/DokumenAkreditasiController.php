<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDokumenAkreditasiRequest;
use App\Http\Requests\StoreDokumenAkreditasiRequest;
use App\Http\Requests\UpdateDokumenAkreditasiRequest;
use App\Models\Ajuan;
use App\Models\DokumenAkreditasi;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DokumenAkreditasiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('dokumen_akreditasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dokumenAkreditasis = DokumenAkreditasi::with(['ajuan', 'owned_by', 'media'])->get();

        return view('frontend.dokumenAkreditasis.index', compact('dokumenAkreditasis'));
    }

    public function create()
    {
        abort_if(Gate::denies('dokumen_akreditasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ajuans = Ajuan::pluck('tgl_ajuan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.dokumenAkreditasis.create', compact('ajuans', 'owned_bies'));
    }

    public function store(StoreDokumenAkreditasiRequest $request)
    {
        $dokumenAkreditasi = DokumenAkreditasi::create($request->all());

        if ($request->input('file', false)) {
            $dokumenAkreditasi->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dokumenAkreditasi->id]);
        }

        return redirect()->route('frontend.dokumen-akreditasis.index');
    }

    public function edit(DokumenAkreditasi $dokumenAkreditasi)
    {
        abort_if(Gate::denies('dokumen_akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ajuans = Ajuan::pluck('tgl_ajuan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dokumenAkreditasi->load('ajuan', 'owned_by');

        return view('frontend.dokumenAkreditasis.edit', compact('ajuans', 'dokumenAkreditasi', 'owned_bies'));
    }

    public function update(UpdateDokumenAkreditasiRequest $request, DokumenAkreditasi $dokumenAkreditasi)
    {
        $dokumenAkreditasi->update($request->all());

        if ($request->input('file', false)) {
            if (! $dokumenAkreditasi->file || $request->input('file') !== $dokumenAkreditasi->file->file_name) {
                if ($dokumenAkreditasi->file) {
                    $dokumenAkreditasi->file->delete();
                }
                $dokumenAkreditasi->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($dokumenAkreditasi->file) {
            $dokumenAkreditasi->file->delete();
        }

        return redirect()->route('frontend.dokumen-akreditasis.index');
    }

    public function show(DokumenAkreditasi $dokumenAkreditasi)
    {
        abort_if(Gate::denies('dokumen_akreditasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dokumenAkreditasi->load('ajuan', 'owned_by');

        return view('frontend.dokumenAkreditasis.show', compact('dokumenAkreditasi'));
    }

    public function destroy(DokumenAkreditasi $dokumenAkreditasi)
    {
        abort_if(Gate::denies('dokumen_akreditasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dokumenAkreditasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyDokumenAkreditasiRequest $request)
    {
        $dokumenAkreditasis = DokumenAkreditasi::find(request('ids'));

        foreach ($dokumenAkreditasis as $dokumenAkreditasi) {
            $dokumenAkreditasi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('dokumen_akreditasi_create') && Gate::denies('dokumen_akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DokumenAkreditasi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
