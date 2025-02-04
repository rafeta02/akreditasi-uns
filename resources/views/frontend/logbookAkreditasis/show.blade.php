@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.logbookAkreditasi.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.logbook-akreditasi.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.uraian') }}
                                    </th>
                                    <td>
                                        {{ App\Models\LogbookAkreditasi::URAIAN_SELECT[$logbookAkreditasi->uraian] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.detail') }}
                                    </th>
                                    <td>
                                        {{ $logbookAkreditasi->detail }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.tanggal') }}
                                    </th>
                                    <td>
                                        {{ $logbookAkreditasi->tanggal }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.jumlah') }}
                                    </th>
                                    <td>
                                        {{ $logbookAkreditasi->jumlah }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.satuan') }}
                                    </th>
                                    <td>
                                        {{ $logbookAkreditasi->satuan }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.hasil_pekerjaan') }}
                                    </th>
                                    <td>
                                        @foreach($logbookAkreditasi->hasil_pekerjaan as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.keterangan') }}
                                    </th>
                                    <td>
                                        {{ $logbookAkreditasi->keterangan }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.logbook-akreditasi.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection