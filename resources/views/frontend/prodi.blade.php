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
          <div class="card">
            <div class="card-header">
                Daftar Akreditasi Program Studi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover datatable datatable-PrestasiMaba">
                        <thead>
                            <tr>
                              <th>No</th>
                              <th>Prodi</th>
                              <th>Fakultas</th>
                              <th>Akreditasi Nasional</th>
                              <th>Akreditasi Internasional</th>
                              <th>Nilai</th>
                              <th></th>
                              <th>"C"</th>
                              <th>Baik</th>
                              <th>Terakreditasi Sementara</th>
                              <th>Belum Terakreditasi</th>
                              <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                              <tr data-entry-id="1">
                                <td class="text-center">1</td>
                                <td class="text-center">Fakultas Ilmu Budaya</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">5</td>
                                <td class="text-center">29</td>
                                <td class="text-center">9</td>
                                <td class="text-center">11</td>
                                <td class="text-center">4</td>
                                <td class="text-center">4</td>
                                <td class="text-center">4</td>
                                <td class="text-center">124</td>
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
    let table = $('.datatable-PrestasiMaba:not(.ajaxTable)').DataTable({
        searching: false,
        paging: false,
        pageLength: 50
    })
    $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endsection
