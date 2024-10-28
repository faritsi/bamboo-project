<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard Admin</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <!-- Link -->
        <link rel="stylesheet" href="/css/style-ds-modul.css">
        <link rel="stylesheet" href="/css/style-ds-home.css" />
        <link rel="stylesheet" href="/css/style-ds-admin.css" />
        <link rel="stylesheet" href="/css/style-tabel-admin.css" />
        <link rel="stylesheet" href="/css/style-ds-produk.css" />
        <link rel="stylesheet" href="/css/style-tabel-produk.css" />
        <link rel="stylesheet" href="/css/style-ds-pimpinan.css" />
        <link rel="stylesheet" href="/css/style-tabel-pimpinan.css" />
        <link rel="stylesheet" href="/css/style-ds-kegiatan.css" />
        <link rel="stylesheet" href="/css/style-ingpo.css" />

        {{-- JS --}}
        <script src="/js/script-modal.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        {{-- <link rel="stylesheet" href="/css/style-ds-info-lainnya.css" /> --}}
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        {{-- <script src="/js/form-pembayaran.js"></script> --}}
    </head>
    <body>
        <div id="container">
            <!-- Sidebar -->
            <!-- Sidebar -->
            <div id="bg-sidebar">
                <div id="bo-sidebar">
                    <aside id="sidebar">
                        <div id="sidebar-header">
                            <img src="https://via.placeholder.com/800x600" alt="Logo" />
                            <h2>Dashboard</h2>
                        </div>
                        <ul id="sidebar-links">
                            <h4>
                                <span>Main Menu</span>
                                <div id="menu-seperate"></div>
                            </h4>
                            <li><a href="/home"><span class="material-symbols-outlined">dashboard</span> Dashboard</a></li>
                            <li><a href="/visitor"><span class="material-symbols-outlined">monitoring</span> Analytic</a></li>
                            <li><a href="/pembelian"><span class="material-symbols-outlined">attach_money</span> Pembelian</a></li>
                            <h4>
                                <span>General</span>
                                <div id="menu-seperate"></div>
                            </h4>
                            <li><a href="/admin"><span class="material-symbols-outlined">manage_accounts</span> Admin</a></li>
                            <li><a href="/pimpinan"><span class="material-symbols-outlined">groups</span> Pimpinan</a></li>
                            <li><a href="/produk"><span class="material-symbols-outlined">inventory_2</span> Produk</a></li>
                            <li><a href="/services"><span class="material-symbols-outlined">
                                linked_services
                                </span> Service</a></li>
                            <li><a href="/kegiatan"><span class="material-symbols-outlined">image</span> Kegiatan</a></li>
                            <li><a href="/info"><span class="material-symbols-outlined">category</span> Lainnya</a></li>
                        </ul>
                        <div id="logout">
                            <a href="/logout"><span class="material-symbols-outlined">logout</span> Logout</a>
                        </div>
                    </aside>
                </div>
            </div>
            <div id="bg-header">
                <div id="bo-header">
                    <div id="header" class="clearfix">
                        <div id="judul-header">
                            <h2>Dashboard</h2>
                        </div>
                        <div id="user-account">
                            <div id="user-profile">
                                <img src="{{ asset('storage/' . $user->image) }}" alt="profile-img" />
                                <div id="user-detail">
                                    <h3>{{$user->name}}</h3>
                                    <span>{{$user->role->name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Content -->
            <main>
                <div id="bg-content">
                    @yield('content')
                </div>
            </main>
    
            <!-- Content -->
            
        </div>
    </body>
</html>
