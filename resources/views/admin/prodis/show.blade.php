@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.prodi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prodis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.code') }}
                        </th>
                        <td>
                            {{ $prodi->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.fakultas') }}
                        </th>
                        <td>
                            {{ $prodi->fakultas->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.jenjang') }}
                        </th>
                        <td>
                            {{ $prodi->jenjang->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.code_siakad') }}
                        </th>
                        <td>
                            {{ $prodi->code_siakad }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.nim') }}
                        </th>
                        <td>
                            {{ $prodi->nim }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.name_dikti') }}
                        </th>
                        <td>
                            {{ $prodi->name_dikti }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.name_akreditasi') }}
                        </th>
                        <td>
                            {{ $prodi->name_akreditasi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.name_en') }}
                        </th>
                        <td>
                            {{ $prodi->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.gelar') }}
                        </th>
                        <td>
                            {{ $prodi->gelar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.gelar_en') }}
                        </th>
                        <td>
                            {{ $prodi->gelar_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.tanggal_berdiri') }}
                        </th>
                        <td>
                            {{ $prodi->tanggal_berdiri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.sk_izin') }}
                        </th>
                        <td>
                            {{ $prodi->sk_izin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.tgl_sk_izin') }}
                        </th>
                        <td>
                            {{ $prodi->tgl_sk_izin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.description') }}
                        </th>
                        <td>
                            {{ $prodi->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $prodi->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prodi.fields.file_sk_pendirian') }}
                        </th>
                        <td>
                            @foreach($prodi->file_sk_pendirian as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prodis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection