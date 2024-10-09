@extends('layouts.admin')
@section('content')
@can('prodi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.prodis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.prodi.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Prodi', 'route' => 'admin.prodis.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.prodi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Prodi">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.prodi.fields.code') }}
                    </th>
                    <th>
                        {{ trans('cruds.prodi.fields.fakultas') }}
                    </th>
                    <th>
                        {{ trans('cruds.prodi.fields.jenjang') }}
                    </th>
                    <th>
                        {{ trans('cruds.prodi.fields.name_dikti') }}
                    </th>
                    <th>
                        {{ trans('cruds.prodi.fields.name_en') }}
                    </th>
                    <th>
                        {{ trans('cruds.prodi.fields.gelar') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.prodis.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'code', name: 'code', class: 'text-center' },
        { data: 'fakultas_name', name: 'fakultas.name', class: 'text-center'  },
        { data: 'jenjang_name', name: 'jenjang.name', class: 'text-center'  },
        { data: 'name_dikti', name: 'name_dikti', class: 'text-center'  },
        { data: 'name_en', name: 'name_en', class: 'text-center'  },
        { data: 'gelar', name: 'gelar', class: 'text-center'  },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center'  }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Prodi').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
