@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('logbook_akreditasi_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.logbook-akreditasis.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-LogbookAkreditasi">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.logbookAkreditasi.fields.user') }}
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
                                        {{ trans('cruds.logbookAkreditasi.fields.satuan') }}
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
                            <tbody>
                                @foreach($logbookAkreditasis as $key => $logbookAkreditasi)
                                    <tr data-entry-id="{{ $logbookAkreditasi->id }}">
                                        <td>
                                            {{ $logbookAkreditasi->user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\LogbookAkreditasi::URAIAN_SELECT[$logbookAkreditasi->uraian] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logbookAkreditasi->detail ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logbookAkreditasi->tanggal ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logbookAkreditasi->jumlah ?? '' }}
                                        </td>
                                        <td>
                                            {{ $logbookAkreditasi->satuan ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($logbookAkreditasi->hasil_pekerjaan as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $logbookAkreditasi->keterangan ?? '' }}
                                        </td>
                                        <td>
                                            @can('logbook_akreditasi_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.logbook-akreditasis.show', $logbookAkreditasi->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('logbook_akreditasi_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.logbook-akreditasis.edit', $logbookAkreditasi->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('logbook_akreditasi_delete')
                                                <form action="{{ route('frontend.logbook-akreditasis.destroy', $logbookAkreditasi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('frontend.logbook-akreditasis.massDestroy') }}",
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