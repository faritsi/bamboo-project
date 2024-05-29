<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/style-ds-home.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <!-- Sidebar -->
    <div id="bg-container">
        <div id="bo-container">
            <div id="container-sidebar">
                <!-- <img src="https://via.placeholder.com/50x50" alt="Image"> -->
                <!-- <h2>Dashboard</h2> -->
                <div id="container-sidebar-menu">
                    <!-- <div id="logo-dashboard">
                        <i class="fa-solid fa-square-poll-vertical"></i>
                    </div> -->
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('admin') }}">Admin</a>
                        </li>
                        <li>
                            <a href="{{ route('produk') }}">Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('kegiatan') }}">Kegiatan</a>
                        </li>
                        <li>
                            <a href="{{ route('pimpinan') }}">Pimpinan Perusahaan</a>
                        </li>
                        <li>
                            <a href="{{ route('info-lainnya') }}">Info Lainnya</a>
                        </li>
                    </ul>
                </div>
                <div id="container-logout">
                    <ul>
                        <li>
                            <a href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Header Content -->
            <div id="bg-content">
                <div id="bo-content">
                    <!-- Header -->
                <div id="header-home" class="clearfix">
                        <div id="left-home">
                            <h3>Dashboard</h3>
                        </div>
                        <div id="right-home" class="clearfix">
                            <div id="poto-admin">
                                <img src="https://via.placeholder.com/50x50" alt="Poto Admin">
                            </div>
                            <div id="nama-admin">
                                <h4>Nama Admin</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Isi Content -->
                    <div id="isi-content">
                        
                        <div id="text-welcome">
                            <h2>Selamat Datang !</h2>
                        </div>
                        <div id="narasi-welcome">
                            <h4>Halaman Ini Merupakan Tempat Untuk Mengubah Data Yang Akan Ditampilkan Dalam Aplikasi Company Profile</h4>
                        </div>

                        <!-- info data -->
                        <div id="container-data">
                            <div id="cc-data">
                                <div id="info-data1" class="clearfix">
                                    <div id="container-info-admin">
                                        <div id="info-icon">
                                            <i class="fa-solid fa-user-gear" alt="icon-admin"></i>
                                        </div>
                                        <div id="info-text">
                                            <div id="text-admin">
                                                <h3>Admin</h3>
                                            </div>
                                            <div id="count-admin">
                                                <p>2</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="container-info-produk">
                                        <div id="info-icon">
                                            <i class="fa-solid fa-boxes-stacked" alt="icon-produk"></i>
                                        </div>
                                        <div id="info-text">
                                            <div id="text-produk">
                                                <h3>Produk</h3>
                                            </div>
                                            <div id="count-produk">
                                                <p>3</p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div id="info-data2" class="clearfix">
                                    <!-- <div id="container-info">
                                        <div id="info-icon">
                                            <i class="fa-solid fa-briefcase" alt="icon-kegiatan"></i>
                                        </div>
                                        <div id="info-text">
                                            <div id="text-kegiatan">
                                                <h3>Kegiatan</h3>
                                            </div>
                                            <div id="count-kegiatan">
                                                <p>3</p>
                                            </div>
                                        </div>
                                        
                                    </div> -->
                                    
                                    <div id="container-info-pimpinan">
                                        <div id="info-icon">
                                            <i class="fa-solid fa-user-tie" alt="icon-pimpinan"></i>
                                        </div>
                                        <div id="info-text">
                                            <div id="text-pimpinan">
                                                <h3>Pimpinan</h3>
                                            </div>
                                            <div id="count-pimpinan">
                                                <p>5</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>