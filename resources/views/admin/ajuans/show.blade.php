@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ajuan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ajuans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.fakultas') }}
                        </th>
                        <td>
                            {{ $ajuan->fakultas->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.prodi') }}
                        </th>
                        <td>
                            {{ $ajuan->prodi->name_dikti ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.jenjang') }}
                        </th>
                        <td>
                            {{ $ajuan->jenjang->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.lembaga') }}
                        </th>
                        <td>
                            {{ $ajuan->lembaga->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.type_ajuan') }}
                        </th>
                        <td>
                            {{ App\Models\Ajuan::TYPE_AJUAN_SELECT[$ajuan->type_ajuan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.note') }}
                        </th>
                        <td>
                            {{ $ajuan->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.tgl_ajuan') }}
                        </th>
                        <td>
                            {{ $ajuan->tgl_ajuan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.tgl_diterima') }}
                        </th>
                        <td>
                            {{ $ajuan->tgl_diterima }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.asesor') }}
                        </th>
                        <td>
                            @foreach($ajuan->asesors as $key => $asesor)
                                <span class="label label-info">{{ $asesor->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.status_ajuan') }}
                        </th>
                        <td>
                            {{ App\Models\Ajuan::STATUS_AJUAN_SELECT[$ajuan->status_ajuan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.surat_tugas') }}
                        </th>
                        <td>
                            @foreach($ajuan->surat_tugas as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.surat_pernyataan') }}
                        </th>
                        <td>
                            @foreach($ajuan->surat_pernyataan as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.bukti_upload') }}
                        </th>
                        <td>
                            @foreach($ajuan->bukti_upload as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ajuan.fields.diajukan_by') }}
                        </th>
                        <td>
                            {{ $ajuan->diajukan_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ajuans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection