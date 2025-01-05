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
                    <form id="filterForm" action="{{route('pembelian.sales')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('POST') --}}
                        <label for="startDate">Start Date:</label>
                        <input type="date" id="startDate" name="startDate" value={{$groupedTransactions['startDate']}} >

                        <label for="endDate">End Date:</label>
                        <input type="date" id="endDate" name="endDate" value={{$groupedTransactions['endDate']}}>
                        
                        <label for="pilihKategori">Pilih Kategori:</label>
                        <select id="pilihKategori" name="pilihKategori" >
                            <option value="semuaKategori" 
                                {{ (request('pilihKategori') == 'semuaKategori' || session('pilihKategori') == 'semuaKategori') ? 'selected' : '' }}>
                                Semua Kategori
                            </option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->name }}" 
                                    {{ (request('pilihKategori') == $k->name || session('pilihKategori') == $k->name) ? 'selected' : '' }}>
                                    {{ $k->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="pilihProduk">Pilih Produk:</label>
                        <select id="pilihProduk" name="pilihProduk">
                            <option value="semuaProduk" 
                                {{ session('pilihProduk') == 'semuaProduk' ? 'selected' : '' }}>
                                Semua Produk
                            </option>
                            @foreach ($produk as $p)
                                @if ($pilihKategori == 'semuaKategori' || $p->kategori->id == $pilihKategori)
                                    <option value="{{ $p->nama_produk }}" 
                                        {{ session('pilihProduk') == $p->nama_produk ? 'selected' : '' }}>
                                        {{ $p->nama_produk }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        
                        {{-- <button type="submit" class="btn-filter">Tampilkan Data</button> --}}
                    </form>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="chart-container">
                {{-- <h2>Grafik Transaksi</h2> --}}
                <div id="salesChart"></div>
            </div>
        </div>

        <!-- Transaction Table Section -->
        <div class="transaction-section">
            <h2>Daftar Transaksi</h2>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Order ID</th>
                        <th>Tanggal Pembelian</th>
                        <th>Nama Pembeli</th>
                        <th class="nama-produk">Nama Produk</th>
                        {{-- <th>Jumlah Produk</th> --}}
                        <th>Harga Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedTransactions["groupedTransactions"] as $order_id => $transactions)
                    
                        @php $rowspan = count($transactions); @endphp
                        @foreach ($transactions as $index => $t)
                            <tr>
                                @if ($index === 0)
                                <td rowspan="{{ $rowspan }}">
                                    <a href="{{ route('invoice.view', ['orderId' => $t->order_id]) }}" class="btnInvoice">
                                        <span class="material-symbols-outlined">
                                            visibility
                                        </span>
                                    </a>
                                </td>
                                @endif
                                @if ($index === 0)
                                    <td rowspan="{{ $rowspan }}">{{ $t->order_id }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $t->created_at->format('d M Y') }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $t->name }}</td> 
                                @endif
                                <td class="nama-produk">{{ $t->nama_produk }}</td>
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

        <div class="pagination-section">
            <div class="pagination-links">
                <a href="{{$groupedTransactions["tfFirstPageUrl"]}}" class="page-link">&#171;</a>
                <a href="{{$groupedTransactions["tfPreviousPageUrl"]}}" class="page-link">&#10094;</a>

                @foreach ($groupedTransactions['tfPagination']->getUrlRange(1, $groupedTransactions['tfTotalPages']) as $page => $url)
                <a 
                    href="{{ $url }}" 
                    class="page-link {{ $page == $groupedTransactions['tfCurrentPage'] ? 'active' : '' }}">
                    {{ $page }}
                </a>
                @endforeach

                <a href="{{$groupedTransactions["tfNextPageUrl"]}}" class="page-link">&#10095;</a>
                <a href="{{$groupedTransactions["tfLastPageUrl"]}}" class="page-link">&#187;</a>
            </div>
        </div> 
    </div>

    {{-- Modal Show Invoice --}}
    @foreach ($groupedTransactions["groupedTransactions"] as $order_id => $transactions)
    <div id="showInvoice-{{ $order_id }}" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="head-modul">
                <h1>Invoice</h1>
            </div>

            <div id="co-head">
                <h3>Data Pembeli</h3>
                <hr id="head">
            </div>

            <div class="form-group">
                <label for="name-{{ $transactions->first()->name }}">Nama Pembeli</label>
                <input type="text" id="name-{{$transactions->first()->name  }}" name="name" value="{{ $transactions->first()->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="alamat-{{ $transactions->first()->alamat }}">Alamat Pembeli</label>
                <input type="text" id="alamat-{{$transactions->first()->alamat  }}" name="alamat" value="{{ $transactions->first()->alamat }}" readonly>
            </div>

            <div class="form-group">
                <label for="pos-{{ $transactions->first()->pos }}">No Pos Pembeli</label>
                <input type="text" id="pos-{{$transactions->first()->pos  }}" name="pos" value="{{ $transactions->first()->pos }}" readonly>
            </div>

            <div class="form-group">
                <label for="city-{{ $transactions->first()->city }}">Kota Pembeli</label>
                <input type="text" id="city-{{$transactions->first()->city  }}" name="city" value="{{ $transactions->first()->city }}" readonly>
            </div>
            
            <div id="co-head">
                <h3>Produk</h3>
                <hr>
            </div>

            <div class="form-group">
                <label for="order_id-{{ $t->order_id }}">ORDER ID</label>
                <input type="text" id="order_id-{{$order_id  }}" name="order_id" value="{{ $order_id }}" readonly>
            </div>

            @foreach ($transactions as $index => $t)
                <div class="form-group">
                    <label for="kategori-{{ $index }}">Kategori</label>
                    <input type="text" id="kategori-{{ $index }}" name="kategori[]" value="{{ $t->kategori_id }}" readonly>
                </div>
                <div class="form-group">
                    <label for="kode_produk-{{ $index }}">Kode Produk</label>
                    <input type="text" id="kode_produk-{{ $index }}" name="kode_produk[]" value="{{ $t->kode_produk }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_produk-{{ $index }}">Nama Produk</label>
                    <input type="text" id="nama_produk-{{ $index }}" name="nama_produk[]" value="{{ $t->nama_produk }}" readonly>
                </div>
                <div class="form-group">
                    <label for="qty-{{ $index }}">Jumlah Produk</label>
                    <input type="text" id="qty-{{ $index }}" name="qty[]" value="{{ $t->qty }}" readonly>
                </div>
                <hr id="batas-produk">
            @endforeach

            {{-- BUAT KURIR --}}

            {{-- <div class="form-group">
                <label for="total_pembayaran-{{ $t->total_pembayaran }}">Total Harga</label>
                <input type="text" id="total_pembayaran-{{$t->total_pembayaran  }}" name="total_pembayaran" value="{{ $t->total_pembayaran }}" readonly>
            </div>

            <div class="form-group">
                <label for="total_pembayaran-{{ $t->total_pembayaran }}">Total Harga</label>
                <input type="text" id="total_pembayaran-{{$t->total_pembayaran  }}" name="total_pembayaran" value="{{ $t->total_pembayaran }}" readonly>
            </div> --}}

            <div class="form-group">
                <label for="total_pembayaran-{{ $t->total_pembayaran }}">Total Harga</label>
                <input type="text" id="total_pembayaran-{{$t->total_pembayaran  }}" name="total_pembayaran" value="{{ number_format($t->total_pembayaran, 0, ',', '.') }}" readonly>
            </div>

            <div class="form-group">
                <label for="status-{{ $t->status }}">Status Pembelian</label>
                <input type="text" id="status-{{$t->status  }}" name="status" value="{{ $t->status }}" readonly>
            </div>
        </div>
    </div>
    @endforeach


    <script>   

    // Modal
    $(document).ready(function () {

        function showModal(modalId) {
            $(modalId).show();
        }

        function hideModals() {
            $(".modal").hide();
        }

        $(".close").on("click", function () {
            hideModals();
        });

        $(window).on("click", function (event) {
            if ($(event.target).hasClass("modal")) {
                hideModals();
            }
        });

        $(".btnInvoice").on("click", function () {
            var order_id = $(this).data('id');
            showModal("#showInvoice-" + order_id);
        });


    })

    // Function to update the sales chart
    function updateSalesData(data) {
        Highcharts.chart('salesChart', {
            chart: {
                type: 'column',
                backgroundColor: '#ffffff',
                borderRadius: 10
            },
            title: {
                text: 'Penjualan Produk',
                style: { color: '#4caf50', fontSize: '18px' }
            },
            xAxis: {
                categories: data.map(item => item.saleDate),
                title: { text: 'Tanggal Terjual', style: { color: '#333' } },
                tickInterval: 1
            },
            yAxis: {
                title: {
                    text: 'Jumlah Terjual',
                    style: { color: '#333' }
                },
                allowDecimals: false,
                min: 0
            },
            series: [{
                name: 'Jumlah Terjual',
                data: data.map(item => ({
                    y: parseInt(item.totalSold),
                    name: item.product,
                    date: item.saleDate
                })),
                color: '#8bc34a',
                marker: {
                    enabled: true,
                    radius: 8,
                    symbol: 'circle'
                },
                lineWidth: 3,
                dataLabels: {
                    enabled: true,
                    formatter: function () {
                        return this.point.y;
                    },
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold',
                        color: '#fff'
                    },
                    verticalAlign: 'middle',
                    y: 5
                },
                
            }],
            legend: {
                enabled: false // Hides the legend
            },
            credits: { enabled: false }
        });
    }

    // Function to update the transaction table
    function updateTransactionTable(transactions) {
        const tableBody = document.querySelector('.transaction-section tbody');
        if (!tableBody) {
            console.error('Transaction table body not found!');
            return;
        }

        tableBody.innerHTML = ''; // Clear the table

        if (transactions.length === 0) {
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = `
                <td colspan="7" class="text-center">No transactions found for the selected filters.</td>
            `;
            tableBody.appendChild(emptyRow);
        } else {
            transactions.forEach(transaction => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <a href="/invoice/${transaction.order_id}" class="btnInvoice">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                    </td>
                    <td>${transaction.order_id}</td>
                    <td>${new Date(transaction.created_at).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                    })}</td>
                    <td>${transaction.name}</td>
                    <td>${transaction.nama_produk}</td>
                    <td>${new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(transaction.total_pembayaran)}</td>
                    <td>${transaction.status.charAt(0).toUpperCase() + transaction.status.slice(1)}</td>
                `;
                tableBody.appendChild(row);
            });
        }
    }


    // Load initial data
    document.addEventListener('DOMContentLoaded', function () {
        const initialSalesData = @json($salesData);
        const initialTableData = @json($tableTransactionData['tfItems']);

        updateSalesData(initialSalesData);
        updateTransactionTable(initialTableData);
        
    });


    // AJAX logic for filter changes
    document.querySelectorAll('#filterForm input, #filterForm select').forEach(element => {
        element.addEventListener('change', function () {
            const formData = new FormData(document.getElementById('filterForm'));

            // Convert FormData to JSON
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            fetch("{{ route('get.filtered.data') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                // Track the currently selected product
                const selectedValue = document.getElementById('pilihProduk').value;

                // Update the product dropdown
                const produkDropdown = document.getElementById('pilihProduk');
                produkDropdown.innerHTML = '<option value="semuaProduk">Semua Produk</option>';
                data.produk.forEach(produk => {
                    const option = document.createElement('option');
                    option.value = produk.nama_produk;
                    option.textContent = produk.nama_produk;
                    produkDropdown.appendChild(option);
                });

                // Restore the selected value if it exists in the new options
                const restoredOption = Array.from(produkDropdown.options).find(option => option.value === selectedValue);
                if (restoredOption) {
                    produkDropdown.value = selectedValue;
                } else {
                    produkDropdown.value = 'semuaProduk'; // Default to 'Semua Produk' if the value is not available
                }

                // Update charts and tables
                updateSalesData(data.salesData);
                updateTransactionTable(data.tableTransaksi.transactions);
            })
            .catch(error => console.error('Error:', error));
        });
    });



    </script>
@endsection