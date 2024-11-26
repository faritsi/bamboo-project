<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- LINK -->
    <link rel="stylesheet" href="{{ asset('css/style-all-produk.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    @foreach ($ingpo as $i)    
    <link rel="icon" href="{{ asset('/storage/' . $i->favicon) }}" type="image/x-icon">
    @endforeach
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>

    <title>{{$title}}</title>
</head>
<body>
    <div id="background">
        <div id="bg-navbar">
            @foreach ($ingpo as $i)
            <div id="navbar">
                <div id="wrapper-navbar">
                    <a href="dashboard">
                        <div id="header-kiri">
                            <div id="logo-company">
                                <img src="{{ asset('/storage/' . $i->favicon) }}" alt="Logo">
                            </div>
                            <div id="header-teks">
                                <div id="header-atas">
                                    <p>PT. Bintang</p>
                                </div>
                                <div id="header-bawah">
                                    <p>Mitra Kencana</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div id="header-kanan" class="navbar-links">
                    <ul>
                        <li><a href="dashboard">Home</a></li>
                        {{-- <li>About Us</li> --}}
                        <li><a href="catalog">Catalog</a></li>
                        {{-- <li>Contact Us</li> --}}
                    </ul>
                    {{-- Burger Icon --}}
                    <div id="burger-menu">
                        <span id="burger-icon">&#9776;</span>
                    </div>
                    <div class="burger-menu-list" id="burgerMenuList">
                        <li><a href="dashboard">Home</a></li>
                        {{-- <li>About Us</li> --}}
                        <li><a href="catalog">Catalog</a></li>
                        {{-- <a href="#">Contact Us</a> --}}
                    </div>
                </div>
            </div>  
            @endforeach
        </div>

        <!-- TIPE PRODUK -->
        <div id="bg-container">
            <div id="container">
                <div id="title">Catalog Produk</div>
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
                    <div id="tipe-filter-produk" class="kategori" data-kategori_id="">
                        <h3>Pilih Kategori Lainnya</h3>
                    </div>
                </div>
                
                <!-- Content Produk -->
                <div id="content-produk">
                    @foreach ($produkItems as $p)
                    <div id="card-container" class="content-produk" data-kategori_id="{{$p->kategori_id}}">
                        <a href="{{ url('/produk/' . str_replace(' ', '-', $p->nama_produk)) }}">
                        
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
                            <p id="harga-produk">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Pagination Info -->
                <!-- Pagination Info Section -->
                

                <!-- Pagination Links -->
                <div class="pagination-links">
                    <a href="{{ $firstPageUrl }}" class="page-link" rel="prev">&#171;</a>
                    <a href="{{ $previousPageUrl }}" class="page-link" rel="prev">&#10094;</a>

                    @foreach ($produk->getUrlRange(1, $totalPages) as $page => $url)
                        <a href="{{ $url }}" class="page-link {{ $page == $currentPage ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach

                    <a href="{{ $nextPageUrl }}" class="page-link" rel="next">&#10095;</a>
                    <a href="{{ $lastPageUrl }}" class="page-link" rel="next">&#187;</a>
                </div>
                <div class="pagination-info">
                    <p>Page {{ $currentPage }} of {{ $totalPages }}</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        {{-- <div id="content-footer">
            <div id="container-footer">
                @foreach ($ingpo as $i)
                    
                <div id="company-footer">
                    <div id="logo-company">
                        <img src="{{ asset('/storage/' . $i->logo_footer) }}" alt="Logo">
                    </div>
                    <div id="company-details">
                        <div id="company-name">{{$i->judul_footer}}</div>
                        <div id="company-desc">{{$i->desc_footer}}</div>
                    </div>
                </div>
                    @endforeach
                <div id="footer-links">
                    <ul>
                        <li><a href="#navbar">Home</a></li>
                        <li><a href="catalog">Catalog</a></li>
                    </ul>
                </div>
                <div id="footer-social">
                    <a href="#"><img src="img\social-media\facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="img\social-media\wa.png" alt="Twitter"></a>
                    <a href="#"><img src="img\social-media\ig.png" alt="Instagram"></a>
                    <a href="#"><img src="img\social-media\linkedin.png" alt="LinkedIn"></a>
                </div>
            </div>
        </div> --}}

        <div id="footer-copyright">
            <p>&copy; {{ date('Y') }} ITENAS</p>
        </div>
    </div>
    <script src="/js/burger.js"></script>

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
