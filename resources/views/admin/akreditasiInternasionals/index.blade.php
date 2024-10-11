@extends('layouts.admin')
@section('content')
@can('akreditasi_internasional_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.akreditasi-internasionals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.akreditasiInternasional.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'AkreditasiInternasional', 'route' => 'admin.akreditasi-internasionals.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.akreditasiInternasional.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AkreditasiInternasional">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.akreditasiInternasional.fields.fakultas') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasiInternasional.fields.prodi') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasiInternasional.fields.lembaga') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasiInternasional.fields.tgl_akhir_sk') }}
                    </th>
                    <th>
                        {{ trans('cruds.akreditasiInternasional.fields.sertifikat') }}
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
@can('akreditasi_internasional_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.akreditasi-internasionals.massDestroy') }}",
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
    ajax: "{{ route('admin.akreditasi-internasionals.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'fakultas_name', name: 'fakultas.name', class: 'text-center' },
        { data: 'prodi_name_dikti', name: 'prodi.name_dikti', class: 'text-center' },
        { data: 'lembaga_name', name: 'lembaga.name', class: 'text-center' },
        { data: 'tgl_akhir_sk', name: 'tgl_akhir_sk', class: 'text-center' },
        { data: 'sertifikat', name: 'sertifikat', sortable: false, searchable: false, class: 'text-center' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 5, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-AkreditasiInternasional').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
