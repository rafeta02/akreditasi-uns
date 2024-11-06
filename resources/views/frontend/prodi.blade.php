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
                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Prestasi Mahasiswa</span>
                            <span class="info-box-number">{{ $prestasi ?? 0 }} Prestasi</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="far fa-bell"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Kompetensi Mahasiswa</span>
                            <span class="info-box-number">{{ $competency ?? 0 }} Checklist</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-flag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Assessment Taken</span>
                            <span class="info-box-number">{{ $assessment ?? 0 }} Times</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
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
                                <label for="jenjang_id">Akreditasi Nasional</label>
                                <select class="form-control select2" name="jenjang_id" id="jenjang_id">
                                    @foreach($jenjangs as $id => $entry)
                                        <option value="{{ $id }}" {{ old('jenjang_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jenjang_id">Akreditasi Internasional</label>
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
                              <th width="1%">Akreditasi Nasional</th>
                              <th width="1%">Akreditasi Internasional</th>
                              <th>Nilai</th>
                              <th>No Sertifikat</th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
                              <tr data-entry-id="1">
                                <td class="text-center">1</td>
                                <td class="text-center">D3 Manajemen Bisnis</td>
                                <td class="text-center">Sekolah Vokasi</td>
                                <td class="text-center">Terakreditasi</td>
                                <td class="text-center">Terakreditasi</td>
                                <td class="text-center">Unggul <br> (399)</td>
                                <td class="text-center">3906/SK/BAN-PT/Akred-Itnl/S/IX/2023</td>
                                <td class="text-center"></td>
                              </tr>
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
