@extends('halaman.admin')
@section('content')
<div id="bo-content">
    <div id="content">
        <div id="wrapper-welcome">
            <h2>Selamat Datang !</h2>
            <h3>
                Ini Adalah Halaman Dashboard Untuk Mengubah Data
            </h3>
        </div>

        <!-- Isi Content -->

        <div id="bg-isi-content" class="clearfix">
            <div id="bo-isi-content">
                <div id="cc-content-admin">
                    <span class="material-symbols-outlined">
                        manage_accounts
                    </span>
                    <div id="cc-detail-admin">
                        <h3>Admin</h3>
                        <span>{{$totalAdmins}}</span>
                    </div>
                </div>

                <div id="cc-content-pimpinan">
                    <span class="material-symbols-outlined">
                        groups
                    </span>
                    <div id="cc-detail-pimpinan">
                        <h3>Pimpinan</h3>
                        <span>{{$totalPimpinan}}</span>
                    </div>
                </div>

                <div id="cc-content-produk">
                    <span class="material-symbols-outlined">
                        inventory_2
                    </span>
                    <div id="cc-detail-produk">
                        <h3>Produk</h3>
                        <span>{{$totalProduk}}</span>
                    </div>
                </div>

                <div id="cc-content-penjualan">
                    <span class="material-symbols-outlined">
                        shopping_bag
                    </span>
                    <div id="cc-detail-penjualan">
                        <h3>Barang Terjual</h3>
                        <span>{{$totalPenjualan}}</span>
                    </div>
                </div>

                <div id="cc-content-pengunjung">
                    <span class="material-symbols-outlined">
                        monitoring
                    </span>
                    <div id="cc-detail-pengunjung">
                        <h3>Pengunjung</h3>
                        <span>{{$totalPengunjung}}</span>
                    </div>
                </div>

                <div id="cc-content-pendapatan">
                    <span class="material-symbols-outlined">
                        payments
                    </span>
                    <div id="cc-detail-pendapatan">
                        <h3>Pendapatan</h3>
                        <span>Rp {{ number_format($totalPendapatanValue, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
