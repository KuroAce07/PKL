@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-3">Welcome To E-CASH Dashboard!</h2>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Dokumen Pencairan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $arsipCount }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-file-archive fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>



        <!-- Earnings (Monthly) Card Example -->
        @php
    // Calculate the total anggaran by summing up the nilai_spm values
    $totalAnggaran = \App\Models\ArsipLama::sum('nilai_spm');
@endphp

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total SPM Dokumen</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp. {{ number_format($totalAnggaran, 2, ',', '.') }}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-file-archive fa-2x text-gray-300"></i> <!-- Archive icon -->
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dokumen Yang Diproses</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dpaCount }}</div>
                </div>
                <div class="col-auto">
                    <i class="far fa-file-alt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dokumen Yang Sudah Terealisasi</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $realisasiCount }}</div>
                </div>
                <div class="col-auto">
                    <i class="far fa-file-alt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Pending Requests Card Example -->
        @php
    // Get all DPA records
    $dpas = \App\Models\DPA::all();
    $reals = \App\Models\Realisasi::all();
    // Initialize the total nilai_rincian
    $totalDana = 0;
    $totalreal = 0;
    // Loop through each DPA record and add its nilai_rincian value to the total
    foreach ($dpas as $dpa) {
        // Remove currency symbol and non-numeric characters from the string
        $danaValue = preg_replace('/[^0-9]/', '', $dpa->total_rak);

        // Convert the cleaned string value to a numeric value and add it to the total
        $totalDana += (int) $danaValue;
    }
    foreach ($reals as $real) {
        // Remove currency symbol and non-numeric characters from the string
        $realvalue = preg_replace('/[^0-9]/', '', $real->total_rak);

        // Convert the cleaned string value to a numeric value and add it to the total
        $totalreal += (int) $realvalue;
    }
    $sisa = $totalDana - $totalreal;
@endphp
<div class="col-12 d-flex justify-content-center">
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Pagu Anggaran</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp. {{ number_format($totalDana, 2, ',', '.') }}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i> <!-- Money icon -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Realisasi Anggaran</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp. {{ number_format( $totalreal, 2, ',', '.') }}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i> <!-- Money icon -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Sisa Pagu </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp. {{ number_format( $sisa, 2, ',', '.') }}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i> <!-- Money icon -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>

 <!-- Chart: Pie Chart -->
 <div class="col-xl-4 col-lg-5 mb-4">
    <div class="card shadow">
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie">
                <canvas id="myPieChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
            </div>
        </div>
    </div>
</div>

<div class="col-xl-4 col-lg-5 mb-4">
    <div class="card shadow">
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-line">
                <canvas id="myLineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-4 col-lg-5 mb-4">
    <div class="card shadow">
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-bar">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
    </div>
</div>



</div>

   <script>
    document.addEventListener("DOMContentLoaded", function() {
        var pieChartCanvas = document.getElementById('myPieChart').getContext('2d');

        var danaDibutuhkan = {{ $totalDana }};
        var danaTerealisasi = {{ $totalreal }};
        var danaKurang = {{ $sisa }};

        var chartData = {
            labels: ['Dana Yang Dibutuhkan', 'Dana Yang Terealisasi', 'Dana Yang Kurang'],
            datasets: [{
                data: [danaDibutuhkan, danaTerealisasi, danaKurang],
                backgroundColor: ['#ffc107', '#28a745', '#dc3545'],
                hoverBackgroundColor: ['#ffc107', '#28a745', '#dc3545'],
            }]
        };

        var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                // Additional chart options can be configured here
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var lineChartCanvas = document.getElementById('myLineChart').getContext('2d');

        // Sample data for the Line Chart
        var chartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Dana Terealisasi',
                data: [1000, 2000, 1500, 3000, 2500, 4000, 3500],
                borderColor: '#28a745',
                backgroundColor: 'transparent',
                pointBackgroundColor: '#28a745',
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBorderWidth: 2,
                tension: 0.3,
            }]
        };

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Dana'
                        }
                    }
                }
                // Additional chart options can be configured here
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var barChartCanvas = document.getElementById('myBarChart').getContext('2d');

        // Sample data for the Bar Chart
        var chartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Dana Terealisasi',
                data: [1000, 2000, 1500, 3000, 2500, 4000, 3500],
                backgroundColor: '#28a745',
                borderWidth: 0,
                borderRadius: 4,
            },
            {
                label: 'Dana Yang Kurang',
                data: [200, 300, 150, 1000, 500, 900, 200],
                backgroundColor: '#dc3545',
                borderWidth: 0,
                borderRadius: 4,
            },
            {
                label: 'Dana Yang Dibutuhkan',
                data: [1200, 1700, 1350, 2000, 2000, 2900, 2800],
                backgroundColor: '#ffc107',
                borderWidth: 0,
                borderRadius: 4,
            }]
        };

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        barPercentage: 0.4, // Adjust this value to control width of individual bars
                        categoryPercentage: 0.8, // Adjust this value to control spacing between groups
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Dana'
                        }
                    }
                }
                // Additional chart options can be configured here
            }
        });
    });
</script>
<script src="{{asset('admin/vendor/chart.js/Chart.js')}}"></script>

@endsection