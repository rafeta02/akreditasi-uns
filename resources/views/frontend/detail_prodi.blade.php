@extends('layouts.frontend')

@section('title', $prodi->nama_prodi . ' | Akreditasi UNS | LPPMP UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> {{ $prodi->nama_prodi }} </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('prodi') }}">Program Studi</a></li>
                <li class="breadcrumb-item active">{{ $prodi->nama_prodi }}</li>
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
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('img/uns.png') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $prodi->nama_prodi }}</h3>

                            <p class="text-muted text-center">Universitas Sebelas Maret</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Mahasiswa</b> <a class="float-right text-primary">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Dosen</b> <a class="float-right  text-primary">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Alumni</b> <a class="float-right  text-primary">13,287</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Profile Program Studi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-award mr-1"></i> Gelar</strong>
                            <p class="text-muted">{{ $prodi->gelar }} - {{ $prodi->gelar_en }}</p>

                            <hr>

                            <strong><i class="fas fa-calendar mr-1"></i> Tanggal Berdiri</strong>
                            <p class="text-muted">{{ Carbon\Carbon::parse($prodi->tanggal_berdiri)->format('d F Y')}}</p>

                            <hr>

                            <strong><i class="fas fa-certificate mr-1"></i> No. SK Izin Program Studi</strong>
                            <p class="text-muted">{{ $prodi->sk_izin }}</p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Standard yang Digunakan</strong>
                            <p class="text-muted">INA TEST</p>

                            {{-- <strong><i class="fas fa-certificate mr-1"></i> Lembaga Pengakreditasi</strong>
                            <p class="text-muted"> Lembaga Akreditasi Mandiri Ekonomi, Manajemen, Bisnis, dan Akuntansi</p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Standard yang Digunakan</strong>
                            <p class="text-muted">INA TEST</p> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#sertifikat" data-toggle="tab">Sertifikat Akreditasi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#nasional" data-toggle="tab">Akreditasi Nasional</a></li>
                                <li class="nav-item"><a class="nav-link" href="#internasional" data-toggle="tab">Akreditasi Internasional</a></li>
                                <li class="nav-item"><a class="nav-link" href="#infografis" data-toggle="tab">Infografis</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="sertifikat">
                                    <div class="card">
                                        <div class="card-header text-muted border-bottom-0">
                                            Sertifikat Akreditasi
                                        </div>
                                        <div class="card-body pt-0">
                                            @if($currentAkreditasi)
                                                <div class="row">
                                                    <div class="col-7">
                                                        <ul class="ml-4 my-2 fa-ul text-muted">
                                                            <li><span class="fa-li"><i class="fas fa-lg fa-certificate"></i></span>
                                                            No Sertifikat<br><b>{{ $currentAkreditasi->no_sk }}</b>
                                                            </li>
                                                            <li><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                            Lembaga Akreditasi<br><b>{{ $currentAkreditasi->lembaga->name }}</b>
                                                            </li>
                                                            <li><span class="fa-li"><i class="fas fa-lg fa-award"></i></span>
                                                            Nilai<br><b>{{ $currentAkreditasi->peringkat }} {{ $currentAkreditasi->nilai ? '('.$currentAkreditasi->nilai .')' : '' }}</b>
                                                            </li>
                                                            <li><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                                            Periode<br><b>{{ Carbon\Carbon::parse($currentAkreditasi->tgl_awal_sk)->format('d F Y') }} s/d {{ Carbon\Carbon::parse($currentAkreditasi->tgl_akhir_sk)->format('d F Y')}}</b>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-5 text-center">
                                                    <a href="{{ $currentAkreditasi->sertifikat ? $currentAkreditasi->sertifikat->getUrl() : asset('img/default.jpg') }}" class="image-popup">
                                                        <img class="img-fluid" src="{{ $currentAkreditasi->sertifikat ? $currentAkreditasi->sertifikat->getUrl() : asset('img/default.jpg') }}" alt="Sertifikat Akreditasi {{ $prodi->nama_prodi }}">
                                                    </a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-12">
                                                        Tidak Ada Sertifikat
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-footer text-center">
                                            @if($currentAkreditasi)
                                                @if($currentAkreditasi->sertifikat)
                                                    <a href="{{ $currentAkreditasi->sertifikat->url }}" download="Sertifikat_{{ $prodi->nama_prodi }}" class="btn btn-success">
                                                        <i class="fas fa-download"></i> Download Sertifikat
                                                    </a>
                                                @endif
                                                @if($currentAkreditasi->file_penunjang)
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger"><i class="fas fa-download"></i> Download SK</button>
                                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu"> 
                                                            <div class="dropdown-divider"></div>
                                                            @foreach ($currentAkreditasi->file_penunjang as $item)
                                                                <a class="dropdown-item" href="{{ $item->getUrl() }}" target="_blank">
                                                                    {{ $item->file_name }}
                                                                </a>
                                                            <div class="dropdown-divider"></div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card mt-5">
                                        <div class="card-header text-muted border-bottom-0">
                                            Sertifikat Akreditasi Internasional
                                        </div>
                                        <div class="card-body pt-0">
                                            @if($currentAkreditasiInternasional)
                                                <div class="row">
                                                    <div class="col-7">
                                                        <ul class="ml-4 my-2 fa-ul text-muted">
                                                            @if($currentAkreditasiInternasional->no_sk)
                                                            <li><span class="fa-li"><i class="fas fa-lg fa-certificate"></i></span>
                                                            No Sertifikat<br><b>No. {{ $currentAkreditasiInternasional->no_sk }}</b>
                                                            </li>
                                                            @endif
                                                            <li><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                            Lembaga Akreditasi<br><b>{{ $currentAkreditasiInternasional->lembaga->name }}</b>
                                                            </li>
                                                            @if ($currentAkreditasiInternasional->peringkat)
                                                            <li><span class="fa-li"><i class="fas fa-lg fa-award"></i></span>
                                                            Nilai<br><b>{{ $currentAkreditasiInternasional->peringkat }} {{ $currentAkreditasiInternasional->nilai ? '('.$currentAkreditasiInternasional->nilai .')' : '' }}</b>
                                                            </li>
                                                            @endif
                                                            <li><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                                            Periode<br><b>{{ Carbon\Carbon::parse($currentAkreditasiInternasional->tgl_awal_sk)->format('d F Y') }} s/d {{ Carbon\Carbon::parse($currentAkreditasiInternasional->tgl_akhir_sk)->format('d F Y')}}</b>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-5 text-center">
                                                    <a href="{{ $currentAkreditasiInternasional->sertifikat ? $currentAkreditasiInternasional->sertifikat->getUrl() : asset('img/default.jpg') }}" class="image-popup">
                                                        <img class="img-fluid" src="{{ $currentAkreditasiInternasional->sertifikat ? $currentAkreditasiInternasional->sertifikat->getUrl() : asset('img/default.jpg') }}" alt="Sertifikat Akreditasi {{ $prodi->nama_prodi }}">
                                                    </a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-12">
                                                        Tidak Ada Sertifikat
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-footer text-center">
                                            @if($currentAkreditasiInternasional)
                                                @if($currentAkreditasiInternasional->sertifikat)
                                                    <a href="{{ $currentAkreditasiInternasional->sertifikat->url }}" download="Sertifikat_{{ $prodi->nama_prodi }}" class="btn btn-success">
                                                        <i class="fas fa-download"></i> Download Sertifikat
                                                    </a>
                                                @endif
                                                @if($currentAkreditasiInternasional->file_penunjang)
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger"><i class="fas fa-download"></i> Download SK</button>
                                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu"> 
                                                            <div class="dropdown-divider"></div>
                                                            @foreach ($currentAkreditasiInternasional->file_penunjang as $item)
                                                                <a class="dropdown-item" href="{{ $item->getUrl() }}" target="_blank">
                                                                    {{ $item->file_name }}
                                                                </a>
                                                            <div class="dropdown-divider"></div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="nasional">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        @foreach ($allAkreditasi as $akreditasi)
                                            <div class="time-label">
                                                <span class="bg-danger">
                                                    {{ Carbon\Carbon::parse($akreditasi->tgl_sk)->format('d-F-Y')}}
                                                </span>
                                            </div>
                                            <div>
                                                <i class="fas fa-certificate bg-danger"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> {{ Carbon\Carbon::parse($akreditasi->tgl_sk)->diffForHumans()}} </span>

                                                    <h3 class="timeline-header">Sertifikat Akreditasi Periode <b>{{ Carbon\Carbon::parse($akreditasi->tgl_awal_sk)->format('d F Y')}} s/d {{ Carbon\Carbon::parse($akreditasi->tgl_akhir_sk)->format('d F Y')}}</b></h3>

                                                    <div class="timeline-body">
                                                        <div class="card">
                                                            <div class="card-header text-muted border-bottom-0">
                                                                Sertifikat Akreditasi
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <ul class="ml-4 my-2 fa-ul text-muted">
                                                                            <li><span class="fa-li"><i class="fas fa-lg fa-certificate"></i></span>
                                                                            No Sertifikat<br><b>No. {{ $akreditasi->no_sk }}</b>
                                                                            </li>
                                                                            <li><span class="fa-li"><i class="fas fa-lg fa-award"></i></span>
                                                                            Nilai<br><b>{{ $akreditasi->peringkat }} {{ $akreditasi->nilai ? '('.$akreditasi->nilai .')' : '' }}</b>
                                                                            </li>
                                                                            <li><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                                                            Periode<br><b>{{ Carbon\Carbon::parse($akreditasi->tgl_awal_sk)->format('d F Y') }} s/d {{ Carbon\Carbon::parse($akreditasi->tgl_akhir_sk)->format('d F Y')}}</b>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-5 text-center">
                                                                        <a href="{{ $akreditasi->sertifikat ? $akreditasi->sertifikat->getUrl() : asset('img/default.jpg') }}" class="image-popup">
                                                                            <img class="img-fluid" src="{{ $akreditasi->sertifikat ? $akreditasi->sertifikat->getUrl() : asset('img/default.jpg') }}" alt="Sertifikat Akreditasi {{ $prodi->nama_prodi }}">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                @if($akreditasi)
                                                                    @if($akreditasi->sertifikat)
                                                                        <a href="{{ $akreditasi->sertifikat->url }}" download="{{ $akreditasi->sertifikat->filename }}" class="btn btn-success">
                                                                            <i class="fas fa-download"></i> Download Sertifikat
                                                                        </a>
                                                                    @endif
                                                                    @if($akreditasi->file_penunjang)
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-danger"><i class="fas fa-download"></i> Download SK</button>
                                                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                                                                <span class="sr-only">Toggle Dropdown</span>
                                                                            </button>
                                                                            <div class="dropdown-menu" role="menu"> 
                                                                                <div class="dropdown-divider"></div>
                                                                                @foreach ($akreditasi->file_penunjang as $item)
                                                                                    <a class="dropdown-item" href="{{ $item->getUrl() }}" target="_blank">
                                                                                        {{ $item->file_name }}
                                                                                    </a>
                                                                                <div class="dropdown-divider"></div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($allAkreditasi->isEmpty())
                                            <div class="row">
                                                <div class="col-12">
                                                    Tidak Ada Sertifikat
                                                </div>
                                            </div>
                                        @else
                                        <!-- END timeline item -->
                                            <div>
                                                <i class="far fa-clock bg-gray"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="internasional">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        @foreach ($allAkreditasiInternasional as $akreditasi)
                                            <div class="time-label">
                                                <span class="bg-danger">
                                                    {{ Carbon\Carbon::parse($akreditasi->tgl_sk)->format('d-F-Y')}}
                                                </span>
                                            </div>
                                            <div>
                                                <i class="fas fa-certificate bg-danger"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> {{ Carbon\Carbon::parse($akreditasi->tgl_sk)->diffForHumans()}} </span>

                                                    <h3 class="timeline-header">Sertifikat Akreditasi Periode <b>{{ Carbon\Carbon::parse($akreditasi->tgl_awal_sk)->format('d F Y')}} s/d {{ Carbon\Carbon::parse($akreditasi->tgl_akhir_sk)->format('d F Y')}}</b></h3>

                                                    <div class="timeline-body">
                                                        <div class="card">
                                                            <div class="card-header text-muted border-bottom-0">
                                                                Sertifikat Akreditasi Internasional
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <ul class="ml-4 my-2 fa-ul text-muted">
                                                                            @if($akreditasi->no_sk)
                                                                            <li><span class="fa-li"><i class="fas fa-lg fa-certificate"></i></span>
                                                                            No Sertifikat<br><b>No. {{ $akreditasi->no_sk }}</b>
                                                                            </li>
                                                                            @endif
                                                                            <li><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                                            Lembaga Akreditasi<br><b>{{ $akreditasi->lembaga->name }}</b>
                                                                            </li>
                                                                            @if ($akreditasi->peringkat)
                                                                            <li><span class="fa-li"><i class="fas fa-lg fa-award"></i></span>
                                                                            Nilai<br><b>{{ $akreditasi->peringkat }} {{ $akreditasi->nilai ? '('.$akreditasi->nilai .')' : '' }}</b>
                                                                            </li>
                                                                            @endif
                                                                            <li><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                                                            Periode<br><b>{{ Carbon\Carbon::parse($akreditasi->tgl_awal_sk)->format('d F Y') }} s/d {{ Carbon\Carbon::parse($akreditasi->tgl_akhir_sk)->format('d F Y')}}</b>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-5 text-center">
                                                                        <a href="{{ $akreditasi->sertifikat ? $akreditasi->sertifikat->getUrl() : asset('img/default.jpg') }}" class="image-popup">
                                                                            <img class="img-fluid" src="{{ $akreditasi->sertifikat ? $akreditasi->sertifikat->getUrl() : asset('img/default.jpg') }}" alt="Sertifikat Akreditasi {{ $prodi->nama_prodi }}">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                @if($akreditasi)
                                                                    @if($akreditasi->sertifikat)
                                                                        <a href="{{ $akreditasi->sertifikat->url }}" download="{{ $akreditasi->sertifikat->filename }}" class="btn btn-success">
                                                                            <i class="fas fa-download"></i> Download Sertifikat
                                                                        </a>
                                                                    @endif
                                                                    @if($akreditasi->file_penunjang)
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-danger"><i class="fas fa-download"></i> Download SK</button>
                                                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                                                                <span class="sr-only">Toggle Dropdown</span>
                                                                            </button>
                                                                            <div class="dropdown-menu" role="menu"> 
                                                                                <div class="dropdown-divider"></div>
                                                                                @foreach ($akreditasi->file_penunjang as $item)
                                                                                    <a class="dropdown-item" href="{{ $item->getUrl() }}" target="_blank">
                                                                                        {{ $item->file_name }}
                                                                                    </a>
                                                                                <div class="dropdown-divider"></div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($allAkreditasiInternasional->isEmpty())
                                            <div class="row">
                                                <div class="col-12">
                                                    Tidak Ada Sertifikat
                                                </div>
                                            </div>
                                        @else
                                        <!-- END timeline item -->
                                            <div>
                                                <i class="far fa-clock bg-gray"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="infografis">
                                    <div class="card">
                                        <div class="card-header border-0">
                                            <div class="d-flex justify-content-between">
                                                <h3 class="card-title">Sales</h3>
                                                <a href="javascript:void(0);">View Report</a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <p class="d-flex flex-column">
                                                    <span class="text-bold text-lg">$18,230.00</span>
                                                    <span>Sales Over Time</span>
                                                </p>
                                                <p class="ml-auto d-flex flex-column text-right">
                                                    <span class="text-success">
                                                        <i class="fas fa-arrow-up"></i> 33.1%
                                                    </span>
                                                    <span class="text-muted">Since last month</span>
                                                </p>
                                            </div>
                                            <!-- /.d-flex -->
                
                                            <div class="position-relative mb-4">
                                                <canvas id="sales-chart" height="200"></canvas>
                                            </div>
                
                                            <div class="d-flex flex-row justify-content-end">
                                                <span class="mr-2">
                                                    <i class="fas fa-square text-primary"></i> This year
                                                </span>
                
                                                <span>
                                                    <i class="fas fa-square text-gray"></i> Last year
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>                
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
// Set a flag to track if the chart is initialized
$('#infografis').data('initialized', false);

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    // Check if the "infografis" tab is active and not yet initialized
    if ($(e.target).attr('href') === '#infografis' && !$('#infografis').data('initialized')) {
        // Initialize the chart only once
        var $salesChart = $('#sales-chart')[0].getContext('2d');
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                datasets: [
                    {
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
                        data: [1000, 2000, 3000, 2500, 2700, 2500, 3000]
                    },
                    {
                        backgroundColor: '#ced4da',
                        borderColor: '#ced4da',
                        data: [700, 1700, 2700, 2000, 1800, 1500, 2000]
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function (value) {
                                if (value >= 1000) {
                                    value /= 1000;
                                    value += 'k';
                                }
                                return '$' + value;
                            }
                        }
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontStyle: 'bold'
                        }
                    }]
                }
            }
        });
        
        // Mark the chart as initialized
        $('#infografis').data('initialized', true);
    }
});
</script>
@endsection
