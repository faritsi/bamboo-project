<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach($ingpo as $i)
        <link rel="icon" href="{{ asset('/storage/' . $i->favicon) }}" type="image/x-icon">
    @endforeach
    <link rel="stylesheet" href="{{ asset('css/style-invoice.css') }}">
    <title>Invoice {{ $invoice->order_id }}</title>
</head>
<body>
    <div class="wrapper-bg">
        <div class="container">
            <div class="invoice-page">
                <h2>Invoice {{ $invoice->order_id }}</h2>
                <h3>Tanggal: {{ $invoice->formatted_date }}</h3>

                <div class="biodata-pembeli">
                    <h3>Biodata Pembeli</h3>
                    <div class="biodata-display">
                        <p><strong>Nama Lengkap:</strong> {{ $invoice->name }}</p>
                        <p><strong>No. Telepon:</strong> {{ $invoice->nohp }}</p>
                        <p><strong>Alamat:</strong> {{ $invoice->alamat }}</p>
                        <p><strong>Kota:</strong> {{ $invoice->city }}</p>
                        <p><strong>Kode Pos:</strong> {{ $invoice->pos }}</p>
                        <p><strong>Provinsi:</strong> {{ $invoice->province }}</p>
                        <p><strong>Kurir:</strong> {{ $invoice->courier }}</p>
                        <p><strong>Layanan Pengiriman:</strong> {{ $invoice->courier_service }}</p>
                        <p><strong>Biaya Pengiriman:</strong> Rp. {{ number_format($invoice->cost, 0, ',', '.') }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ $invoice->bank ? $invoice->bank : $invoice->store_name }}</p>
                        <p><strong>Status Pembayaran:</strong> {{ $invoice->status }}</p>
                    </div>
                </div>

                <div class="order-summary">
                    <h3>Ringkasan Pesanan</h3>
                    @foreach ($items as $item)

                    <div class="order-items">
                            <p><strong>Produk: </strong>{{ $item->nama_produk }}</p>
                            <p><strong>Jumlah: </strong>{{ $item->qty }}</p>
                            <p><strong>Harga: </strong>Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
                            <p><strong>Subtotal: </strong>Rp. {{ number_format($item->harga * $item->qty, 0, ',', '.') }}</span></p>
                    </div>
                    @endforeach
                </div>

                <div class="wrapper-pay-print">

                    <button onclick="printInvoice()" class="btn-print">
                        <span class="material-symbols-outlined">
                            print
                        </span>
                        Print Invoice
                    </button>
                    <div class="total-payment">
                        <h3>Total Pembayaran</h3>
                        <p><strong>Total:</strong> Rp. {{ number_format($invoice->total_pembayaran, 0, ',', '.') }}</p>
                    </div>

                    
                </div>

            </div>
        </div>
    </div>
    <script>
       function printInvoice() {
        window.print();  // Fungsi untuk memanggil dialog print
    }
    </script>
</html>