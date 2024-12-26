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
                <form id="filterForm" action="{{route('visitor.showStats')}}" method="POST" enctype="multipart/form-data"> 
                    @csrf            
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" name="startDate" value={{$startDate}} required>

                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" name="endDate" value={{$endDate}} required>

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
    // Render Chart Function
    const renderChart = (data) => {
        Highcharts.chart('visitorChart', {
            chart: { type: 'line', backgroundColor: '#ffffff', borderRadius: 10 },
            title: { text: 'Pengunjung Harian', style: { color: '#4caf50', fontSize: '18px' } },
            xAxis: { 
                categories: data.map(item => item.date), 
                title: { text: 'Tanggal', style: { color: '#333' } } 
            },
            yAxis: { 
                title: { text: 'Jumlah Pengunjung', style: { color: '#333' } }, 
                allowDecimals: false, 
                min: 0 
            },
            series: [{
                name: 'Pengunjung',
                data: data.map(item => item.count),
                color: '#8bc34a',
                lineWidth: 3,
                marker: { enabled: true, radius: 5, fillColor: '#4caf50' }
            }],
            legend: {
                enabled: false // Hides the legend
            },
            tooltip: { valueSuffix: ' pengunjung', backgroundColor: '#ffffff', borderColor: '#8bc34a', style: { color: '#333' } },
            credits: { enabled: false }
        });
    };

    // Load initial data
    document.addEventListener('DOMContentLoaded', () => {
        const initialData = @json($dailyVisitors);
        renderChart(initialData);

        document.getElementById('filterForm').addEventListener('change', function (event) {

            const formData = new FormData(this);
            const data = {};
            formData.forEach((value, key) => { data[key] = value; });

            fetch("{{ route('get.visitor.stats') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                renderChart(data.dailyVisitors); // Update chart
            })
            .catch(error => console.error('Error fetching data:', error));
        });
    });
</script>

@endsection