@extends('halaman.admin')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<link rel="stylesheet" href="/css/style-pengunjung.css" />

<div class="container">
    <!-- Top Section -->
    <div class="top-section">
        <!-- Left Section -->
        <div class="left-section">
            <!-- Filter Section -->
            <div class="filter-section">
                <h2>Filter</h2>
                <form id="filterForm" action="{{route('visitor.showStats')}}" method="GET"> 
                    @csrf
                    @method('POST')
                    <label for="timeInterval">Pilih Interval:</label>
            
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" name="startDate" value={{$startDate}} required>

                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" name="endDate" value={{$endDate}} required>

                    <button type="submit" class="btn-filter">Tampilkan Data</button>
                </form>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-container">
            <div id="visitorChart"></div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk merender grafik dengan data dari server
    const renderChart = (data) => {
        Highcharts.chart('visitorChart', {
            chart: { type: 'line', backgroundColor: '#ffffff', borderRadius: 10},
            title: { text: 'Pengunjung Harian', style: { color: '#4caf50', fontSize: '18px' } },
            xAxis: { categories: data.map(item => item.date), title: { text: 'Tanggal', style: { color: '#333' } } },
            yAxis: { title: { text: 'Jumlah Pengunjung', style: { color: '#333' } }, allowDecimals: false, min: 0 },
            series: [{
                name: 'Pengunjung',
                data: data.map(item => item.count),
                color: '#8bc34a',
                lineWidth: 3,
                marker: { enabled: true, radius: 5, fillColor: '#4caf50' }
            }],
            tooltip: { valueSuffix: ' pengunjung', backgroundColor: '#ffffff', borderColor: '#8bc34a', style: { color: '#333' } },
            credits: { enabled: false }
        });
    };

    // Muat data default dari controller
    const initialData = @json($dailyVisitors);
    // console.log(initialData);
    renderChart(initialData);

    // Handle filter form submission
   
</script>
@endsection