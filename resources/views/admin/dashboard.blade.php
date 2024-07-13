@extends('layouts.main')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('dist/library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('dist/library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Penyewa</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCustomer }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Paket Dimiliki</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalPackage }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Booking Aktif</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeBooking }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Booking Selesai</h4>
                            </div>
                            <div class="card-body">
                               {{ $unActiveBooking }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistics</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <a href="#"
                                        class="btn btn-primary">Bulanan</a>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart"
                                height="182"></canvas>
                            <div class="statistic-details mt-sm-4">
                                <div class="statistic-details-item">
                                   @if ($percentage > 0)
                                    <span class="text-muted"><span class="text-primary"><i
                                        class="fas fa-caret-up"></i></span> {{ $percentage }}% dari bulan lalu</span>
                                   @else
                                   <span class="text-muted"><span class="text-primary"><i
                                    class="fas fa-caret-down"></i></span> {{ $percentage }}% dari bulan lalu</span>
                                       
                                   @endif
                                    <div class="detail-value">@money($amount ,'IDR')</div>
                                    <div class="detail-name">Uang masuk bulan ini</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
        </section>
    </div>
@endsection




@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('dist/library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('dist/library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('dist/library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('dist/library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('dist/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

     <!-- Page Specific JS File -->
     <script src="{{ asset('dist/js/page/index-0.js') }}"></script>


     <script src="{{ asset('dist/library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
 
     <!-- Page Specific JS File -->
     <script src="{{ asset('dist/js/page/components-table.js') }}"></script>
 
     {{-- modal --}}
     <script src="{{ asset('dist/library/prismjs/prism.js') }}"></script>
 
     <!-- Page Specific JS File -->
     <script src="{{ asset('dist/js/page/bootstrap-modal.js') }}"></script>


     
<script>
    let myChart = null

    $(document).ready(function(){
        chart(@json($chartData), @json($dateChart))
    })

const chart = (chartData, dateChart) => {
 "use strict";

     if(myChart instanceof Chart){
         myChart.destroy()
     }

    
     const statistics_chart = document.getElementById("myChart").getContext('2d');
    
     myChart = new Chart(statistics_chart, {
     type: 'line',
     data: {
         //["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"]
         labels: dateChart,
         datasets: [{
         label: 'Total',
         data: Object.values(chartData),
         borderWidth: 5,
         borderColor: '#6777ef',
         backgroundColor: 'transparent',
         pointBackgroundColor: '#fff',
         pointBorderColor: '#6777ef',
         pointRadius: 4
         }]
     },
     options: {
         legend: {
         display: false
         },
         scales: {
         yAxes: [{
             gridLines: {
             display: false,
             drawBorder: false,
             },
             ticks: {
             stepSize: 150000
             }
         }],
         xAxes: [{
             gridLines: {
             color: '#fbfbfb',
             lineWidth: 2
             }
         }]
         },
     }
     });
    }
</script>
@endpush
