<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style-new-dashboard.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Dashboard</title>
</head>
@foreach ($ingpo as $i)

    <body>
        <div id="background">
            <div id="co-background">
                <div id="bg-navbar">
                    {{-- Background --}}
                    <div id="background-img">
                        <img src="{{ asset('/storage/' . $i->image_header) }}" alt="Background Image">
                    </div>

                    {{-- Header --}}
                    <header>
                        <div class="container">
                            <div class="header-content">
                                <div class="logo">
                                    <a href="#home">
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
                                    </a>
                                </div>
                                <div class="hamburger">
                                    <div class="line"></div>
                                    <div class="line"></div>
                                    <div class="line"></div>
                                </div>
                                <nav class="nav-bar">
                                    <ul>
                                        <li><a href="#home" class="active">Home</a></li>
                                        <li><a href="#about-us">About Us</a></li>
                                        <li><a href="catalog">Catalog</a></li>
                                        <li><a href="#contact-us">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </header>

                    {{-- Home --}}
                    <section class="home">
                        <div class="container">
                            <div id="overlay-welcome">
                                <div id="selamat-datang">
                                    <p>Welcome To</p>
                                    <p>PT. Bintang Mitra</p>
                                    <p>Kencana</p>
                                </div>
                                <div id="text-selamat">
                                    <p id="text-selamat-datang">{{ $i->desc_header }}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                {{-- Slogan --}}
                <div id="content-slogan">
                    <div id="icon-slogan">
                        <img src="img/Launch.png" alt="Icon Slogan">
                    </div>
                    <div id="text-slogan">
                        <p>{{ $i->slogan }}</p>
                    </div>
                    <div id="penjelasan-slogan">
                        <p>{{ $i->desc_slogan }}</p>
                    </div>
                </div>

                {{-- About Us --}}
                <div id="content-about-us">
                    <div id="container-about-us">
                        <div id="img-about-us">
                            <img src="{{ asset('/storage/' . $i->image_about) }}" alt="About Us">
                        </div>
                        <div id="text-about-us">
                            {{-- <p id="about-us">About Us</p> --}}
                            <p id="judul-about-us">{{ $i->judul_about }}</p>
                            <p id="about-us">{{ $i->desc_about }}</p>
                        </div>
                    </div>
                </div>

                {{-- Visi Misi  --}}
                <div id="content-visi-misi">
                    <div id="container-visimisi">
                        <div id="container-visi">
                            <div id="icon-visi">
                                <img src="{{ asset('/storage/' . $i->image_visi) }}" alt="">
                            </div>
                            <div id="judul-visi">
                                <p>VISI</p>
                            </div>
                            <div id="text-visi">
                                <p>{{ $i->desc_visi }}</p>
                            </div>
                        </div>
                        <div id="container-misi">
                            <div id="icon-misi">
                                <img src="{{ asset('/storage/' . $i->image_misi) }}" alt="">
                            </div>
                            <div id="judul-misi">
                                <p>MISI</p>
                            </div>
                            <div id="text-misi">
                                <p>{{ $i->desc_misi }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Our Service --}}
                <div id="content-our-service">
                    <div id="container-our-service">
                        <div id="judul-our-service">
                            <p>{{ $i->judul_service }}</p>
                        </div>
                        <div id="our-service">
                            <p>{{ $i->desc_service }}</p>
                        </div>
                        <div id="list-our-service">
                            @foreach ($service as $s)
                                <div id="service1">
                                    <div id="icon-service1">
                                        <img src="{{ asset('/storage/' . $s->img) }}" alt="Cup">
                                    </div>
                                    <div id="judul-service1">
                                        <p>{{ $s->judul }}</p>
                                    </div>
                                    <div id="text-service1">
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
                            <p id="catalog-text">{{ $i->desc_produk }}</p>
                            <a href="/catalog">
                                <p id="all-produk">Lihat Semua Produk</p>
                            </a>
                        </div>
                    </div>
                    <div id="carousel-catalog">
                        <div class="container">
                            {{-- <button class="carousel-control prev" onclick="prevSlide()">&#10094;</button> --}}
                            <div class="swiper mySwiper" id="container-catalog-carousel">
                                <div class="carousel-track swiper-wrapper">
                                    @foreach ($produk as $p)
                                        <div class="carousel-slide swiper-slide">
                                            <div id="carousel-image">
                                                <img src="{{ asset('storage/' . $p->image) }}" alt="Product 1">
                                            </div>
                                            <p id="nama-produk">{{ $p->nama_produk }}</p>
                                            <p id="desc-produk">{{ $p->deskripsi }}</p>
                                            <p id="harga-produk">{{ $p->harga }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- <button class="carousel-control next" onclick="nextSlide()">&#10095;</button> --}}
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
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
                                    <p class="nama-pimpinan">{{ $pm->name }}</p>
                                    <p class="jabatan-pimpinan">{{ $pm->jabatan }}</p>
                                    <p class="desc-pimpinan">{{ $pm->deskripsi }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div id="content-footer">
                    <div id="container-footer">
                        <div class="footer-list">
                            @foreach ($ingpo as $i)
                                <div id="company-footer">
                                    <div id="logo-company">
                                        <img src="{{ asset('/storage/' . $i->logo_footer) }}" alt="Logo">
                                    </div>
                                    <div id="company-details">
                                        <div id="company-name">{{ $i->judul_footer }}</div>
                                        <div id="company-desc">{{ $i->desc_footer }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="footer-list">
                            <div id="footer-links">
                                <ul>
                                    <li><a href="#navbar">Home</a></li>
                                    <li><a href="#about">About Us</a></li>
                                    <li><a href="#services">Services</a></li>
                                    <li><a href="#products">Products</a></li>
                                    <li><a href="#contact">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-list">
                            <div id="footer-social">
                                <a href="#"><img src="img\social-media\facebook.png" alt="Facebook"></a>
                                <a href="#"><img src="img\social-media\wa.png" alt="Twitter"></a>
                                <a href="#"><img src="img\social-media\ig.png" alt="Instagram"></a>
                                <a href="#"><img src="img\social-media\linkedin.png" alt="LinkedIn"></a>
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
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 2,
                loop: true,
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                    type: "bullets"
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1440: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        </script>

        {{-- Hamburger --}}
        <script>
            hamburger = document.querySelector(".hamburger");
            hamburger.onclick = function() {
                navBar = document.querySelector(".nav-bar");
                navBar.classList.toggle("active");
            }
        </script>
    </body>
@endforeach

</html>
