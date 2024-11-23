@extends('halaman.admin')
@section('content')

<link rel="stylesheet" href="/css/style-chart-transaksi.css" />

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script src="https://code.highcharts.com/highcharts.js"></script>


    <div class="container">
        <!-- Top Section -->
        <div class="top-section">
            <!-- Left Section -->
            <div class="left-section">
                <!-- Filter Section -->
                <div class="filter-section">
                    <h2>Filter</h2>
                    <form id="filterForm">
                        <label for="timeInterval">Pilih Interval:</label>
                        <select id="timeInterval" name="timeInterval">
                            <option value="day">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                        </select>

                        <label for="startDate">Start Date:</label>
                        <input type="date" id="startDate" name="startDate">

                        <label for="endDate">End Date:</label>
                        <input type="date" id="endDate" name="endDate">
                        
                        <label for="pilihKategori">Pilih Kategori:</label>
                        <select id="pilihKategori" name="pilihKategori">
                            <option value="semuaKategori">Semua Kategori</option>
                            <option value="">Adjust Kategori dari DB</option>
                        </select>

                        <label for="pilihProduk">Pilih Produk:</label>
                        <select id="pilihProduk" name="pilihProduk">
                            <option value="semuaProduk">Semua Produk</option>
                            <option value="">Adjust Produk dari DB</option>
                        </select>

                        <button type="submit" class="btn-filter">Terapkan</button>
                    </form>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="chart-container">
                {{-- <h2>Grafik Transaksi</h2> --}}
                <div id="productQtyChart"></div>
            </div>
        </div>

        <!-- Transaction Table Section -->
        <div class="transaction-section">
            <h2>Daftar Transaksi</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tanggal Pembelian</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Produk</th>
                        {{-- <th>Jumlah Produk</th> --}}
                        <th>Harga Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Group transactions by order_id
                        $groupedTransactions = $tf->groupBy('order_id');
                    @endphp
                    @foreach ($groupedTransactions as $order_id => $transactions)
                        @php $rowspan = count($transactions); @endphp
                        @foreach ($transactions as $index => $t)
                            <tr>
                                @if ($index === 0)
                                    <td rowspan="{{ $rowspan }}">{{ $t->order_id }}</td>
                                @endif
                                <td>{{ $t->kategori->name }}</td>
                                <td>{{ $t->nama_produk }}</td>
                                <td>{{ $t->qty }}</td>
                                @if ($index === 0)
                                    <td rowspan="{{ $rowspan }}">{{ number_format($t->total_pembayaran, 0, ',', '.') }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ ucfirst($t->status) }}</td>
                                @endif
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
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
        // Data Dummy untuk Grafik
        const categories = ['Produk A', 'Produk B', 'Produk C', 'Produk D', 'Produk E', 'Produk F', 'Produk G'];
        const data = [150, 200, 300, 100,40,33,12]; // Jumlah transaksi per produk

        // Inisialisasi Highcharts
        Highcharts.chart('productQtyChart', {
            chart: {
                type: 'line', // Tipe grafik (bar, line, column, etc.)
                backgroundColor: '#fff',
                borderRadius: 10,
            },
            title: {
                text: 'Jumlah Transaksi per Produk',
                style: {
                    color: '#4caf50',
                    fontSize: '20px',
                },
            },
            xAxis: {
                categories: categories, // Kategori pada sumbu X
                title: {
                    text: 'Produk',
                },
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Transaksi',
                },
            },
            series: [{
                name: 'Jumlah Transaksi',
                data: data, // Data untuk grafik
                color: '#8bc34a', // Warna batang grafik
            }],
            credits: {
                enabled: false, // Menonaktifkan watermark "Highcharts.com"
            },
            tooltip: {
                valueSuffix: ' transaksi',
            },
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
@endsection