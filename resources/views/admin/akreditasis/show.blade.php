@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.akreditasi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.akreditasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.fakultas') }}
                        </th>
                        <td>
                            {{ $akreditasi->fakultas->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.prodi') }}
                        </th>
                        <td>
                            {{ $akreditasi->prodi->name_dikti ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.jenjang') }}
                        </th>
                        <td>
                            {{ $akreditasi->jenjang->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.lembaga') }}
                        </th>
                        <td>
                            {{ $akreditasi->lembaga->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.no_sk') }}
                        </th>
                        <td>
                            {{ $akreditasi->no_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.tgl_sk') }}
                        </th>
                        <td>
                            {{ $akreditasi->tgl_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.tgl_akhir_sk') }}
                        </th>
                        <td>
                            {{ $akreditasi->tgl_akhir_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.tahun_expired') }}
                        </th>
                        <td>
                            {{ $akreditasi->tahun_expired }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.peringkat') }}
                        </th>
                        <td>
                            {{ App\Models\Akreditasi::PERINGKAT_SELECT[$akreditasi->peringkat] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.nilai') }}
                        </th>
                        <td>
                            {{ $akreditasi->nilai }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.sertifikat') }}
                        </th>
                        <td>
                            @if($akreditasi->sertifikat)
                                <a href="{{ $akreditasi->sertifikat->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $akreditasi->sertifikat->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.file_penunjang') }}
                        </th>
                        <td>
                            @foreach($akreditasi->file_penunjang as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasi.fields.note') }}
                        </th>
                        <td>
                            {{ $akreditasi->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.akreditasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection