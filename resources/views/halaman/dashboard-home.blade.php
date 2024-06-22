<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard Admin</title>

        <!-- Link -->
        <link rel="stylesheet" href="/css/style-ds-home.css" />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        />
    </head>
    <body>
        <div id="container">
            <!-- Sidebar -->
            <div id="bg-sidebar">
                <div id="bo-sidebar">
                    <aside id="sidebar">
                        <div id="sidebar-header">
                            <img
                                src="https://via.placeholder.com/800x600"
                                alt="Logo"
                            />
                            <h2>Dashboard BMK</h2>
                        </div>
                        <ul id="sidebar-links">
                            <h4>
                                <span>Main Menu</span>
                                <div id="menu-seperate"></div>
                            </h4>

                            <li>
                                <a href="{{ route('home') }}">
                                    <span class="material-symbols-outlined">
                                        dashboard </span
                                    >Dashboard
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <span class="material-symbols-outlined">
                                        monitoring </span
                                    >Analytic
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <span class="material-symbols-outlined">
                                        attach_money </span
                                    >Pembelian
                                </a>
                            </li>

                            <h4>
                                <span>General</span>
                                <div id="menu-seperate"></div>
                            </h4>

                            <li>
                                <a href="{{ route('admin') }}">
                                    <span class="material-symbols-outlined">
                                        manage_accounts </span
                                    >Admin
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pimpinan') }}">
                                    <span class="material-symbols-outlined">
                                        groups </span
                                    >Pimpinan
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('produk') }}">
                                    <span class="material-symbols-outlined">
                                        inventory_2 </span
                                    >Produk
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('kegiatan') }}">
                                    <span class="material-symbols-outlined">
                                        image </span
                                    >Kegiatan
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('info-lainnya') }}">
                                    <span class="material-symbols-outlined">
                                        category </span
                                    >Footer
                                </a>
                            </li>
                        </ul>
                        <div id="logout">
                            <a href="#">
                                <span class="material-symbols-outlined">
                                    logout </span
                                >Logout
                            </a>
                        </div>
                    </aside>
                </div>
            </div>

            <!-- Header -->
            <div id="bg-header">
                <div id="bo-header">
                    <div id="header" class="clearfix">
                        <div id="judul-header">
                            <h2>Dashboard</h2>
                        </div>
                        <div id="user-account">
                            <div id="user-profile">
                                <img
                                    src="https://via.placeholder.com/800x600"
                                    alt="profile-img"
                                />
                                <div id="user-detail">
                                    <h3>Nama</h3>
                                    <span>Superadmin</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div id="bg-content">
                <div id="bo-content">
                    <div id="content">
                        <h2>Selamat Datang !</h2>
                        <h3>
                            Ini Adalah Halaman Dashboard Untuk Mengubah Data
                        </h3>

                        <!-- Isi Content -->

                        <div id="bg-isi-content" class="clearfix">
                            <div id="bo-isi-content">
                                <div id="cc-content-admin">
                                    <span class="material-symbols-outlined">
                                        manage_accounts
                                    </span>
                                    <div id="cc-detail-admin">
                                        <h3>Admin</h3>
                                        <span>2</span>
                                    </div>
                                </div>

                                <div id="cc-content-pimpinan">
                                    <span class="material-symbols-outlined">
                                        groups
                                    </span>
                                    <div id="cc-detail-pimpinan">
                                        <h3>Admin</h3>
                                        <span>2</span>
                                    </div>
                                </div>

                                <div id="cc-content-produk">
                                    <span class="material-symbols-outlined">
                                        inventory_2
                                    </span>
                                    <div id="cc-detail-produk">
                                        <h3>Admin</h3>
                                        <span>2</span>
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
