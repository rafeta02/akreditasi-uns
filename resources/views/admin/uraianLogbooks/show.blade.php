@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.uraianLogbook.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.uraian-logbooks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.uraianLogbook.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\UraianLogbook::TYPE_SELECT[$uraianLogbook->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uraianLogbook.fields.name') }}
                        </th>
                        <td>
                            {{ $uraianLogbook->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.uraianLogbook.fields.slug') }}
                        </th>
                        <td>
                            {{ $uraianLogbook->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.uraian-logbooks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection