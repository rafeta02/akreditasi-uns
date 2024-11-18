@extends('layouts.frontend')

@section('title', 'Pantauan BAN-PT | Akreditasi UNS | LPPMP UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Pantauan BAN-PT </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Pantauan BAN-PT</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
                Daftar Pantauan BAN-PT
            </div>

            <div class="card-body">
                <form id="filterform">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fakultas_id">Fakultas</label>
                                <select class="form-control select2" name="fakultas_id" id="fakultas_id">
                                    @foreach($fakultas as $id => $entry)
                                        <option value="{{ $id }}" {{ old('fakultas_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jenjang_id">Jenjang</label>
                                <select class="form-control select2" name="jenjang_id" id="jenjang_id">
                                    @foreach($jenjangs as $id => $entry)
                                        <option value="{{ $id }}" {{ old('jenjang_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <button class="btn btn-success" type="submit">
                            Filter
                        </button>
                    </div>
                </form>
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
                                {{ trans('cruds.ajuan.fields.tgl_ajuan') }}
                            </th>
                            <th>
                                {{ trans('cruds.ajuan.fields.status_ajuan') }}
                            </th>
                            <th>
                                {{ trans('cruds.ajuan.fields.bukti_upload') }}
                            </th>
                        </tr>
                    </thead>
                </table>
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

    let dtOverrideGlobals = {
        buttons: dtButtons,
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: {
            url: "{{ route('pantauanBanpt') }}",
            data: function(data) {
                data.fakultas = $('#fakultas_id').val(),
                data.jenjang = $('#jenjang_id').val()
            }
        },
        columns: [
            { data: null, name: 'row_num', class: 'text-center', orderable: false, searchable: false },
            { data: 'fakultas_name', name: 'fakultas.name', class: 'text-center', },
            { data: 'prodi_name_dikti', name: 'prodi.name_dikti', class: 'text-center' },
            { data: 'lembaga_name', name: 'lembaga.name', class: 'text-center', searchable: false },
            { data: 'tgl_ajuan', name: 'tgl_ajuan', class: 'text-center', searchable: false },
            { data: 'status_ajuan', name: 'status_ajuan', class: 'text-center' },
            { data: 'bukti_upload', name: 'bukti_upload', sortable: false, searchable: false, class: 'text-center' },
        ],
        orderCellsTop: true,
        order: [[ 2, 'desc' ]],
        pageLength: 25,
        drawCallback: function(settings) {
            var api = this.api();
            var start = api.page.info().start;

            // Assign row numbers
            api.column(0, {page: 'current'}).nodes().each(function(cell, i) {
                cell.innerHTML = start + i + 1;
            });
        }
    };
    let table = $('.datatable-Ajuan').DataTable(dtOverrideGlobals);
    
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $("#filterform").submit(function(event) {
        event.preventDefault();
        table.ajax.reload();
    });

});

</script>
@endsection
