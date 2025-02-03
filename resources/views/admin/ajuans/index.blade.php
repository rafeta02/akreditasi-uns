@extends('layouts.admin')
@section('content')
@can('ajuan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.ajuans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ajuan.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Ajuan', 'route' => 'admin.ajuans.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ajuan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Ajuan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.ajuan.fields.fakultas') }}
                    </th>
                    <th>
                        {{ trans('cruds.ajuan.fields.prodi') }}
                    </th>
                    <th>
                        {{ trans('cruds.ajuan.fields.lembaga') }}
                    </th>
                    <th>
                        {{ trans('cruds.ajuan.fields.type_ajuan') }}
                    </th>
                    <th>
                        {{ trans('cruds.ajuan.fields.asesor') }}
                    </th>
                    <th>
                        {{ trans('cruds.ajuan.fields.status_ajuan') }}
                    </th>
                    <th>
                        {{ trans('cruds.ajuan.fields.surat_tugas') }}
                    </th>
                    <th>
                        {{ trans('cruds.ajuan.fields.surat_pernyataan') }}
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
@can('ajuan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.ajuans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.ajuans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'fakultas_name', name: 'fakultas.name' },
{ data: 'prodi_name_dikti', name: 'prodi.name_dikti' },
{ data: 'lembaga_name', name: 'lembaga.name' },
{ data: 'type_ajuan', name: 'type_ajuan' },
{ data: 'asesor', name: 'asesors.name' },
{ data: 'status_ajuan', name: 'status_ajuan' },
{ data: 'surat_tugas', name: 'surat_tugas', sortable: false, searchable: false },
{ data: 'surat_pernyataan', name: 'surat_pernyataan', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-Ajuan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection