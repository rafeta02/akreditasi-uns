@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lembagaAkreditasi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lembaga-akreditasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lembagaAkreditasi.fields.code') }}
                        </th>
                        <td>
                            {{ $lembagaAkreditasi->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lembagaAkreditasi.fields.name') }}
                        </th>
                        <td>
                            {{ $lembagaAkreditasi->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lembagaAkreditasi.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\LembagaAkreditasi::TYPE_SELECT[$lembagaAkreditasi->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lembagaAkreditasi.fields.description') }}
                        </th>
                        <td>
                            {{ $lembagaAkreditasi->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lembaga-akreditasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection