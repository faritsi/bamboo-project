<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- LINK --}}
    <link rel="stylesheet" href="{{ asset('css/style-checkout.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-F4JHAj0KtmhPFNbO"></script>
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
                    <p><strong>Nama Lengkap:</strong> <span id="name"></span></p>
                    <p><strong>Alamat:</strong> <span id="alamat"></span></p>
                    <p><strong>Provinsi:</strong> <span id="province"></span></p> <!-- New -->
                    <p><strong>Kota:</strong> <span id="city"></span></p>
                    <p><strong>Kode Pos:</strong> <span id="pos"></span></p>
                    <p><strong>No. Telepon:</strong> <span id="nohp"></span></p>
                    <p><strong>Kurir:</strong> <span id="courier"></span></p> <!-- New -->
                </div>
                
                <div id="order-summary">
                    <h3>Ringkasan Pesanan</h3>
                    <div class="order-item">
                        <div class="order-details">
                            <p><strong>Nama Barang:</strong> <span id="nama_produk"></span></p>
                            <p><strong>Harga:</strong> <span id="harga"></span> x <span id="qty"></span></p>
                            <p><strong>Total:</strong> <span id="total_pembayaran"></span></p>
                            <p><strong>Ongkir:</strong> <span id="cost"></span></p>
                        </div>
                    </div>
                    <div class="order-total">
                        <p><strong>Total Pembayaran:</strong> <span id="pembayaran"></span></p>
                    </div>
                </div>
                <button type="button" id="pay-button">Konfirmasi Checkout</button>
            </div>
        </div>
    </div>
</body>
</html>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Retrieve values from localStorage
    var nama = localStorage.getItem("nama");
    var alamat = localStorage.getItem("alamat");
    var city = localStorage.getItem("city");
    var pos = localStorage.getItem("pos");
    var nohp = localStorage.getItem("nohp");
    var nama_produk = localStorage.getItem("nama_produk");
    var modal_qty = localStorage.getItem("modal_qty");
    var modal_harga = localStorage.getItem("modal_harga");
    var modal_total = localStorage.getItem("modal_total");
    var cost = localStorage.getItem("cost");
    var province = localStorage.getItem("province");
    var courier = localStorage.getItem("courier");
    var courier_service = localStorage.getItem("courier_service");

    // Calculate total (modal_total + cost)
    var totalPayment = parseFloat(modal_total) + parseFloat(cost);

    // Save totalPayment to localStorage
    localStorage.setItem("totalPayment", totalPayment);

    // Display the values in HTML elements
    document.getElementById("name").innerText = nama;
    document.getElementById("alamat").innerText = alamat;
    document.getElementById("city").innerText = city;
    document.getElementById("pos").innerText = pos;
    document.getElementById("nohp").innerText = nohp;
    document.getElementById("nama_produk").innerText = nama_produk;
    document.getElementById("qty").innerText = modal_qty;
    document.getElementById("harga").innerText = modal_harga;
    document.getElementById("cost").innerText = cost;
    document.getElementById("total_pembayaran").innerText = modal_total;
    document.getElementById("pembayaran").innerText = totalPayment;

    // Display province and courier details
    document.getElementById("province").innerText = province;
    document.getElementById("courier").innerText = courier + ' - ' + courier_service;
});
</script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
document.getElementById('pay-button').onclick = function(){
    var nama = localStorage.getItem("nama");
    var alamat = localStorage.getItem("alamat");
    var city = localStorage.getItem("city");
    var pos = localStorage.getItem("pos");
    var nohp = localStorage.getItem("nohp");
    var nama_produk = localStorage.getItem("nama_produk");
    var modal_qty = localStorage.getItem("modal_qty");
    var modal_harga = localStorage.getItem("modal_harga");
    var modal_total = localStorage.getItem("modal_total");
    var cost = localStorage.getItem("cost");
    var totalPayment = localStorage.getItem("totalPayment"); // Use the updated totalPayment
    var kategori_id = localStorage.getItem("kategori_id");
    var kode_produk = localStorage.getItem("kode_produk");
    var province = localStorage.getItem("province");
    var courier = localStorage.getItem("courier");
    var courier_service = localStorage.getItem("courier_service");

    console.log(totalPayment);
    console.log(modal_total);
    console.log(cost);
    
    $.ajax({
        url: '/create-transaction', // Adjust your backend path
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            pembayaran: totalPayment, // Use totalPayment directly
            total_pembayaran: modal_total,
            kode_produk: kode_produk,
            nama_produk: nama_produk,
            qty: modal_qty,
            harga: modal_harga,
            name: nama,
            alamat: alamat,
            city: city,
            pos: pos,
            nohp: nohp,
            kategori_id: kategori_id,
            cost: cost,
            province: province,
            courier: courier,
            courier_service: courier_service
        },
        success: function(data) {
            snap.pay(data.snap_token); // Call Midtrans Snap
        }
    });
};
</script>
