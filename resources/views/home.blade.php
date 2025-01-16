@extends('layouts.frontend')

@section('title', 'Akreditasi UNS | LPPMP UNS')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div id="customCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#customCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#customCarousel" data-slide-to="1"></li>
                            <li data-target="#customCarousel" data-slide-to="2"></li>
                            <li data-target="#customCarousel" data-slide-to="3"></li>
                        </ol>

                        <!-- Carousel Items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('img/sertifikat.jpg') }}" class="d-block w-100 carousel-image"
                                    alt="Slide 1">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Slide Title 1</h5>
                                    <p>Slide Description 1</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/uns.png') }}" class="d-block w-100 carousel-image"
                                    alt="Slide 2">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Slide Title 2</h5>
                                    <p>Slide Description 2</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/sertifikat.jpg') }}" class="d-block w-100 carousel-image"
                                    alt="Slide 3">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Slide Title 3</h5>
                                    <p>Slide Description 3</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('img/uns.png') }}" class="d-block w-100 carousel-image"
                                    alt="Slide 4">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Slide Title 4</h5>
                                    <p>Slide Description 4</p>
                                </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="carousel-control-prev" href="#customCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#customCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ sumFakultas() }}</h3>

                            <p>Fakultas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-university"></i>
                        </div>
                        <a href="{{ route('fakultas') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ sumProdi() }}</h3>

                            <p>Program Studi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-university"></i>
                        </div>
                        <a href="{{ route('prodi') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ sumProdiUnggul() }} <sup style="font-size: 20px">Prodi</sup></h3>

                            <p>Terakreditasi Unggul</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ribbon-b"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ sumProdiInternasional() }} <sup style="font-size: 20px">Prodi</sup></h3>

                            <p>Terakreditasi Internasional</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ribbon-b"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-muted border-bottom-0">
                            Akreditasi Universitas
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Universitas Sebelas Maret</b></h2>

                                    <ul class="ml-4 my-4 fa-ul text-muted">
                                        <li><span class="fa-li"><i class="fas fa-lg fa-landmark"></i></span>
                                            Lembaga Pengakreditasi<br><b>BAN PT</b>
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-lg fa-thumbtack"></i></span>
                                            Standar yang Digunakan<br><b>SK PerBAN-PT No. 5 Tahun 2024</b>
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-lg fa-award"></i></span>
                                            Nilai<br><b>UNGGUL</b>
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                            Periode<br><b>18 Juli 2023 s/d 18 Juli 2028</b>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ asset('img/uns.png') }}" alt="Logo UNS" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header text-muted border-bottom-0">
                            Sertifikat Akreditasi
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <ul class="ml-4 my-2 fa-ul text-muted">
                                        <li><span class="fa-li"><i class="fas fa-lg fa-certificate"></i></span>
                                            No Sertifikat<br><b>No. 451/SK/BAN-PT/Ak.Ppj/PT/VII/2023</b>
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-lg fa-award"></i></span>
                                            Nilai<br><b>UNGGUL</b>
                                        </li>
                                        <li><span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span>
                                            Periode<br><b>18 Juli 2023 s/d 18 Juli 2028</b>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <a href="{{ asset('img/sertifikat.jpg') }}" class="image-popup">
                                        <img class="img-fluid" src="{{ asset('img/sertifikat.jpg') }}"
                                            alt="Sertifikat Akreditasi UNS">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header text-muted border-bottom-0"></div>
                        <div class="card-body">
                            {!! $grafik->container() !!}
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-muted text-center"><h3>Capaian Peringkat Akreditasi Nasional Universitas Sebelas Maret</h3></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div style="height: 600px; display: flex; align-items: center; justify-content: center;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Peringkat</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $jumlah)
                                                <tr>
                                                    <td class="text-center">{{ $label[$key] }}</td>
                                                    <td class="text-center">{{ $jumlah }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-center"><b>Total</b></td>
                                                    <td class="text-center"><b>{{ array_sum($data) }}</b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div style="height: 600px; display: flex; align-items: center; justify-content: center;">
                                        <canvas id="nasionalChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-muted text-center"><h3>Capaian Akreditasi Internasional Universitas Sebelas Maret</h3></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div style="height: 600px; display: flex; align-items: center; justify-content: center;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Lembaga Akreditasi</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($internasional['labels'] as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ $value }}</td>
                                                    <td class="text-center">{{ $internasional['values'][$key] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-center"><b>Total</b></td>
                                                    <td class="text-center"><b>{{ array_sum($internasional['values']) }}</b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div style="height: 600px; display: flex; align-items: center; justify-content: center;">
                                        <canvas id="internasionalChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-muted text-center"><h3>Cakupan Lembaga Akreditasi, Akreditasi Nasional Universitas Sebelas Maret</h3></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div style="height: 600px; display: flex; align-items: center; justify-content: center;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Lembaga Akreditasi</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cakupan['labels'] as $key => $value)
                                                <tr>
                                                    <td class="text-center">{{ $value }}</td>
                                                    <td class="text-center">{{ $cakupan['values'][$key] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-center"><b>Total</b></td>
                                                    <td class="text-center"><b>{{ array_sum($cakupan['values']) }}</b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div style="height: 600px; display: flex; align-items: center; justify-content: center;">
                                        <canvas id="cakupanChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{{ $grafik->script() }}

<script>
  var colors = ['#FF5733', '#33B5FF', '#FFEB3B', '#8BC34A', '#9C27B0','#FF9800', '#607D8B'];
  
  var ctx = document.getElementById('nasionalChart').getContext('2d');
  var nasionalChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: @json($label),
          datasets: [{
              label: 'Program Studi',
              data: @json($data),
              backgroundColor: colors, // Using 7 colors for the pie chart sections
              hoverOffset: 4,
          }]
      },
      options: {
          responsive: true,
          plugins: {
              tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            // const total = context.dataset.data
                            //     .filter((val, index) => !context.chart.getDatasetMeta(0).data[index].hidden) // Only sum visible data points
                            //     .reduce((sum, val) => sum + val, 0);
    
                            // const percentage = ((value / total) * 100).toFixed(1);

                            return ` ${value} Program Studi`;
                        }
                    }
              },
              legend: {
                position: 'right',  // Set legend to appear on the left side
                labels: {
                    font: {
                        size: 14,  // Customize font size of the legend
                    },
                    padding: 10,
                },
              },
          }
      }
  });

  var ctxInter = document.getElementById('internasionalChart').getContext('2d');
  var internasionalChart = new Chart(ctxInter, {
      type: 'pie',
      data: {
          labels: @json($internasional['labels']),
          datasets: [{
              label: 'Program Studi',
              data: @json($internasional['values']),
              backgroundColor: colors, // Using 7 colors for the pie chart sections
              hoverOffset: 4,
          }]
      },
      options: {
          responsive: true,
          plugins: {
              tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            // const total = context.dataset.data
                            //     .filter((val, index) => !context.chart.getDatasetMeta(0).data[index].hidden) // Only sum visible data points
                            //     .reduce((sum, val) => sum + val, 0);
    
                            // const percentage = ((value / total) * 100).toFixed(1);

                            return ` ${value} Program Studi`;
                        }
                    }
              },
              legend: {
                position: 'right',  // Set legend to appear on the left side
                labels: {
                    font: {
                        size: 14,  // Customize font size of the legend
                    },
                    padding: 10,
                },
              },
          }
      }
  });

  var ctxCakupan = document.getElementById('cakupanChart').getContext('2d');
  var cakupanChart = new Chart(ctxCakupan, {
      type: 'pie',
      data: {
          labels: @json($cakupan['labels']),
          datasets: [{
              label: 'Program Studi',
              data: @json($cakupan['values']),
              backgroundColor: colors, // Using 7 colors for the pie chart sections
              hoverOffset: 4,
          }]
      },
      options: {
          responsive: true,
          plugins: {
              tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            // const total = context.dataset.data
                            //     .filter((val, index) => !context.chart.getDatasetMeta(0).data[index].hidden) // Only sum visible data points
                            //     .reduce((sum, val) => sum + val, 0);
    
                            // const percentage = ((value / total) * 100).toFixed(1);

                            return ` ${value} Program Studi`;
                        }
                    }
              },
              legend: {
                position: 'right',  // Set legend to appear on the left side
                labels: {
                    font: {
                        size: 14,  // Customize font size of the legend
                    },
                    padding: 10,
                },
              },
          }
      }
  });
</script>
@endsection
