<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/css/style-pengunjung.css" />

</head>
<body>
    <div class="visitor-container">
        <!-- Chart Container -->
        <div class="chart-container">
            <h2>Jumlah Pengunjung</h2>
            <canvas id="visitorChart"></canvas>
        </div>
    
        <!-- Summary Container -->
        <div class="summary-container">
            <div class="summary-box">
                <h3>Statistik Pengunjung</h3>
                <p><strong>Hari Ini:</strong> {{ $today }}</p>
                <p><strong>Minggu Ini:</strong> {{ $thisWeek }}</p>
                <p><strong>Bulan Ini:</strong> {{ $thisMonth }}</p>
                <p><strong>Total:</strong> {{ $totalVisits }}</p>
            </div>
        </div>
    </div>
    

    <script>
        const ctx = document.getElementById('visitorChart').getContext('2d');
        const visitorData = {
            labels: [
                @foreach($dailyVisitors as $visitor)
                    "{{ $visitor->date }}",
                @endforeach
            ],
            datasets: [{
                label: 'Daily Visitors',
                data: [
                    @foreach($dailyVisitors as $visitor)
                        {{ $visitor->count }},
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        const visitorChart = new Chart(ctx, {
            type: 'bar', // Change this to 'line' if you prefer a line chart
            data: visitorData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>