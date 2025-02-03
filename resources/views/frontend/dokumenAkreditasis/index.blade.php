@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('dokumen_akreditasi_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.dokumen-akreditasis.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.dokumenAkreditasi.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.dokumenAkreditasi.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-DokumenAkreditasi">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.dokumenAkreditasi.fields.ajuan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dokumenAkreditasi.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dokumenAkreditasi.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dokumenAkreditasi.fields.file') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.dokumenAkreditasi.fields.owned_by') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumenAkreditasis as $key => $dokumenAkreditasi)
                                    <tr data-entry-id="{{ $dokumenAkreditasi->id }}">
                                        <td>
                                            {{ $dokumenAkreditasi->ajuan->tgl_ajuan ?? '' }}
                                        </td>
                                        <td>
                                            {{ $dokumenAkreditasi->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\DokumenAkreditasi::TYPE_SELECT[$dokumenAkreditasi->type] ?? '' }}
                                        </td>
                                        <td>
                                            @if($dokumenAkreditasi->file)
                                                <a href="{{ $dokumenAkreditasi->file->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $dokumenAkreditasi->owned_by->name ?? '' }}
                                        </td>
                                        <td>
                                            @can('dokumen_akreditasi_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.dokumen-akreditasis.show', $dokumenAkreditasi->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('dokumen_akreditasi_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.dokumen-akreditasis.edit', $dokumenAkreditasi->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('dokumen_akreditasi_delete')
                                                <form action="{{ route('frontend.dokumen-akreditasis.destroy', $dokumenAkreditasi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('dokumen_akreditasi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.dokumen-akreditasis.massDestroy') }}",
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
  let table = $('.datatable-DokumenAkreditasi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection