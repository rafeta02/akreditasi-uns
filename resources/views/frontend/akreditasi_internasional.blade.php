@extends('layouts.frontend')

@section('title', 'Akreditasi Internasional | Akreditasi UNS | LPPMP UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Akreditasi Internasional </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Akreditasi Internasional</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-sun"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Terakreditasi Internasional</span>
                            <span class="info-box-number">{{ sumProdiInternasional() }} Prodi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">ASIIN</span>
                            <span class="info-box-number">{{ sumProdiAsiin() }} Prodi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="far fa-star"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">IABEE</span>
                            <span class="info-box-number">{{ sumProdiIabee() }} Prodi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">AQAS</span>
                            <span class="info-box-number">{{ sumProdiAqas() }} Prodi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Daftar Akreditasi Internasional
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="lembaga_akreditasi_id">Lembaga Akreditasi</label>
                                            <select class="form-control select2" name="lembaga_akreditasi_id" id="lembaga_akreditasi_id">
                                                @foreach($lembaga_internasional as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('lembaga_akreditasi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="form-group mt-3">
                                    <button class="btn btn-success" type="submit">
                                        Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card-body">
                            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AkreditasiInternasional">
                                <thead>
                                    <tr>
                                        <th width="10">
                                            No
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
  let dtOverrideGlobals = {
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "{{ route('akreditasiInternasional') }}",
        data: function(data) {
            data.fakultas = $('#fakultas_id').val(),
            data.jenjang = $('#jenjang_id').val(),
            data.lembaga = $('#lembaga_akreditasi_id').val()
        }
    },
    columns: [
        { data: null, name: 'row_num', class: 'text-center', orderable: false, searchable: false },
        { data: 'fakultas_name', name: 'fakultas.name', class: 'text-center' },
        { data: 'prodi_name_dikti', name: 'prodi.name_dikti', class: 'text-center' },
        { data: 'lembaga_name', name: 'lembaga.name', class: 'text-center', searchable: false },
        { data: 'tgl_akhir_sk', name: 'tgl_akhir_sk', class: 'text-center', searchable: false },
        { data: 'sertifikat', name: 'sertifikat', sortable: false, searchable: false, class: 'text-center', searchable: false },
        { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center', searchable: false }
    ],
    orderCellsTop: true,
    order: [[ 5, 'desc' ]],
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
  let table = $('.datatable-AkreditasiInternasional').DataTable(dtOverrideGlobals);
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
