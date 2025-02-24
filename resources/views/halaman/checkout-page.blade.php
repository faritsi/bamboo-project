<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- LINK --}}
    <link rel="icon" href="img/logo/favicon/favicon.ico" type="image/x-icon">
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
                    <p><strong>Provinsi:</strong> <span id="province"></span></p>
                    <p><strong>Kota:</strong> <span id="city"></span></p>
                    <p><strong>Kode Pos:</strong> <span id="pos"></span></p>
                    <p><strong>No. Telepon:</strong> <span id="nohp"></span></p>
                    <p><strong>Kurir:</strong> <span id="courier"></span></p>
                    <p><strong>Harga Kurir: </strong><span id="cost"></span></p>

                </div>

                <div id="order-summary">
                    <h3>Ringkasan Pesanan</h3>
                    <div id="order-items"></div> <!-- Container for product list -->
                    <div class="order-total">
                        {{-- <p><strong>Ongkir:</strong> Rp <span id="cost"></span></p> <!-- Ongkir display --> --}}
                        <p><strong>Total Pembayaran: </strong><span id="pembayaran"></span></p>
                    </div>
                </div>
                {{-- Konfirm Checkout --}}
                <div id="pay-button" class="checkout-button">Konfirmasi Checkout</div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function() {
    function formatRupiah(amount) {
        return '' + new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount).replace('IDR', '').trim();
    }

    // Retrieve biodata from localStorage
    var nama = localStorage.getItem("nama");
    var alamat = localStorage.getItem("alamat");
    var city = localStorage.getItem("city");
    var pos = localStorage.getItem("pos");
    var nohp = localStorage.getItem("nohp");
    var province = localStorage.getItem("province");
    var courier = localStorage.getItem("courier");
    var courier_service = localStorage.getItem("courierService");
    // var kategori_id = localStorage.getItem("kategori_id");
    
    // console.log("TESTING AJA", kategori_id);

    // Retrieve cartItems array from localStorage (instead of products)
    var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
    // console.log(cartItems)

    // Retrieve shipping cost (ongkir) from localStorage
    var cost = parseFloat(localStorage.getItem("cost")) || 0;

    // Calculate total payment (sub-totals + shipping cost)
    var totalPayment = cartItems.reduce((sum, item) => sum + item.subTotal, 0) + cost;

    // Save totalPayment to localStorage
    localStorage.setItem("totalPayment", totalPayment);

    // Display the biodata
    document.getElementById("name").innerText = nama;
    document.getElementById("alamat").innerText = alamat;
    document.getElementById("city").innerText = city;
    document.getElementById("pos").innerText = pos;
    document.getElementById("nohp").innerText = nohp;
    document.getElementById("province").innerText = province;
    document.getElementById("courier").innerText = courier + ' - ' + courier_service;
    document.getElementById("cost").innerText = cost;

    // Display the cartItems in the order summary
    var orderItemsContainer = document.getElementById("order-items");
    cartItems.forEach(function(item) {
        var itemHtml = `
            <div class="order-item">
                <p><strong>Nama Produk:</strong> ${item.nama_produk}</p>
                <p hidden><strong>Kategori Produk:</strong> ${item.kategori_id}</p>
                <p><strong>Kode Produk:</strong> ${item.kode_produk}</p>
                <p><strong>Harga:</strong>  ${formatRupiah(item.harga)} x ${item.quantity}</p>
                <p><strong>Sub Total:</strong>  ${formatRupiah(item.subTotal)}</p>
            </div>
        `;
        orderItemsContainer.innerHTML += itemHtml;
    });

    
    

    // Display the shipping cost (ongkir) and total payment
    document.getElementById("cost").innerText = formatRupiah(cost); // Display ongkir
    document.getElementById("pembayaran").innerText = formatRupiah(totalPayment); // Display total payment
});

// AJAX setup for payment
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

document.getElementById('pay-button').onclick = function() {
    // Retrieve necessary values from localStorage
    var nama = localStorage.getItem("nama");
    var alamat = localStorage.getItem("alamat");
    var city = localStorage.getItem("city");
    var pos = localStorage.getItem("pos");
    var nohp = localStorage.getItem("nohp");
    var totalPayment = localStorage.getItem("totalPayment");
    var cost = localStorage.getItem("cost");
    var province = localStorage.getItem("province");
    var courier = localStorage.getItem("courier");
    var courier_service = localStorage.getItem("courierService");

    // var kode_produk = localStorage.getItem("kode_produk");
    // var kategori_id = localStorage.getItem("kategori_id");
    var nama_produk = localStorage.getItem("nama_produk");
    var qty = localStorage.getItem("modal_qty");
    var harga = localStorage.getItem("modal_harga");

    // Retrieve cartItems from localStorage
    // var cartItems = JSON.parse(localStorage.getItem("cartItems") || '[]');
    var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
    // Prepare the form data manually
    var formData = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        pembayaran: totalPayment,
        cost: cost,
        name: nama,
        alamat: alamat,
        city: city,
        pos: pos,
        nohp: nohp,
        province: province,
        courier: courier,
        courier_service: courier_service,
        // kode_produk: kode_produk,
        // kategori_id: kategori_id,
        nama_produk: nama_produk,
        qty: qty,
        harga: harga
    };

    // Add each cart item to the formData with indexed keys
    cartItems.forEach(function(item, index) {
        formData[`products[${index}][id]`] = item.pid;
        formData[`products[${index}][name]`] = item.nama_produk;
        formData[`products[${index}][quantity]`] = item.quantity;
        formData[`products[${index}][price]`] = item.harga;
        formData[`products[${index}][kategori_id]`] = item.kategori_id;
        formData[`products[${index}][kode_produk]`] = item.kode_produk;
    });

    // Send the AJAX request
    $.ajax({
        url: '/create-transaction', // Adjust your backend path
        method: 'POST',
        data: formData, // Send form-encoded data
        success: function(data) {
            snap.pay(data.snap_token); // Call Midtrans Snap for payment
            localStorage.clear()
        },
        error: function(xhr) {
            console.log(xhr.responseText); // Log error for debugging
        }
    });
};

</script>
