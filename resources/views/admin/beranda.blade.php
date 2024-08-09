@extends('halaman.admin')
@section('content')
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
@endsection
