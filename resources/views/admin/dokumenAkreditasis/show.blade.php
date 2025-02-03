@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dokumenAkreditasi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dokumen-akreditasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dokumenAkreditasi.fields.ajuan') }}
                        </th>
                        <td>
                            {{ $dokumenAkreditasi->ajuan->tgl_ajuan ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dokumenAkreditasi.fields.name') }}
                        </th>
                        <td>
                            {{ $dokumenAkreditasi->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dokumenAkreditasi.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\DokumenAkreditasi::TYPE_SELECT[$dokumenAkreditasi->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dokumenAkreditasi.fields.file') }}
                        </th>
                        <td>
                            @if($dokumenAkreditasi->file)
                                <a href="{{ $dokumenAkreditasi->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dokumenAkreditasi.fields.note') }}
                        </th>
                        <td>
                            {{ $dokumenAkreditasi->note }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dokumenAkreditasi.fields.owned_by') }}
                        </th>
                        <td>
                            {{ $dokumenAkreditasi->owned_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dokumen-akreditasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection