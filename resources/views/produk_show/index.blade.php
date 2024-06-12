
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/form-pembayaran.js" async></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/css/style-form-pembayaran.css">
    <script type="text/javascript"
		src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-F4JHAj0KtmhPFNbO"></script>
    <title>Document</title>
</head>
<body>
    @foreach ($barang as $p)
    
    <h1>{{$p->judul}}</h1>
    <h1>{{$p->deskripsi}}</h1>
    <h1>{{$p->pid}}</h1>
    @endforeach
    <label for="qtyInput">qty:</label>
    <input type="text" name="qtyInput" id="qtyInput">
    <h1 id="priceText">{{$p->harga}}</h1>
    
    <div class="form-pembayaran">
        <form action="" id="checkoutForm">
            <label>Nama</label>
            <input type="text" name="name" id="name">
            <label>Alamat</label>
            <!-- <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea> -->
            <input type="text" name="alamat" id="alamat">
            <label>Kode POS</label>
            <input type="text" name="pos" id="pos">
            <label>No hp</label>
            <input type="text" name="nohp" id="nohp">
            @foreach ($barang as $p)
                <input type="text" name="produk" id="produk" value="{{$p->judul}}">
            @endforeach
            <input type="text" name="qty" id="qty">
            <input type="text" name="harga" id="harga" value="{{$p->harga}}" >
            <input type="text" name="total" id="total" >
            <button type="submit" class="checkout-button disabled">Pesan</button>
        </form>
    </div>
</body>
<script>
    function calculateTotal() {
        // Mengambil nilai dari input qty dan harga
        var qty = document.getElementById("qty").value;
        var harga = document.getElementById("harga").value;

        // Mengkonversi nilai string menjadi integer
        var qtyInt = parseInt(qty, 10);
        var hargaInt = parseInt(harga, 10);

        // Mengecek apakah nilai-nilai tersebut valid
        if (isNaN(qtyInt) || isNaN(hargaInt)) {
            document.getElementById("total").value = "";
            return;
        }

        // Mengalikan nilai qty dan harga
        var total = qtyInt * hargaInt;

        // Menampilkan hasil di input total
        document.getElementById("total").value = total;
    }

    // Menambahkan event listener untuk memantau perubahan pada input qty dan harga
    document.getElementById("qty").addEventListener("input", calculateTotal);
    document.getElementById("harga").addEventListener("input", calculateTotal);

    // Panggil fungsi calculateTotal saat halaman dimuat untuk menginisialisasi total
    calculateTotal();
</script>
</html>