<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- LINK --}}
    <link rel="stylesheet" href="{{ asset('css/style-all-produk.css') }}">
    {{-- <link rel="stylesheet" href="resources\js\script-all-produk.js"> --}}
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>{{$title}}</title>
</head>
<body>
    <div id="background">
        {{-- TIPE PRODUK --}}
        <div id="bg-container">
            <div id="container">
                <div id="tipe-produk" class="clearfix">
                    <div id="tipe-semua-produk" class="kategori" data-jenis_produk="semua">
                        <h3>Semua</h3>
                    </div>
                    <div id="tipe-toples-produk" class="kategori" data-jenis_produk="Awet">
                        <h3>Toples</h3>
                    </div>
                    <div id="tipe-layangan-produk" class="kategori" data-jenis_produk="Keripik">
                        <h3>Layangan</h3>
                    </div>
                    <div id="tipe-miniatur-produk" class="kategori" data-jenis_produk="miniatur">
                        <h3>Miniatur</h3>
                    </div>
                </div>
                
                {{-- Content Produk --}}
                @foreach ($produk as $p)
                <a href="/produk/{{$p->pid}}">
                    <div id="content-produk" class="content-produk" data-jenis_produk="{{$p->jenis_produk}}">
                        <div id="card-container">
                            <div id="card-produk">
                                <div id="card-stok">
                                    <p id="stok-produk">Stock : {{$p->jumlah_produk}}</p>
                                </div>
                                <div id="card-image">
                                    <img src="{{ asset('/storage/' . $p->image) }}" alt="Produk Image" id="image-produk">
                                </div>
                            </div>
                            <div id="card-text">
                                <h4 id="nama-produk">{{$p->nama_produk}}</h4>
                                <p id="harga-produk">{{$p->harga}}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

                {{-- Button Page --}}
                <div id="container-page-button">
                    <div id="page-button">
                        1 2 3 4 5 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

{{-- Modal Pengisian Biodata --}}
<div id="modal-biodata" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="header-modul">
                <p>Pengisian Biodata</p>
            </div>
            <div class="form-group">
                <label for="nama-lengkap">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="nama-lengkap" id="nama-lengkap" placeholder="Masukan Nama Lengkap">
            </div>
        </form>
    </div>
</div>

{{-- Script --}}
<script>
    $(document).ready(function(){
        function showModal(modalId) {
            $(modalId).show();
        }

        function hideModals() {
            $(".modal").hide();
        }

        $("#btnBeli").on("click", function() {
            showModal("#modal-biodata");
        });

        $('.close').on("click", function() {
            hideModals();
        });

        $(window).on("click", function(event) {
            if ($(event.target).hasClass("modal")) {
                hideModals();
            }
        });
    });
    $(document).ready(function(){
        // Fungsi untuk menampilkan produk berdasarkan jenis_produk
        function filterProduk(jenis_produk) {
            if (jenis_produk === "semua") {
                $(".content-produk").show(); // Tampilkan semua produk
            } else {
                $(".content-produk").hide(); // Sembunyikan semua produk
                $('.content-produk[data-jenis_produk="'+jenis_produk+'"]').show(); // Tampilkan produk berdasarkan jenis_produk
            }
        }

        // Event listener untuk klik pada kategori
        $(".kategori").on("click", function(){
            var jenis_produk = $(this).data("jenis_produk");
            filterProduk(jenis_produk);

            // Menambahkan kelas aktif pada kategori yang dipilih
            $(".kategori").removeClass("active");
            $(this).addClass("active");
        });

        // Inisialisasi: tampilkan semua produk pada load pertama
        filterProduk("semua");
    });
</script>
</html>