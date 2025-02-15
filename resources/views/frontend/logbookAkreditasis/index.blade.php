@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('logbook_akreditasi_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.logbook-akreditasi.create') }}">
                            Tambah Logbook
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#importModal">
                            Import Excel
                        </button>
                        @include('csvImport.import_modal', ['model' => 'LogbookAkreditasi', 'route' => 'frontend.logbook-akreditasi.import'])
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Template Import</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="#">
                                    Template SPMI
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    Template SPME
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    Template GKM
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.logbookAkreditasi.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-LogbookAkreditasi">
                            <thead>
                                <tr>
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
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logbookAkreditasis as $key => $logbookAkreditasi)
                                    <tr data-entry-id="{{ $logbookAkreditasi->ulid }}">
                                        <td class="text-center">
                                            <span class="badge badge-danger">{{ $logbookAkreditasi->uraian->name ?? '' }}</span>
                                        </td>
                                        <td class="text-center">
                                            {{ $logbookAkreditasi->detail ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $logbookAkreditasi->tanggal ? Carbon\Carbon::parse($logbookAkreditasi->tanggal)->format('d F Y') :  '' }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success">{{ $logbookAkreditasi->jumlah ?? '' }} {{ $logbookAkreditasi->satuan ?? '' }}</span>
                                        </td>
                                        <td class="text-center">
                                            @foreach($logbookAkreditasi->hasil_pekerjaan as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                                <br>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @can('logbook_akreditasi_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.logbook-akreditasi.show', $logbookAkreditasi->ulid) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('logbook_akreditasi_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.logbook-akreditasi.edit', $logbookAkreditasi->ulid) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('logbook_akreditasi_delete')
                                                <form action="{{ route('frontend.logbook-akreditasi.destroy', $logbookAkreditasi->ulid) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('logbook_akreditasi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.logbook-akreditasi.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-LogbookAkreditasi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection