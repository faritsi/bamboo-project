<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan</title>
    <link rel="stylesheet" href="/css/style-ds-info-lainnya.css" />

</head>
<body>
<div id="bg-container">
        <div id="bo-container">
            <!-- SideBar -->
            <div id="container-sidebar">
                <!-- <img src="https://via.placeholder.com/50x50" alt="Image"> -->
                <!-- <h2>Dashboard</h2> -->
                <div id="container-sidebar-menu">
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
                    <div id="header-admin" class="clearfix">
                        <div id="left-admin">
                            <h3>Dashboard</h3>
                        </div>
                        <div id="right-admin" class="clearfix">
                            <div id="poto-admin">
                                <img src="https://via.placeholder.com/50x50" alt="Poto Admin">
                            </div>
                            <div id="nama-admin">
                                <h4>Nama Admin</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Isi Content -->
                    <div id="bg-header-content">
                        <div id="bo-header-content">
                            <div id="header-content" class="clearfix">
                                <div id="judul-content">
                                    <h3>INFO LAINNYA</h3>
                                </div>
                                <div id="tambah-content">
                                    <div id="container-icon-tambah">
                                        <div id="text-content">
                                            <h4>Simpan Data</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bg-info">
                                <div id="bo-info">
                                    <div id="container-info" class="clearfix">
                                        <!-- Bagian Atas -->
                                        <div id="info-info">
                                            <div id="footer-info">
                                                <h3>Footer</h3>
                                            </div>
                                            <div id="email">
                                                Email
                                            </div>
                                            <input type="text" class="email-input" placeholder="Enter your email">
                                            <div id="whatsapp">
                                                Nomor WhatsApp
                                            </div>
                                            <input type="number" class="whatsapp-input" placeholder="Enter WhatsApp number">
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