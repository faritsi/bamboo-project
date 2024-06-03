<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <script src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/tabelDetail.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    {{-- <link rel="stylesheet" href="/css/style-admin.css" /> --}}
    {{-- <link rel="stylesheet" href="/css/style-ds-admin.css" /> --}}
    <link rel="stylesheet" href="/css/style-ds-home.css" />
    <link rel="stylesheet" href="/css/style-ds-info-halaman.css" />
    {{-- <link rel="stylesheet" href="/css/style-ds-pimpinan.css" /> --}}
    <link rel="stylesheet" href="/css/style-ds-produk.css" />
    <link rel="stylesheet" href="/css/style-ds-kegiatan.css" />
    <link rel="stylesheet" href="/css/style-ds-admin.css" />
</head>
<body>
    <!-- Sidebar -->
    <div id="bg-container">
        <div id="bo-container">
            <div id="container-sidebar">
                <!-- <img src="https://via.placeholder.com/50x50" alt="Image"> -->
                <!-- <h2>Dashboard</h2> -->
                <div id="container-sidebar-menu">
                    <ul>
                        <li>
                            <a href="/home">Beranda</a>
                        </li>
                        @if ($user->role_id == 1)
                        <li>
                            <a href="/admin">Tambah Admin</a>
                        </li>
                        @endif
                        <li>
                            <a href="/produk">Produk</a>
                        </li>
                        <li>
                            <a href="/kegiatan">Kegiatan</a>
                        </li>
                        <li>
                            <a href="/pimpinan">Pimpinan Perusahaan</a>
                        </li>
                    </ul>
                </div>
                <div id="container-logout">
                    <ul>
                        <li>
                            <a href="/logout">Logout</a>
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
                                <h4>{{$user->name}}</h4>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                    {{-- @include("auth.login") --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
