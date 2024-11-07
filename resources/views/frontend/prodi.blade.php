@extends('layouts.frontend')

@section('title', 'Data Program Studi | Akreditasi UNS | LPPMP UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Data Program Studi </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Program Studi</li>
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
                        <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Akreditasi Unggul</span>
                            <span class="info-box-number">{{ sumProdiUnggul() }} Prodi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Akreditasi "A"</span>
                            <span class="info-box-number">{{ sumProdiA() }} Prodi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-sun"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Akreditasi Internasional</span>
                            <span class="info-box-number">{{ sumProdiInternasional() }} Prodi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="far fa-hourglass"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Belum Terakreditasi</span>
                            <span class="info-box-number">{{ sumProdiBelumTerakreditasi() }} Prodi</span>
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
                            Daftar Akreditasi Program Studi
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
                                            <label for="nasional_id">Akreditasi Nasional</label>
                                            <select class="form-control select2" name="nasional_id" id="nasional_id">
                                                @foreach($lembaga_nasional as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('nasional_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="internasional_id">Akreditasi Internasional</label>
                                            <select class="form-control select2" name="internasional_id" id="internasional_id">
                                                @foreach($lembaga_internasional as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('internasional_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover datatable datatable-Prodi">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Prodi</th>
                                            <th>Fakultas</th>
                                            <th width="1%">Akreditasi Nasional</th>
                                            <th width="1%">Akreditasi Internasional</th>
                                            <th>Nilai</th>
                                            <th>No Sertifikat</th>
                                            <th></th>
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
            url: "{{ route('prodi') }}",
            data: function(data) {
                data.fakultas = $('#fakultas_id').val(),
                data.jenjang = $('#jenjang_id').val(),
                data.nasional = $('#nasional_id').val(),
                data.internasional = $('#internasional_id').val()
            }
        },
        columns: [
            { data: null, name: 'row_num', class: 'text-center', orderable: false, searchable: false },
            { data: 'nama_prodi', name: 'nama_prodi', class: 'text-center' },
            { data: 'fakultas_name', name: 'fakultas.name', class: 'text-center' },
            { data: 'gelar', name: 'gelar', class: 'text-center', searchable: false },
            { data: 'gelar', name: 'gelar', class: 'text-center', searchable: false },
            { data: 'slug', name: 'slug', class: 'text-center', searchable: false },
            { data: 'gelar', name: 'gelar', class: 'text-center', searchable: false  },
            { data: 'actions', name: 'actions', class: 'text-center', searchable: false }
        ],
        orderCellsTop: true,
        order: [[ 1, 'desc' ]],
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

    let table = $('.datatable-Prodi').DataTable(dtOverrideGlobals);

    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

    $("#filterform").submit(function(event) {
        event.preventDefault();
        table.ajax.reload();
    });
});
</script>
@endsection
