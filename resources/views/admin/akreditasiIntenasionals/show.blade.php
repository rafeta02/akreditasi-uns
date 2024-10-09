@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.akreditasiIntenasional.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.akreditasi-intenasionals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.fakultas') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->fakultas->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.prodi') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->prodi->name_dikti ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.jenjang') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->jenjang->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.lembaga') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->lembaga->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.no_sk') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->no_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.tgl_sk') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->tgl_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.tgl_akhir_sk') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->tgl_akhir_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.tahun_expired') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->tahun_expired }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.peringkat') }}
                        </th>
                        <td>
                            {{ App\Models\AkreditasiIntenasional::PERINGKAT_SELECT[$akreditasiIntenasional->peringkat] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.nilai') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->nilai }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.diakui_dikti') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $akreditasiIntenasional->diakui_dikti ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.sertifikat') }}
                        </th>
                        <td>
                            @if($akreditasiIntenasional->sertifikat)
                                <a href="{{ $akreditasiIntenasional->sertifikat->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $akreditasiIntenasional->sertifikat->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.file_penunjang') }}
                        </th>
                        <td>
                            @foreach($akreditasiIntenasional->file_penunjang as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiIntenasional.fields.note') }}
                        </th>
                        <td>
                            {{ $akreditasiIntenasional->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.akreditasi-intenasionals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection