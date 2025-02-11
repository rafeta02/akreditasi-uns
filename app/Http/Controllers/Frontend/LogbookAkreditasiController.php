<?php

namespace App\Http\Controllers\Frontend;

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
use Alert;
use App\Imports\LogbookAkreditasiImport;
use Excel;
use Yajra\DataTables\Facades\DataTables;

class LogbookAkreditasiController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('logbook_akreditasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logbookAkreditasis = LogbookAkreditasi::with(['user', 'uraian', 'media'])->where('user_id', auth()->id())->orderBy('tanggal', 'DESC')->get();

        return view('frontend.logbookAkreditasis.index', compact('logbookAkreditasis'));
    }

    public function create()
    {
        abort_if(Gate::denies('logbook_akreditasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uraians = UraianLogbook::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.logbookAkreditasis.create', compact('uraians'));
    }

    public function store(StoreLogbookAkreditasiRequest $request)
    {
        $logbookAkreditasi = LogbookAkreditasi::create(array_merge($request->all(), ['user_id' => auth()->id()]));

        foreach ($request->input('hasil_pekerjaan', []) as $file) {
            $originalFilename = basename($file);
            $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);
            $newFilename = 'Logbook_'. auth()->user()->name . '_' . $request->input('tanggal') . '_' . uniqid(). '.' . $fileExtension;
            
            $logbookAkreditasi->addMedia(storage_path('tmp/uploads/' . $originalFilename))
                ->usingName($newFilename)
                ->usingFileName($newFilename)
                ->toMediaCollection('hasil_pekerjaan');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $logbookAkreditasi->id]);
        }

        Alert::success('Success! Your logbook has been saved successfully.');

        return redirect()->route('frontend.logbook-akreditasi.index');
    }

    public function edit($ulid)
    {
        abort_if(Gate::denies('logbook_akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logbookAkreditasi = LogbookAkreditasi::where('ulid', $ulid)->firstOrFail();
        $logbookAkreditasi->load('user');

        $uraians = UraianLogbook::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.logbookAkreditasis.edit', compact('logbookAkreditasi', 'uraians'));
    }

    public function update(UpdateLogbookAkreditasiRequest $request, $ulid)
    {
        $logbookAkreditasi = LogbookAkreditasi::where('ulid', $ulid)->firstOrFail();

        $logbookAkreditasi->update($request->all());

        if (count($logbookAkreditasi->hasil_pekerjaan) > 0) {
            foreach ($logbookAkreditasi->hasil_pekerjaan as $media) {
                if (!in_array($media->file_name, $request->input('hasil_pekerjaan', []))) {
                    $media->delete();
                }
            }
        }
        
        $media = $logbookAkreditasi->hasil_pekerjaan->pluck('file_name')->toArray();
        foreach ($request->input('hasil_pekerjaan', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $originalFilename = basename($file);
                $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);
                $newFilename = 'Logbook_' . auth()->user()->name . '_' . $request->input('tanggal') . '_' . uniqid() . '.' . $fileExtension;
                
                $logbookAkreditasi->addMedia(storage_path('tmp/uploads/' . $originalFilename))
                    ->usingName($newFilename)
                    ->usingFileName($newFilename)
                    ->toMediaCollection('hasil_pekerjaan');
            }
        }

        Alert::success('Success! Your logbook has been updated successfully.');

        return redirect()->route('frontend.logbook-akreditasi.index');
    }

    public function show($ulid)
    {
        abort_if(Gate::denies('logbook_akreditasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logbookAkreditasi = LogbookAkreditasi::where('ulid', $ulid)->firstOrFail();

        $logbookAkreditasi->load('user');

        return view('frontend.logbookAkreditasis.show', compact('logbookAkreditasi'));
    }

    public function destroy($ulid)
    {
        abort_if(Gate::denies('logbook_akreditasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logbookAkreditasi = LogbookAkreditasi::where('ulid', $ulid)->firstOrFail();

        $logbookAkreditasi->delete();

        Alert::success('Success! Your logbook has been deleted successfully.');

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

    public function import(Request $request)
    {
        $file = $request->file('import_file');
        $request->validate([
            'import_file' => 'mimes:csv,xls,xlsx',
        ]);

        Excel::import(new LogbookAkreditasiImport(), $file);

        Alert::success('Success! Your logbook has been imported successfully.');

        return redirect()->back();
    }


    public function validasi(Request $request)
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
                return $row->tugas ? '<span class="badge badge-primary">'.LogbookAkreditasi::TUGAS_SELECT[$row->tugas].'</span><br>'. $row->uraian->name : '';
            });

            $table->addColumn('uraian_name', function ($row) {
                return $row->uraian ? '<span class="badge badge-primary">'.LogbookAkreditasi::TUGAS_SELECT[$row->tugas].'</span><br>'. $row->uraian->name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'user', 'tugas', 'uraian', 'hasil_pekerjaan', 'valid']);

            return $table->make(true);
        }

        return view('frontend.logbookAkreditasis.validasi');
    }

    public function massValidate(Request $request)
    {
        $ids = $request->input('ids', []);
        YourModel::whereIn('id', $ids)->update(['valid' => true]);
        return response()->json(['success' => true]);
    }
}
