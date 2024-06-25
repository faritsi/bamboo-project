<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <script src="" async></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/css/style-form-pembayaran.css">
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-F4JHAj0KtmhPFNbO"></script>
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
        <form action="" id="checkoutForm">
            <label>Nama Pembeli</label>
            <input type="text" name="name" id="name">
            <label>Alamat</label>
            <input type="text" name="alamat" id="alamat">
            <label>Kode POS</label>
            <input type="text" name="pos" id="pos">
            <label>No hp</label>
            <input type="text" name="nohp" id="nohp">
            <label>kode produk</label>
            <input type="text" name="kode_produk" id="kode_produk" value="{{$p->kode_produk}}">
            <label>nama produk</label>
            <input type="text" name="nama_produk" id="nama_produk" value="{{$p->nama_produk}}">
            <label>jenis produk</label>
            <input type="text" name="jenis_produk" id="jenis_produk" value="{{$p->jenis_produk}}">
            <label>qty</label>
            <input type="number" name="qty" id="qty">
            <label>harga</label>
            <input type="number" name="harga" id="harga" value="{{$p->harga}}">
            <label>total pembayaran</label>
            <input type="number" name="total_pembayaran" id="total_pembayaran">
            <button type="submit" class="checkout-button disabled">Pesan</button>
        </form>
    </div>
</body>
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
        document.getElementById("qty").value = this.value;
        calculateTotal();
    });

    calculateTotal();
</script>
</html>
