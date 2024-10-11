@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.akreditasiInternasional.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.akreditasi-internasionals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.fakultas') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->fakultas->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.prodi') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->prodi->name_dikti ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.jenjang') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->jenjang->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.lembaga') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->lembaga->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.no_sk') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->no_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.tgl_sk') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->tgl_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.tgl_akhir_sk') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->tgl_akhir_sk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.tahun_expired') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->tahun_expired }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.peringkat') }}
                        </th>
                        <td>
                            {{ App\Models\AkreditasiInternasional::PERINGKAT_SELECT[$akreditasiInternasional->peringkat] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.nilai') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->nilai }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.diakui_dikti') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $akreditasiInternasional->diakui_dikti ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.sertifikat') }}
                        </th>
                        <td>
                            @if($akreditasiInternasional->sertifikat)
                                <a href="{{ $akreditasiInternasional->sertifikat->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $akreditasiInternasional->sertifikat->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.file_penunjang') }}
                        </th>
                        <td>
                            @foreach($akreditasiInternasional->file_penunjang as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.akreditasiInternasional.fields.note') }}
                        </th>
                        <td>
                            {{ $akreditasiInternasional->note }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.akreditasi-internasionals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection