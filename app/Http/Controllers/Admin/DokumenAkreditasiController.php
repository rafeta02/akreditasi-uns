<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class DokumenAkreditasiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('dokumen_akreditasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DokumenAkreditasi::with(['ajuan', 'owned_by'])->select(sprintf('%s.*', (new DokumenAkreditasi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'dokumen_akreditasi_show';
                $editGate      = 'dokumen_akreditasi_edit';
                $deleteGate    = 'dokumen_akreditasi_delete';
                $crudRoutePart = 'dokumen-akreditasis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('ajuan_tgl_ajuan', function ($row) {
                return $row->ajuan ? $row->ajuan->tgl_ajuan : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? DokumenAkreditasi::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->addColumn('owned_by_name', function ($row) {
                return $row->owned_by ? $row->owned_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'ajuan', 'file', 'owned_by']);

            return $table->make(true);
        }

        return view('admin.dokumenAkreditasis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('dokumen_akreditasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ajuans = Ajuan::pluck('tgl_ajuan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dokumenAkreditasis.create', compact('ajuans', 'owned_bies'));
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

        return redirect()->route('admin.dokumen-akreditasis.index');
    }

    public function edit(DokumenAkreditasi $dokumenAkreditasi)
    {
        abort_if(Gate::denies('dokumen_akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ajuans = Ajuan::pluck('tgl_ajuan', 'id')->prepend(trans('global.pleaseSelect'), '');

        $owned_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dokumenAkreditasi->load('ajuan', 'owned_by');

        return view('admin.dokumenAkreditasis.edit', compact('ajuans', 'dokumenAkreditasi', 'owned_bies'));
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

        return redirect()->route('admin.dokumen-akreditasis.index');
    }

    public function show(DokumenAkreditasi $dokumenAkreditasi)
    {
        abort_if(Gate::denies('dokumen_akreditasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dokumenAkreditasi->load('ajuan', 'owned_by');

        return view('admin.dokumenAkreditasis.show', compact('dokumenAkreditasi'));
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
