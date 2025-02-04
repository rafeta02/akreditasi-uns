@extends('layouts.admin')
@section('content')
@can('logbook_akreditasi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.logbook-akreditasis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.logbookAkreditasi.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'LogbookAkreditasi', 'route' => 'admin.logbook-akreditasis.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.logbookAkreditasi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-LogbookAkreditasi">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        Supertim
                    </th>
                    <th>
                        {{ trans('cruds.logbookAkreditasi.fields.uraian') }}
                    </th>
                    <th>
                        {{ trans('cruds.logbookAkreditasi.fields.detail') }}
                    </th>
                    <th>
                        {{ trans('cruds.logbookAkreditasi.fields.tanggal') }}
                    </th>
                    <th>
                        {{ trans('cruds.logbookAkreditasi.fields.jumlah') }}
                    </th>
                    <th>
                        {{ trans('cruds.logbookAkreditasi.fields.hasil_pekerjaan') }}
                    </th>
                    <th>
                        {{ trans('cruds.logbookAkreditasi.fields.keterangan') }}
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
@can('logbook_akreditasi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.logbook-akreditasis.massDestroy') }}",
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
    ajax: "{{ route('admin.logbook-akreditasis.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'user_name', name: 'user.name', class: 'text-center' },
        { data: 'uraian', name: 'uraian', class: 'text-center' },
        { data: 'detail', name: 'detail', class: 'text-center' },
        { data: 'tanggal', name: 'tanggal', class: 'text-center' },
        { data: 'jumlah', name: 'jumlah', class: 'text-center' },
        { data: 'hasil_pekerjaan', name: 'hasil_pekerjaan', sortable: false, searchable: false, class: 'text-center' },
        { data: 'keterangan', name: 'keterangan', class: 'text-center' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-LogbookAkreditasi').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection