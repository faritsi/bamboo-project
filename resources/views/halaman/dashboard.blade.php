<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style-new-dashboard.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
@foreach ($ingpo as $i)    
<body>
    <div id="background">
        <div id="co-background">
            {{-- NAVBAR --}}
            <div id="bg-navbar">
                <div id="background-img">
                    <img src="{{ asset('/storage/' . $i->image_header) }}" alt="Background Image">
                </div>
                <div id="navbar">
                    <div id="header-kiri">
                        <div id="logo-company">
                            <img src="img/logo/logo.png" alt="Logo">
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
                    {{-- Burger Icon --}}
                    <div id="burger-menu">
                        <span>&#9776;</span> <!-- Icon Burger -->
                    </div>
                    <div id="header-kanan" class="navbar-links">
                        <ul>
                            <li>Home</li>
                            <li>About Us</li>
                            <li><a href="catalog">Catalog</a></li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                </div>

                <div id="overlay-welcome">
                    <div id="selamat-datang">
                        <p>Welcome To</p>
                        <p>PT. Bintang Mitra</p>
                        <p>Kencana</p>
                    </div>
                    <div id="text-selamat">
                        <p id="text-selamat-datang">{{$i->desc_header}}</p>
                    </div>
                </div>    
            </div>

            {{-- Slogan --}}
            <div id="content-slogan">
                <div id="icon-slogan">
                    <img src="img/Launch.png" alt="Icon Slogan">
                </div>
                <div id="text-slogan">
                    <p>{{$i->slogan}}</p>
                </div>
                <div id="penjelasan-slogan">
                    <p>{{$i->desc_slogan}}</p>
                </div>
            </div>

            {{-- About Us --}}
            <div id="content-about-us">
                <div id="container-about-us">
                    <div id="img-about-us">
                        <img src="{{ asset('/storage/' . $i->image_about) }}" alt="About Us">
                    </div>
                    <div id="text-about-us">
                        <p id="judul-about-us">{{ $i->judul_about }}</p>
                        <p id="about-us">{{ $i->desc_about }}</p>
                    </div>
                </div>
            </div>
            

            {{-- Visi Misi  --}}
            <div class="wrapper-visi-misi">
                <div class="boxes-visi-misi">
                    <div class="container-visi-misi">
                        <div class="con-visi-misi">
                            <div class="container-visi">
                                <h1>VISI</h1>
                                <p class="text-visi">Menjadi pelopor global dalam inovasi dan pemanfaatan bambu berkelanjutan, dengan komitmen untuk melestarikan lingkungan, mendukung kesejahteraan masyarakat, serta menyediakan produk berkualitas tinggi yang ramah lingkungan.</p>
                            </div>
                            <div class="container-misi">
                                <h1>MISI</h1>
                                <p class="text-misi">
                                    <ol>
                                        <li>
                                            Pengelolaan Sumber Daya Alam yang Berkelanjutan
                                        </li>
                                        <li>
                                            Inovasi Produk
                                        </li>
                                        <li>
                                            Pemberdayaan Komunitas Lokal
                                        </li>
                                        <li>
                                            Pengurangan Jejak Karbon
                                        </li>
                                        <li>
                                            Pendidikan dan Kesadaran Lingkungan
                                        </li>
                                    </ol>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="container-visi-misi-image">
                        <img src="img\bambu\bambu_10.jpeg" alt="">
                    </div>
                </div>
            </div>

            {{-- Our Service --}}
            <div id="content-our-service">
                <div id="container-our-service">
                    <div id="judul-our-service">
                        <p>{{$i->judul_service}}</p>
                    </div>
                    <div id="our-service">
                        <p>{{$i->desc_service}}</p>
                    </div>
                    <div id="list-our-service">
                        @foreach ($service as $s)
                        <div class="service-card">
                            <div class="icon-service">
                                <img src="{{ asset('/storage/' . $s->img) }}" alt="Service Icon">
                            </div>
                            <div class="judul-service">
                                <p>{{ $s->judul }}</p>
                            </div>
                            <div class="text-service">
                                <p>{{ $s->desc }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- CATALOG --}}
            <div id="content-catalog">
                <div id="container-catalog">
                    <div id="judul-catalog">
                        <p>PRODUK-PRODUK</p>
                        <p>TERBAIK KAMI</p>
                    </div>
                    <div id="text-catalog">
                        <p id="catalog-text">{{$i->desc_produk}}</p>
                        <a href="/catalog"><p id="all-produk">Lihat Semua Produk</p></a>
                    </div>
                </div>
                <div id="carousel-catalog">
                    <button class="carousel-control prev" onclick="prevSlide()">&#10094;</button>
                
                    <div id="container-catalog-carousel">
                        <div class="carousel-track">
                            @foreach ($produk as $p)                     
                            <div class="carousel-slide">
                                <div id="carousel-image">
                                    <img src="{{ asset('storage/' . $p->image) }}" alt="Product 1">
                                </div>
                                <p id="nama-produk">{{$p->nama_produk}}</p>
                                <p id="desc-produk">{{$p->deskripsi}}</p>
                                <p id="harga-produk">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                
                                <!-- Buttons Section -->
                                <div class="button-container">
                                    <!-- Tokopedia and Shopee buttons (same row) -->
                                    <div class="shop-buttons">
                                        <a href="{{$p->tokped}}" class="shop-button" target="_blank">Tokopedia</a>
                                        <a href="{{$p->shopee}}" class="shop-button" target="_blank">Shopee</a>
                                    </div>
                
                                    <!-- Beli Disini button (below the other two) -->
                                    <a href="/produk/{{$p->nama_produk}}"><button class="buy-button">Beli Disini</button></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="carousel-control next" onclick="nextSlide()">&#10095;</button>
                </div>
            </div>

            {{-- Activity --}}
            <div id="content-activity">
                <p id="text-activity">Our Activity</p>
                <div class="carousel-act">
                    <div class="carousel-track-act">
                        @foreach ($kegiatan as $k)                    
                        <div class="carousel-slide-act">
                            <img src="{{ asset('storage/' . $k->image_path) }}" alt="Kegiatan 1">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div id="content-video">
                <p id="text-video">Company Video</p>
                <div id="video-container">
                    @foreach ($video as $v)
                        <iframe
                        src="{{$v->video_path}}" 
                        title="Company Video"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen
                    ></iframe>
                    @endforeach
                </div>
            </div>

            {{-- Pimpinan --}}
            <div id="content-so">
                <div id="container-so">
                    <p id="text-so">Pimpinan Perusahaan</p>
                    <div id="profile-so">
                        @foreach ($pimpinan as $pm)                            
                        <div class="profile-card">
                            <div id="foto-pimpinan">
                                <img src="{{ asset('storage/' . $pm->image) }}" alt="Image 1">
                            </div>
                            <p class="nama-pimpinan">{{$pm->name}}</p>
                            <p class="jabatan-pimpinan">{{$pm->jabatan}}</p>
                            <p class="desc-pimpinan">{{$pm->deskripsi}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div id="content-footer">
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
                            <li><a href="#about">About Us</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#products">Products</a></li>
                            <li><a href="#contact">Contact Us</a></li>
                        </ul>
                    </div>
                    <div id="footer-social">
                        <a href="#"><img src="img\social-media\facebook.png" alt="Facebook"></a>
                        <a href="#"><img src="img\social-media\wa.png" alt="Twitter"></a>
                        <a href="#"><img src="img\social-media\ig.png" alt="Instagram"></a>
                        <a href="#"><img src="img\social-media\linkedin.png" alt="LinkedIn"></a>
                    </div>
                    <div style="position: fixed; bottom: 20px; right: 20px; background-color: rgba(0, 0, 0, 0.7); color: white; padding: 15px; border-radius: 8px; z-index: 999;">
                        <!-- Icon : Today's Visitor Count -->
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined mr-2">run_circle</span>
                            <span class="mr-1">:</span>
                            <p class="mb-0">{{ $visitorCounts['today'] }}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-symbols-outlined mr-2">groups_3</span>
                            <span class="mr-1">:</span>
                            <p class="mb-0">{{ $visitorCounts['totalVisits'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script src="/js/carousel-produk.js"></script>
    <script src="/js/carousel-activity.js"></script>
    <script src="/js/animasi-dashboard.js"></script>
    <script src="/js/burger.js"></script>
</body>
@endforeach

</html>