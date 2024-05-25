@extends('halaman.admin')
@section('content')
    <!-- Header -->
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
                <div id="container-info">
                    <div id="info-img">
                        <img src="https://via.placeholder.com/50x50" alt="icon-admin">
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
                
                <div id="container-info">
                    <div id="info-img">
                        <img src="https://via.placeholder.com/50x50" alt="icon-produk">
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
                <div id="container-info">
                    <div id="info-img">
                        <img src="https://via.placeholder.com/50x50" alt="icon-kegiatan">
                    </div>
                    <div id="info-text">
                        <div id="text-kegiatan">
                            <h3>Kegiatan</h3>
                        </div>
                        <div id="count-kegiatan">
                            <p>3</p>
                        </div>
                    </div>
                    
                </div>
                
                <div id="container-info">
                    <div id="info-img">
                        <img src="https://via.placeholder.com/50x50" alt="icon-pimpinan">
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
@endsection
