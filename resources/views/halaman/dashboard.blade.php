<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style-new-dashboard.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>
    <div id="background">
        <div id="co-background">
            {{-- NAVBAR --}}
            <div id="bg-navbar">
                <div id="background-img">
                    <img src="/img/bambu/bambu_11.jpeg" alt="Background Image">
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
                        <p id="text-selamat-datang">YOUR PROFITABLE BUSINESS PARTNER !</p>
                    </div>
                </div>    
            </div>

            {{-- Slogan --}}
            <div id="content-slogan">
                <div id="icon-slogan">
                    <img src="img/Launch.png" alt="Icon Slogan">
                </div>
                <div id="text-slogan">
                    <p>Berikan yang terbaik untuk alam, maka alam akan memberikan yang terbaik untuk kita.</p>
                </div>
                {{-- <div id="penjelasan-slogan">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In voluptates reprehenderit libero rerum corrupti a ducimus consequatur molestiae debitis est?</p>
                </div> --}}
            </div>

            {{-- About Us --}}
            <div id="content-about-us">
                <div id="container-about-us">
                    <div id="img-about-us">
                        <img src="img/bambu/bambu_8.jpeg" alt="About Us">
                    </div>
                    <div id="text-about-us">
                        {{-- <p id="about-us">About Us</p> --}}
                        <p id="judul-about-us">About Us</p>
                        <p id="about-us">PT. BINTANG MITRA KENCANA sebagai perusahaan yang bergerak dibidang Perdagangan Besar Berbagai macam barang yang saat ini fokus pada pengembangan potensi BAMBU khususnya produk-produk Even, perusahaan akan selalu melakukan pengukuran tingkat kepuasan pelanggan agar mengetahui apa yang sesungguhnya yang dibutuhkan oleh konsumen. Tingkat kepuasan pelanggan sangat bergantung pada mutu pada suatu produk.</p>
                    </div>
                </div>
            </div>

            {{-- Visi Misi  --}}
            <div id="content-visi-misi">
                <div id="container-visimisi">
                    <div id="container-visi">
                        <div id="icon-visi">
                            <img src="/img/logo/visi.png" alt="">
                        </div>
                        <div id="judul-visi">
                            <p>VISI</p>
                        </div>
                        <div id="text-visi">
                            <p>Menjadi pelopor global dalam inovasi dan pemanfaatan bambu berkelanjutan, dengan komitmen untuk melestarikan lingkungan, mendukung kesejahteraan masyarakat, serta menyediakan produk berkualitas tinggi yang ramah lingkungan</p>
                        </div>
                    </div>
                    <div id="container-misi">
                        <div id="icon-misi">
                            <img src="/img/logo/misi.png" alt="">
                        </div>
                        <div id="judul-misi">
                            <p>MISI</p>
                        </div>
                        <div id="text-misi">
                            <p>Pengelolaan Sumber Daya Alam yang Berkelanjutan, Mengembangkan praktik budi daya dan pemanenan bambu yang ramah lingkungan, berkelanjutan, dan memperhatikan keseimbangan ekosistem.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Our Service --}}
            <div id="content-our-service">
                <div id="container-our-service">
                    <div id="judul-our-service">
                        <p>Our Service</p>
                    </div>
                    <div id="our-service">
                        <p>Kami menyediakan solusi terbaik dengan fokus pada kualitas dan kepuasan pelanggan. Setiap layanan dirancang untuk memenuhi kebutuhan Anda secara efisien dan profesional.</p>
                    </div>
                    <div id="list-our-service">
                        <div id="service1">
                            <div id="icon-service1">
                                <span class="material-symbols-outlined">
                                    temp_preferences_eco
                                    </span>
                            </div>
                            <div id="judul-service1">
                                <p>Bahan Ramah Lingkungan</p>
                            </div>
                            <div id="text-service1">
                                <p>Bambu dapat terurai secara alami tanpa meninggalkan residu beracun, berbeda dengan plastik yang butuh ratusan tahun untuk terurai dan mencemari lingkungan.</p>
                            </div>
                        </div>
                        <div id="service2">
                            <div id="icon-service2">
                                <span class="material-symbols-outlined">
                                    weight
                                    </span>
                            </div>
                            <div id="judul-service2">
                                <p>Kekuatan dan Daya Tahan</p>
                            </div>
                            <div id="text-service2">
                                <p>Produk bambu, terutama yang telah diolah dengan baik, dapat tahan terhadap kelembaban, panas, dan serangan serangga seperti rayap.</p>
                            </div>
                        </div>
                        <div id="service3">
                            <div id="icon-service3">
                                <span class="material-symbols-outlined">
                                    bolt
                                    </span>
                            </div>
                            <div id="judul-service3">
                                <p>Ringan dan Fleksibel</p>
                            </div>
                            <div id="text-service3">
                                <p>Karena sifatnya yang lentur, bambu dapat digunakan untuk membuat desain yang lebih kompleks dan unik dibandingkan dengan bahan-bahan lainnya.</p>
                            </div>
                        </div>
                        <div id="service4">
                            <div id="icon-service4">
                                <span class="material-symbols-outlined">
                                    experiment
                                    </span>
                            </div>
                            <div id="judul-service4">
                                <p>Efisiensi Energi dalam Produksi</p>
                            </div>
                            <div id="text-service4">
                                <p>Produksi produk bambu biasanya memerlukan lebih sedikit energi dibandingkan dengan bahan seperti logam atau plastik.</p>
                            </div>
                        </div>
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
                        <p id="catalog-text">Temukan produk bambu berkualitas tinggi yang ramah lingkungan dan tahan lama. Setiap produk dibuat dengan penuh perhatian dan keahlian.</p>
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
                                <p id="harga-produk">{{$p->harga}}</p>
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
                    <div id="company-footer">
                        <div id="logo-company">
                            <img src="img\logo\logo.png" alt="Logo">
                        </div>
                        <div id="company-details">
                            <div id="company-name">PT. Bintang Mitra Kencana</div>
                            <div id="company-desc">Berlokasi di Jl. Warungawi-Cililin No. 259 RT. 04 RW. 06 Desa Bongas Kecamatan Cililin Kabupaten Bandung Barat, Jawa Barat Kode Pos 40562 dan Alamat Workshop di Kp. Cipongkor RT. 06/05 Desa Mekarsari Kecamatan Cipongkor Kabupaten Bandung Barat.</div>
                        </div>
                    </div>
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
</html>