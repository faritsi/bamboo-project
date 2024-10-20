<!DOCTYPE html>
<html lang="en" x-data="cartData()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- LINK -->
    <link rel="stylesheet" href="{{ asset('css/style-all-produk.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>

    <title>{{$title}}</title>
</head>
<body>
    <div id="background">
        <!-- TIPE PRODUK -->
        <div id="bg-container">
            <div id="container">
                <div id="tipe-produk" class="clearfix">
                    <div id="tipe-semua-produk" class="kategori" data-kategori_id="semua">
                        <h3>Semua</h3>
                    </div>
                    <div id="tipe-toples-produk" class="kategori" data-kategori_id="Awet">
                        <h3>Toples</h3>
                    </div>
                    <div id="tipe-layangan-produk" class="kategori" data-kategori_id="Keripik">
                        <h3>Layangan</h3>
                    </div>
                    <div id="tipe-miniatur-produk" class="kategori" data-kategori_id="miniatur">
                        <h3>Miniatur</h3>
                    </div>
                </div>
                
                <!-- Content Produk -->
                <div id="content-produk">
                    @foreach ($produk as $p)
                    <div id="card-container" class="content-produk" data-kategori_id="{{$p->kategori_id}}">
                        <a href="/produk/{{$p->nama_produk}}">
                            <div id="card-produk">
                                <div id="card-stok">
                                    <p id="stok-produk">Stock : {{$p->jumlah_produk}}</p>
                                </div>
                                <div id="card-image">
                                    <img src="{{ asset('/storage/' . $p->image) }}" alt="Produk Image" id="image-produk">
                                </div>
                            </div>
                        </a>
                        <div id="card-text">
                            <h4 id="nama-produk">{{$p->nama_produk}}</h4>
                            <p id="harga-produk">{{$p->harga}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function(){
        // localStorage.clear();
        // Fungsi untuk menampilkan produk berdasarkan kategori_id
        function filterProduk(kategori_id) {
            if (kategori_id === "semua") {
                $(".content-produk").show(); // Tampilkan semua produk
            } else {
                $(".content-produk").hide(); // Sembunyikan semua produk
                $('.content-produk[data-kategori_id="'+kategori_id+'"]').show(); // Tampilkan produk berdasarkan kategori_id
            }
        }

        // Event listener untuk klik pada kategori
        $(".kategori").on("click", function(){
            var kategori_id = $(this).data("kategori_id");
            filterProduk(kategori_id);

            // Menambahkan kelas aktif pada kategori yang dipilih
            $(".kategori").removeClass("active");
            $(this).addClass("active");
        });

        // Inisialisasi: tampilkan semua produk pada load pertama
        filterProduk("semua");
    });
</script>
</html>
