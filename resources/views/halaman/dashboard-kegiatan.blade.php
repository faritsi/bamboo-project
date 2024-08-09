<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan</title>
    <link rel="stylesheet" href="/css/style-ds-kegiatan.css" />

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
                                    <h3>KEGIATAN</h3>
                                </div>
                                <div id="tambah-content">
                                    <div id="container-icon-tambah">
                                        <div id="text-content">
                                            <h4>Simpan Data</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div id="bg-grid-photo">
                                <div id="bo-grid-photo">
                                    
                                    <div id="grid-photo" class="clearfix">
                                        <div id="grid1"></div>
                                        <div id="grid2"></div>
                                    </div>

                                    
                                    <div id="grid-photo" class="clearfix">
                                        <div id="grid3"></div>
                                        <div id="grid4"></div>
                                        <div id="grid5"></div>
                                    </div>

                                    
                                    <div id="grid-photo" class="clearfix">
                                        <div id="grid6"></div>
                                        <div id="grid7"></div>
                                        <div id="grid8"></div>
                                        <div id="grid9"></div>
                                    </div>
                                </div>
                            </div> -->

                            <div id="bg-kegiatan">
                                <div id="bo-kegiatan">
                                    <div id="container-kegiatan" class="clearfix">
                                        <!-- Bagian Atas -->
                                        <div id="info-kegiatan">
                                            <div id="letak-foto">
                                                <h3>Foto Bagian Atas</h3>
                                            </div>
                                            <div id="foto">
                                                Foto 1
                                            </div>
                                            <input type="file" class="upload-button">
                                            <div id="foto">
                                                Foto 2
                                            </div>
                                            <input type="file" class="upload-button">
                                        </div>

                                        <!-- Bagian Tengah -->
                                        <div id="info-kegiatan">
                                            <div id="letak-foto">
                                                <h3>Foto Bagian Tengah</h3>
                                            </div>
                                            <div id="foto">
                                                Foto 3
                                            </div>
                                            <input type="file" class="upload-button">
                                            <div id="foto">
                                                Foto 4
                                            </div>
                                            <input type="file" class="upload-button">
                                            <div id="foto">
                                                Foto 5
                                            </div>
                                            <input type="file" class="upload-button">
                                        </div>

                                        <!-- Bagian Bawah -->
                                        <div id="info-kegiatan">
                                            <div id="letak-foto">
                                                <h3>Foto Bagian Bawah</h3>
                                            </div>
                                            <div id="foto">
                                                Foto 6
                                            </div>
                                            <input type="file" class="upload-button">
                                            <div id="foto">
                                                Foto 7
                                            </div>
                                            <input type="file" class="upload-button">
                                            <div id="foto">
                                                Foto 8
                                            </div>
                                            <input type="file" class="upload-button">
                                            <div id="foto">
                                                Foto 9
                                            </div>
                                            <input type="file" class="upload-button">
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