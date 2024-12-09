<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach ($ingpo as $i)    
    <link rel="icon" href="{{ asset('/storage/' . $i->favicon) }}" type="image/x-icon">
    @endforeach
    <link rel="stylesheet" href="{{ asset('css/style-new-dashboard.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    {{-- <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}"> --}}
    <script type="text/javascript" src="/js/jquery.js"></script>
    {{-- <script type="text/javascript" src="/js/lightslider.js"></script> --}}
    @foreach($ingpo as $i)
    <title>{{$i->title}}</title>
    @endforeach
</head>
@foreach ($ingpo as $i)    
<body>
    <div id="background">
        <div id="co-background">
            {{-- NAVBAR --}}
            <div id="bg-navbar">
                <div class="wrapper-bg">
                    <div id="background-img">
                        <img src="{{ asset('/storage/' . $i->image_header) }}" alt="Background Image">
                    </div>
                </div>
                <div id="navbar">
                    <div id="wrapper-header">
                            <div id="header-kiri">
                                <a href="dashboard">
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
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div id="header-kanan" class="navbar-links">
                        <ul>
                            {{-- <li><a href="dashboard">Home</a></li> --}}
                            <li><a href="#content-about-us">About Us</a></li>
                            <li><a href="#content-our-service">Our Service</a></li>
                            <li><a href="catalog">Catalog</a></li>
                            <li><a href="#content-footer">Contact Us</a></li>
                        </ul>
                        {{-- Burger Icon --}}
                        <div id="burger-menu">
                            <span id="burger-icon">&#9776;</span>
                        </div>
                        <div class="burger-menu-list" id="burgerMenuList">
                            <a href="#content-about-us">About Us</a>
                            <a href="#content-our-service">Our Service</a>
                            <a href="catalog">Catalog</a></li>
                            <a href="#content-footer">Contact Us</a>
                        </div>
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
                                <p class="text-visi">{{$i->desc_visi}}</p>
                            </div>
                            <div class="container-misi">
                                <h1>MISI</h1>
                                <ul class="text-misi">
                                    @foreach (explode("\n", $i->desc_misi) as $misi)
                                        <li>{{ $misi }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="container-visi-misi-image">
                        <img src="{{asset('/storage/' . $i->image_visi_misi)}}" alt="Photo Visi Misi">
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
                        <ul id="autoWidth" class="carousel-track cS-hidden">
                            @foreach ($produk as $p)
                            <li class="carousel-slide">
                                <div class="box">
                                    <!-- Image and overlay -->
                                    <div class="slide-img">
                                        <img src="{{ asset('storage/' . $p->image) }}" alt="Product Image">
                                        <div class="overlay">
                                            <a href="https://www.tokopedia.com/your-store-link" class="shop-button" target="_blank">Tokopedia</a>
                                            <a href="https://shopee.co.id/your-store-link" class="shop-button" target="_blank">Shopee</a>
                                        </div>
                                    </div>
                
                                    <!-- Product details -->
                                    <div class="detail-box">
                                        <div class="type">
                                            <a href="#">{{ $p->nama_produk }}</a>
                                            {{-- <span>{{ $p->deskripsi }}</span> --}}
                                        <p class="price">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>

                                        </div>
                                    </div>
                
                                    <!-- Shop buttons -->
                                    <div class="button-container">
                                        <div class="shop-buttons">
                                            <a href="#" class="buy-btn">Beli Disini</a>
                                        </div>

                                        <div class="slide-img-outter">
                                            <div class="overlay-outter">
                                                <a href="https://www.tokopedia.com/your-store-link" class="shop-button" >Tokopedia</a>
                                                <a href="https://shopee.co.id/your-store-link" class="shop-button" >Shopee</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
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

            {{-- Video Compnay --}}
            <div id="content-video">
                <p id="text-video">Company Video</p>
                <div id="video-container">
                    @foreach ($video as $v)
                         @if ($v->video_link)
                        <!-- For video URL (e.g., YouTube, Vimeo) -->
                        <iframe
                            src="{{$v->video_link}}" 
                            title="Company Video"
                            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen
                        ></iframe>
                        @elseif ($v->video_path)
                            <!-- For video file (e.g., MP4, MOV) -->
                            <iframe 
                                src="{{ asset('storage/' . $v->video_path) }}" 
                                title="Company Video"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                            ></iframe>
                        @endif
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
                            <img src="{{ asset('/storage/' . $i->favicon) }}" alt="Logo">
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
                        {{-- <a href="#"><img src="img\social-media\facebook.png" alt="Facebook"></a> --}}
                        <a href="https://wa.me/{{ $i->nowa }}?text=Halo, saya ingin bertanya" target="blank"><img src="img\social-media\wa.png" alt="WhatsApp"></a>
                        <a href="{{$i->instagram}}"><img src="img\social-media\ig.png" alt="Instagram"></a>
                        {{-- <a href="#"><img src="img\social-media\linkedin.png" alt="LinkedIn"></a> --}}
                    </div>
                </div>
            </div>
            {{-- Visitor --}}
            <div style="position: fixed; bottom: 50%; right: -5px; background-color: #28a745; color: white; padding: 15px; border-radius: 20px 0 0 20px; z-index: 999;">
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
            
            <div id="footer-copyright">
                <p>&copy; {{ date('Y') }} ITENAS</p>
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