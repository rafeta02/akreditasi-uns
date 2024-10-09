@extends('layouts.admin')
@section('content')
@can('akreditasi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.akreditasis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.akreditasi.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Akreditasi', 'route' => 'admin.akreditasis.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.akreditasi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Akreditasi">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.akreditasi.fields.fakultas') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasi.fields.prodi') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasi.fields.lembaga') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasi.fields.no_sk') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasi.fields.tgl_akhir_sk') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasi.fields.peringkat') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasi.fields.sertifikat') }}
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
    ajax: "{{ route('admin.akreditasis.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'fakultas_name', name: 'fakultas.name', class: 'text-center' },
        { data: 'prodi_name_dikti', name: 'prodi.name_dikti', class: 'text-center' },
        { data: 'lembaga_name', name: 'lembaga.name', class: 'text-center' },
        { data: 'no_sk', name: 'no_sk', class: 'text-center' },
        { data: 'tgl_akhir_sk', name: 'tgl_akhir_sk', class: 'text-center' },
        { data: 'peringkat', name: 'peringkat', class: 'text-center' },
        { data: 'sertifikat', name: 'sertifikat', sortable: false, searchable: false, class: 'text-center' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 5, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Akreditasi').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
