<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 100%;
            height: 400px;
        }
        .transaction-list {
            margin-top: 20px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Dropdown for time interval -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="timeInterval">Pilih Interval:</label>
                <select id="timeInterval" class="form-control">
                    <option value="day">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                </select>
            </div>
        </div>

        <!-- Date pickers for selecting range -->
        <div class="row">
            <div class="col-md-6">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" class="form-control">
            </div>
        </div>

        <!-- Chart container -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="chart-container">
                    <canvas id="productQtyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Transaction List -->
        <div class="row mt-4 transaction-list">
            <div class="col-12">
                <h1 class="text-center">Transaction List</h1> <!-- Center the title -->
                <table class="table table-bordered text-center"> <!-- Add text-center for the table -->
                    <thead>
                        <tr>
                            <th class="text-center">Order ID</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Jumlah Produk</th>
                            <th class="text-center">Harga Total</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Group transactions by order_id
                            $groupedTransactions = $tf->groupBy('order_id');
                        @endphp

                        @foreach($groupedTransactions as $order_id => $transactions)
                            @php
                                // Calculate rowspan for the first row of this group
                                $rowspan = count($transactions);
                            @endphp

                            @foreach($transactions as $index => $t)
                                <tr>
                                    @if ($index === 0)
                                        <!-- Only show Order ID, Total Pembayaran, and Status once -->
                                        <td rowspan="{{ $rowspan }}" class="align-middle">{{ $t->order_id }}</td>
                                    @endif
                                    <td class="align-middle">{{ $t->kategori->name }}</td>
                                    <td class="align-middle">{{ $t->nama_produk }}</td>
                                    <td class="align-middle">{{ $t->qty }}</td>
                                    @if ($index === 0)
                                        <td rowspan="{{ $rowspan }}" class="align-middle">{{ $t->total_pembayaran }}</td>
                                        <td rowspan="{{ $rowspan }}" class="align-middle">{{ $t->status }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Sample data - replace this with your actual data
        const transactions = @json($tf);
        // Function to filter transactions by date range
        function filterTransactionsByDate(startDate, endDate) {
            return transactions.filter(transaction => {
                const transactionDate = new Date(transaction.created_at);
                return transactionDate >= new Date(startDate) && transactionDate <= new Date(endDate);
            });
        }
        // Function to set default date to today
        function setDefaultDate() {
            const today = new Date();
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            startDateInput.value = today.toISOString().split('T')[0];
            endDateInput.value = today.toISOString().split('T')[0];
        }
        // Function to update date range based on selected interval
        function updateDateRange(interval) {
            const today = new Date();
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            let startDate, endDate;
            if (interval === 'day') {
                startDate = today;
                endDate = today;
            } else if (interval === 'week') {
                startDate = new Date(today.setDate(today.getDate() - today.getDay()));
                endDate = new Date(today.setDate(today.getDate() + 6));
            } else if (interval === 'month') {
                startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            }
            startDateInput.value = startDate.toISOString().split('T')[0];
            endDateInput.value = endDate.toISOString().split('T')[0];
            // Automatically update the chart when interval changes
            updateChart();
        }
        // Initialize chart
        const ctx = document.getElementById('productQtyChart').getContext('2d');
        let productQtyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [], // X-axis labels (e.g., product names or order dates)
                datasets: [{
                    label: 'Jumlah Produk (Qty)',
                    data: [], // Y-axis data (e.g., qty sums)
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'Jumlah Produk: ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
        // Update chart based on date range
        function updateChart() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            if (startDate && endDate) {
                const filteredData = filterTransactionsByDate(startDate, endDate);
                
                // Process filtered data to get the sum of qty for each product/category/date, etc.
                const labels = [...new Set(filteredData.map(t => t.nama_produk))]; // Unique product names
                const data = labels.map(label => {
                    return filteredData
                        .filter(t => t.nama_produk === label)
                        .reduce((sum, t) => sum + t.qty, 0); // Sum of qty for each product
                });
                // Update chart labels and data
                productQtyChart.data.labels = labels;
                productQtyChart.data.datasets[0].data = data;
                productQtyChart.update();
            }
        }
        // Add event listeners to date inputs and interval dropdown
        document.getElementById('startDate').addEventListener('change', updateChart);
        document.getElementById('endDate').addEventListener('change', updateChart);
        document.getElementById('timeInterval').addEventListener('change', function() {
            updateDateRange(this.value);
        });
        // Set default date to today and default interval to 'Hari Ini'
        setDefaultDate();
        updateDateRange('day');
    </script>
</body>
</html>