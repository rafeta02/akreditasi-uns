@extends('layouts.frontend')

@section('title', 'Data Fakultas | Akreditasi UNS | LPPMP UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Data Fakultas </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Fakultas</li>
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
                Rekap Akreditasi Per Fakultas
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover datatable datatable-List">
                        <thead>
                            <tr>
                              <th>No</th>
                              <th>Fakultas</th>
                              <th width="1%">Akreditasi Internasional</th>
                              <th width="1%">Belum Terakreditasi Internasional</th>
                              <th width="1%">"A"</th>
                              <th width="1%">Unggul</th>
                              <th width="1%">"B"</th>
                              <th width="1%">Baik Sekali</th>
                              <th width="1%">"C"</th>
                              <th width="1%">Baik</th>
                              <th width="1%">Terakreditasi Sementara</th>
                              <th width="1%">Belum Terakreditasi</th>
                              <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $prodi_all = 0;
                            @endphp
                            @foreach ($fakultas as $item)
                            @php
                                $total_prodi = $item->prodi->count();
                                $prodi_all += $total_prodi;
                            @endphp
                            <tr data-entry-id="{{ $item->id}}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $inter = $akreditasiInternasional->where('fakultas_id', $item->id)->count() }}</td>
                                <td class="text-center">{{ $total_prodi - $inter }}</td>
                                <td class="text-center">{{ $akreditasi->where('fakultas_id', $item->id)->where('peringkat', 'A')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('fakultas_id', $item->id)->where('peringkat', 'UNGGUL')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('fakultas_id', $item->id)->where('peringkat', 'B')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('fakultas_id', $item->id)->where('peringkat', 'BAIK SEKALI')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('fakultas_id', $item->id)->where('peringkat', 'C')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('fakultas_id', $item->id)->where('peringkat', 'BAIK')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('fakultas_id', $item->id)->where('peringkat', 'SEMENTARA')->count() }}</td>
                                <td class="text-center">{{ $total_prodi - $akreditasi->where('fakultas_id', $item->id)->count() }}</td>
                                <td class="text-center">{{ $total_prodi }}</td>
                            </tr> 
                            @endforeach
                            <tr data-entry-id="last">
                                <td class="text-center" colspan="2">TOTAL</td>
                                <td class="text-center">{{ $inter = $akreditasiInternasional->count() }}</td>
                                <td class="text-center">{{ $prodi_all - $inter }}</td>
                                <td class="text-center">{{ $akreditasi->where('peringkat', 'A')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('peringkat', 'UNGGUL')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('peringkat', 'B')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('peringkat', 'BAIK SEKALI')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('peringkat', 'C')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('peringkat', 'BAIK')->count() }}</td>
                                <td class="text-center">{{ $akreditasi->where('peringkat', 'SEMENTARA')->count() }}</td>
                                <td class="text-center">{{ $prodi_all - $akreditasi->count() }}</td>
                                <td class="text-center">{{ $prodi_all }}</td>
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
