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
                            <span class="info-box-text">Total Terakreditasi</span>
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
                        <span class="info-box-icon bg-danger"><i class="far fa-hourglass"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Terakreditasi Sementara</span>
                            <span class="info-box-number">{{ sumProdiSementara() }} Prodi</span>
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
                                                @foreach($jenjangs as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('jenjang_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                                            <label for="jenjang_id">Lembaga Akreditasi</label>
                                            <select class="form-control select2" name="jenjang_id" id="jenjang_id">
                                                @foreach($jenjangs as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('jenjang_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                                <table class="table table-bordered table-hover datatable datatable-List">
                                    <thead>
                                        <tr>
                                          <th width="1%">No</th>
                                          <th>Prodi</th>
                                          <th>Fakultas</th>
                                          <th width="1%">Lembaga Akreditasi</th>
                                          <th>No Sertifikat</th>
                                          <th>Berlaku Sampai</th>
                                          <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <tr data-entry-id="1">
                                            <td class="text-center">1</td>
                                            <td class="text-center">D3 Manajemen Bisnis</td>
                                            <td class="text-center">Sekolah Vokasi</td>
                                            <td class="text-center">FIBAA</td>
                                            <td class="text-center">3906/SK/BAN-PT/Akred-Itnl/S/IX/2023</td>
                                            <td class="text-center">30 Maret 2029</td>
                                          </tr>
                                    </tbody>
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
    let table = $('.datatable-List:not(.ajaxTable)').DataTable({
        ordering: false,
        searching: false,
        paging: false,
        pageLength: 50
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $('#expired_date').daterangepicker({
        locale: {
            format: 'YYYY-MM-DD'
        },
        autoUpdateInput: false
    });

    $('#expired_date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });
})
</script>
@endsection
