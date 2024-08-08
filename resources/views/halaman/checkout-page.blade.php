<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- LINK --}}
    <link rel="stylesheet" href="{{ asset('css/style-checkout.css') }}">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Checkout Page</title>
</head>
<body>
    <div id="background">
        <div id="co-background">
            <!-- Checkout Page -->
            <div id="checkout-page">
                <h2>Halaman Checkout</h2>
                <div id="biodata-display">
                    <h3>Biodata Pengiriman</h3>
                    <p><strong>Nama Lengkap:</strong> <span id="display-nama-lengkap">Mochamad Hafied Ibni Anwar</span></p>
                    <p><strong>Alamat:</strong> <span id="display-alamat">Ujung Berung</span></p>
                    <p><strong>Kota:</strong> <span id="display-kota"></span>Bandung</p>
                    <p><strong>Kode Pos:</strong> <span id="display-kode-pos">40611</span></p>
                    <p><strong>No. Telepon:</strong> <span id="display-no-telepon">087716068691</span></p>
                </div>
                <div id="order-summary">
                    <h3>Ringkasan Pesanan</h3>
                    <div class="order-item">
                        <div class="order-details">
                            <p><strong>Nama Barang:</strong> Barang A</p>
                            <p><strong>Jumlah:</strong> 2</p>
                            <p><strong>Harga Satuan:</strong> Rp 50.000</p>
                            <p><strong>Subtotal:</strong> Rp 100.000</p>
                        </div>
                    </div>
                    {{-- <div class="order-item">
                        <div class="order-details">
                            <p><strong>Nama Barang:</strong> Barang B</p>
                            <p><strong>Jumlah:</strong> 1</p>
                            <p><strong>Harga Satuan:</strong> Rp 150.000</p>
                            <p><strong>Subtotal:</strong> Rp 150.000</p>
                        </div>
                    </div> --}}
                    <div class="order-total">
                        <p><strong>Total:</strong> Rp 250.000</p>
                    </div>
                </div>
                <button type="button" id="confirm-checkout">Konfirmasi Checkout</button>
            </div>
        </div>
    </div>
</body>
</html>