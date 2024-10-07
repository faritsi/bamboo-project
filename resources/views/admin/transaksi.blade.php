<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
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
</body>
</html>
