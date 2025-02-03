<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLogbookAkreditasiRequest;
use App\Http\Requests\StoreLogbookAkreditasiRequest;
use App\Http\Requests\UpdateLogbookAkreditasiRequest;
use App\Models\LogbookAkreditasi;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LogbookAkreditasiController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('logbook_akreditasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $logbookAkreditasis = LogbookAkreditasi::with(['user', 'media'])->where('user_id', auth()->id())->orderBy('tanggal', 'DESC')->get();

        return view('frontend.logbookAkreditasis.index', compact('logbookAkreditasis'));
    }

    public function create()
    {
        abort_if(Gate::denies('logbook_akreditasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.logbookAkreditasis.create', compact('users'));
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

        return redirect()->route('frontend.logbook-akreditasi.index');
    }

    public function edit(LogbookAkreditasi $logbookAkreditasi)
    {
        abort_if(Gate::denies('logbook_akreditasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $logbookAkreditasi->load('user');

        return view('frontend.logbookAkreditasis.edit', compact('logbookAkreditasi', 'users'));
    }

    public function update(UpdateLogbookAkreditasiRequest $request, LogbookAkreditasi $logbookAkreditasi)
    {
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

        return redirect()->route('frontend.logbook-akreditasi.index');
    }

    public function show(LogbookAkreditasi $logbookAkreditasi)
    {
        abort_if(Gate::denies('logbook_akreditasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        abort_if($logbookAkreditasi->user_id !== auth()->id(), Response::HTTP_NOT_FOUND);

        $logbookAkreditasi->load('user');

        return view('frontend.logbookAkreditasis.show', compact('logbookAkreditasi'));
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
