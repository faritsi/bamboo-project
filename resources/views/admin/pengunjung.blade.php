<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .summary-box {
            background-color: white;
            color: black;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            width: 250px;
            margin: 20px auto;
        }

        .chart-container {
            width: 80%;
            margin: 0 auto;
        }

        .summary-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <canvas id="visitorChart"></canvas>
    </div>

    <div class="summary-container">
        <div class="summary-box">
            <h4>Visitor Stats</h4>
            <p>Today: {{ $today }}</p>
            <p>This Week: {{ $thisWeek }}</p>
            <p>This Month: {{ $thisMonth }}</p>
            <p>Total: {{ $totalVisits }}</p>
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
