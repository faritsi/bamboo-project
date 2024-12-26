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
                    <a id="tipe-semua-produk" 
                    class="kategori {{ request('kategori') == 'semua' ? 'active' : '' }}" 
                    href="{{ route('catalog.index', ['kategori' => 'semua']) }}">
                        <h3>Semua</h3>
                    </a>

                    <a id="tipe-toples-produk" 
                    class="kategori {{ request('kategori') == 'Toples' ? 'active' : '' }}" 
                    href="{{ route('catalog.index', ['kategori' => 'Toples']) }}">
                        <h3>Toples</h3>
                    </a>

                    <a id="tipe-layangan-produk" 
                    class="kategori {{ request('kategori') == 'Mug' ? 'active' : '' }}" 
                    href="{{ route('catalog.index', ['kategori' => 'Mug']) }}">
                        <h3>Mug</h3>
                    </a>

                    <a id="tipe-tumbler-produk" 
                    class="kategori {{ request('kategori') == 'Tumbler' ? 'active' : '' }}" 
                    href="{{ route('catalog.index', ['kategori' => 'Tumbler']) }}">
                        <h3>Tumbler</h3>
                    </a>
                    <div id="myBtn" 
                        class="kategori {{ is_array(request()->query('kategori')) ? 'active' : '' }}">
                        <div class="container-filter-produk">
                            <div class="btn-filter-produk">
                                <h3>Pilih Kategori Lainnya <span id="counter">({{ $selectedCount }})</span></h3>
                            </div>
                        </div>
                    </div>

                    {{-- MODAL --}}
                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <form action="{{ route('catalog.index') }}" method="GET" enctype="multipart/form-data">
                                {{-- @csrf --}}
                                <div id="head-modul">
                                    <h1>Pilih Kategori</h1>
                                </div>
                                <div class="form-group">
                                    @foreach($kategori as $k)
                                        <div class="form-check">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                name="kategori[]" 
                                                id="kategori_{{ $k->id }}"
                                                value="{{ $k->name }}"
                                                {{ is_array(request()->query('kategori')) && in_array($k->name, request()->query('kategori')) ? 'checked' : '' }} >
                                            <label class="form-check-label" for="kategori_{{ $k->id }}">
                                                {{ $k->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <button type="submit" class="submit-btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Content Produk -->
                <div id="content-produk">
                    @foreach ($produk as $p)
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
                <!-- Pagination Links -->
                <div class="pagination-section">
                    <div class="pagination-links">
                        <a href="{{ $firstPageUrl }}" class="page-link" rel="prev">&#171;</a>
                        <a href="{{ $previousPageUrl }}" class="page-link" rel="prev">&#10094;</a>
    
                        @foreach ($produk->getUrlRange(1, $totalPages) as $page => $url)
                            <a href="{{ $url }}" class="page-link {{ $page == $currentPage ? 'active' : '' }}">{{ $page }}</a>
                        @endforeach
    
                        <a href="{{ $nextPageUrl }}" class="page-link" rel="next">&#10095;</a>
                        <a href="{{ $lastPageUrl }}" class="page-link" rel="next">&#187;</a>
                    </div>
                </div>
                
                <div class="pagination-info">
                </div>
            </div>
        </div>
        <div id="footer-copyright">
            <p>&copy; {{ date('Y') }} ITENAS</p>
        </div>
    </div>
    <script src="/js/burger.js"></script>

    <script>
        function showModal(modalId) {
            $(modalId).show();
        }

        function hideModals() {
            $(".modal").hide();
        }

        $("#myBtn").on("click", function () {
            showModal("#myModal");
        });

        $(".close").on("click", function () {
            hideModals();
        });

        $(window).on("click", function (event) {
            if ($(event.target).hasClass("modal")) {
                hideModals();
            }
        });


        document.addEventListener('DOMContentLoaded', function () {
            const formChecks = document.querySelectorAll('.form-check');

            formChecks.forEach(formCheck => {
                formCheck.addEventListener('click', function () {
                    const checkbox = this.querySelector('.form-check-input');

                    // Toggle checkbox state
                    checkbox.checked = !checkbox.checked;

                    // Add or remove the active class based on the checkbox state
                    if (checkbox.checked) {
                        this.classList.add('active');
                    } else {
                        this.classList.remove('active');
                    }
                });

                // Initialize state based on the checkbox value (for page reloads)
                const checkbox = formCheck.querySelector('.form-check-input');
                if (checkbox.checked) {
                    formCheck.classList.add('active');
                }
            });
        });

        
    </script>

</body>
</html>
