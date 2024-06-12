@extends('halaman.admin')
@section('content')
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
@endsection
