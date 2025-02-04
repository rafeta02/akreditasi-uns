@extends('layouts.dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('ajuan_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.ajuan-akreditasi.create') }}">
                            Tambah Ajuan Akreditasi
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            Import Excel
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Ajuan">
                            <thead>
                                <tr>
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
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ajuans as $key => $ajuan)
                                    <tr data-entry-id="{{ $ajuan->id }}">
                                        <td class="text-center">
                                            {{ $ajuan->fakultas->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ajuan->prodi->name_dikti ?? '' }}
                                        </td>
                                        <td>
                                            {{ $ajuan->lembaga->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Ajuan::TYPE_AJUAN_SELECT[$ajuan->type_ajuan] ?? '' }}
                                        </td>
                                        <td>
                                            @if($ajuan->asesors->count() <= 0)
                                            <span class="badge badge-danger">Belum Diassign</span>
                                            @else
                                                @foreach($ajuan->asesors as $key => $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            {{ App\Models\Ajuan::STATUS_AJUAN_SELECT[$ajuan->status_ajuan] ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($ajuan->surat_tugas as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($ajuan->surat_pernyataan as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('ajuan_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.ajuan-akreditasi.show', $ajuan->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('ajuan_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.ajuan-akreditasi.edit', $ajuan->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('ajuan_delete')
                                                <form action="{{ route('frontend.ajuan-akreditasi.destroy', $ajuan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('ajuan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.ajuan-akreditasi.massDestroy') }}",
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
  let table = $('.datatable-Ajuan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection