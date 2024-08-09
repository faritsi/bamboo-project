<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/css/style-form-pembayaran.css">
    <link rel="stylesheet" href="/css/style-ds-modul.css">
    <link rel="stylesheet" href="/css/style-ds-home.css" />
    <link rel="stylesheet" href="/css/style-ds-admin.css" />
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-F4JHAj0KtmhPFNbO"></script>
    <title>Document</title>
</head>
<body>
    @foreach ($produk as $p)
        <img src="{{ asset('storage/' . $p->image) }}" class="preview-img">
        <h1>{{$p->nama_produk}}</h1>
        <h1>{{$p->deskripsi}}</h1>
        <h1>{{$p->jumlah_produk}}</h1>
        <h1>{{$p->jenis_produk}}</h1>
    @endforeach
    <h1 id="priceText">{{$p->harga}}</h1>
    
    <div class="form-pembayaran">
        <form action="" id="mainForm">
            <label>Nama Pembeli</label>
            <input type="text" name="name" id="name" value="">
            <label>Alamat</label>
            <input type="text" name="alamat" id="alamat" value="">
            <label>Kode POS</label>
            <input type="text" name="pos" id="pos" value="">
            <label>No hp</label>
            <input type="text" name="nohp" id="nohp" value="">
            <label>kode produk</label>
            <input type="text" name="kode_produk" id="kode_produk" value="{{$p->kode_produk}}">
            <label>nama produk</label>
            <input type="text" name="nama_produk" id="nama_produk" value="{{$p->nama_produk}}">
            <label>jenis produk</label>
            <input type="text" name="jenis_produk" id="jenis_produk" value="{{$p->jenis_produk}}">
            <label>qty</label>
            <input type="number" name="qty" id="qty" value="">
            <label>harga</label>
            <input type="number" name="harga" id="harga" value="{{$p->harga}}">
            <label>total pembayaran</label>
            <input type="number" name="total_pembayaran" id="total_pembayaran" value="">
            <div id="myBtn" class="bg-tambah-data">
                <div id="bo-tambah-data">
                    <div class="icon-tambah-data">
                        <span class="material-symbols-outlined">add</span>                                                        
                    </div>
                    <div id="text">
                        <strong>Produk</strong>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

<div id="myModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="" id="checkoutForm">
            @csrf
            <div id="head-modul">
                <h1>Tambah Produk</h1>
            </div>
            <div class="form-group">
                <label for="modal_name">Nama Pembeli <span class="required">*</span></label>
                <input type="text" id="modal_name" name="name" placeholder="EXP-021" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_alamat">Alamat <span class="required">*</span></label>
                <input type="text" id="modal_alamat" name="alamat" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_pos">Kode Pos <span class="required">*</span></label>
                <input type="text" id="modal_pos" name="pos" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_nohp">No. Hp <span class="required">*</span></label>
                <input type="text" id="modal_nohp" name="nohp" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_kode_produk">Kode Produk <span class="required">*</span></label>
                <input type="text" id="modal_kode_produk" name="kode_produk" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_nama_produk">Nama Produk <span class="required">*</span></label>
                <input type="text" id="modal_nama_produk" name="nama_produk" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_jenis_produk">Jenis Produk <span class="required">*</span></label>
                <input type="text" id="modal_jenis_produk" name="jenis_produk" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_qty">Unit <span class="required">*</span></label>
                <input type="text" id="modal_qty" name="qty" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_harga">Harga <span class="required">*</span></label>
                <input type="text" id="modal_harga" name="harga" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <label for="modal_total_pembayaran">Total Pembayaran <span class="required">*</span></label>
                <input type="text" id="modal_total_pembayaran" name="total_pembayaran" placeholder="Masukan Nama Produk" value="" readonly>
            </div>
            <div class="form-group">
                <button type="submit" class="checkout-button disabled">Pesan</button>
            </div>
        </form>
    </div>
</div>

<script src="/js/form-pembayaran.js" async></script>
<script>
    function calculateTotal() {
        var qty = document.getElementById("qty").value;
        var harga = document.getElementById("harga").value;

        var qtyInt = parseInt(qty, 10);
        var hargaInt = parseInt(harga, 10);

        if (isNaN(qtyInt) || isNaN(hargaInt)) {
            document.getElementById("total_pembayaran").value = "";
            return;
        }

        var total = qtyInt * hargaInt;
        document.getElementById("total_pembayaran").value = total;
    }

    document.getElementById("qty").addEventListener("input", function () {
        calculateTotal();
        checkForm();
    });

    function checkForm() {
    var isDisabled = false;
    $("#mainForm input").each(function() {
        if ($(this).val() === "") {
            isDisabled = true;
        }
    });
    if (isDisabled) {
        $(".checkout-button").addClass("disabled");
        $(".checkout-button").prop("disabled", true);
    } else {
        $(".checkout-button").removeClass("disabled");
        $(".checkout-button").prop("disabled", false);
    }
}


    function showModal(modalId) {
        $(modalId).show();
    }

    function hideModals() {
        $(".modal").hide();
    }

    $(document).ready(function() {
    // Panggil checkForm saat halaman dimuat
    checkForm();

    // Tambahkan event listener pada semua input di #mainForm
    $("#mainForm input").on("input", function() {
        checkForm();
    });

    // Tambahkan event listener pada #myBtn untuk memastikan checkForm dipanggil saat modal ditampilkan
    $("#myBtn").on("click", function () {
        document.getElementById("modal_name").value = document.getElementById("name").value;
        document.getElementById("modal_alamat").value = document.getElementById("alamat").value;
        document.getElementById("modal_pos").value = document.getElementById("pos").value;
        document.getElementById("modal_nohp").value = document.getElementById("nohp").value;
        document.getElementById("modal_kode_produk").value = document.getElementById("kode_produk").value;
        document.getElementById("modal_nama_produk").value = document.getElementById("nama_produk").value;
        document.getElementById("modal_jenis_produk").value = document.getElementById("jenis_produk").value;
        document.getElementById("modal_qty").value = document.getElementById("qty").value;
        document.getElementById("modal_harga").value = document.getElementById("harga").value;
        document.getElementById("modal_total_pembayaran").value = document.getElementById("total_pembayaran").value;

        showModal("#myModal");
        checkForm();
    });

    $(".close").on("click", function () {
        hideModals();
    });
});

</script>
</html>
