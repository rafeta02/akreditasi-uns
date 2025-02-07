<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLogbookAkreditasiRequest;
use App\Http\Requests\StoreLogbookAkreditasiRequest;
use App\Http\Requests\UpdateLogbookAkreditasiRequest;
use App\Models\LogbookAkreditasi;
use App\Models\UraianLogbook;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LogbookAkreditasiController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('logbook_akreditasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LogbookAkreditasi::with(['user', 'uraian', 'validated_by'])->select(sprintf('%s.*', (new LogbookAkreditasi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'logbook_akreditasi_show';
                $editGate      = 'logbook_akreditasi_edit';
                $deleteGate    = 'logbook_akreditasi_delete';
                $crudRoutePart = 'logbook-akreditasis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('tugas', function ($row) {
                return $row->tugas ? LogbookAkreditasi::TUGAS_SELECT[$row->tugas] : '';
            });
            $table->addColumn('uraian_name', function ($row) {
                return $row->uraian ? $row->uraian->name : '';
            });

            $table->editColumn('detail', function ($row) {
                return $row->detail ? $row->detail : '';
            });

            $table->editColumn('jumlah', function ($row) {
                return $row->jumlah ? $row->jumlah : '';
            });
            $table->editColumn('satuan', function ($row) {
                return $row->satuan ? $row->satuan : '';
            });
            $table->editColumn('hasil_pekerjaan', function ($row) {
                if (! $row->hasil_pekerjaan) {
                    return '';
                }
                $links = [];
                foreach ($row->hasil_pekerjaan as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : '';
            });
            $table->editColumn('valid', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->valid ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'uraian', 'hasil_pekerjaan', 'valid']);

            return $table->make(true);
        }

        return view('admin.logbookAkreditasis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('logbook_akreditasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $uraians = UraianLogbook::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $validated_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.logbookAkreditasis.create', compact('uraians', 'users', 'validated_bies'));
    }

    public function store(StoreLogbookAkreditasiRequest $request)
    {
        $logbookAkreditasi = LogbookAkreditasi::create($request->all());

        foreach ($request->input('hasil_pekerjaan', []) as $file) {
            $logbookAkreditasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('hasil_pekerjaan');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $logbookAkreditasi->id]);
        }

        return redirect()->route('admin.logbook-akreditasis.index');
    }

    public function edit(LogbookAkreditasi $logbookAkreditasi)
    {
        abort_if(Gate::denies('logbook_akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $uraians = UraianLogbook::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $validated_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $logbookAkreditasi->load('user', 'uraian', 'validated_by');

        return view('admin.logbookAkreditasis.edit', compact('logbookAkreditasi', 'uraians', 'users', 'validated_bies'));
    }

    public function update(UpdateLogbookAkreditasiRequest $request, LogbookAkreditasi $logbookAkreditasi)
    {
        $logbookAkreditasi->update($request->all());

        if (count($logbookAkreditasi->hasil_pekerjaan) > 0) {
            foreach ($logbookAkreditasi->hasil_pekerjaan as $media) {
                if (! in_array($media->file_name, $request->input('hasil_pekerjaan', []))) {
                    $media->delete();
                }
            }
        }
        $media = $logbookAkreditasi->hasil_pekerjaan->pluck('file_name')->toArray();
        foreach ($request->input('hasil_pekerjaan', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $logbookAkreditasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('hasil_pekerjaan');
            }
        }

        return redirect()->route('admin.logbook-akreditasis.index');
    }

    public function show(LogbookAkreditasi $logbookAkreditasi)
    {
        abort_if(Gate::denies('logbook_akreditasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logbookAkreditasi->load('user', 'uraian', 'validated_by');

        return view('admin.logbookAkreditasis.show', compact('logbookAkreditasi'));
    }

    public function destroy(LogbookAkreditasi $logbookAkreditasi)
    {
        abort_if(Gate::denies('logbook_akreditasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logbookAkreditasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyLogbookAkreditasiRequest $request)
    {
        $logbookAkreditasis = LogbookAkreditasi::find(request('ids'));

        foreach ($logbookAkreditasis as $logbookAkreditasi) {
            $logbookAkreditasi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('logbook_akreditasi_create') && Gate::denies('logbook_akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new LogbookAkreditasi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
