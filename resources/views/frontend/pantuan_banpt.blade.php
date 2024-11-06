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
                    </div>

                    <div class="form-group mt-2">
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
                              <th width="1%">Type</th>
                              <th>Progress</th>
                              <th>Status</th>
                              <th>Update Terakhir</th>
                            </tr>
                        </thead>
                        <tbody>
                              <tr data-entry-id="1">
                                <td class="text-center">1</td>
                                <td class="text-center">D3 Manajemen Bisnis</td>
                                <td class="text-center">Sekolah Vokasi</td>
                                <td class="text-center">Penyetaraan Unggul</td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                                        </div>
                                    </div>
                                    <small>
                                        10% Complete
                                    </small>
                                </td>
                                <td class="text-center"><span class="badge badge-danger">Belum Diterima</span></td>
                                <td class="text-center">30 Oktober 2024</td>
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
