@extends('halaman.admin') <!-- Menggunakan layout admin.blade.php -->

@section('content')

<link rel="stylesheet" href="/css/style-integrasi.css" />

<div class="integrasi-container">
    <h2 class="page-title">Integrasi Pihak Ketiga</h2>
    <p class="page-subtitle">Klik tombol di bawah untuk mengakses layanan integrasi.</p>

    <!-- Card Container -->
    <div class="card-container">
        <!-- Midtrans -->
        <a href="https://dashboard.midtrans.com" target="_blank" class="card-integrasi">
            <span class="material-symbols-outlined">link</span>
            <h3>Midtrans</h3>
        </a>

        <!-- Fonnte -->
        <a href="https://fonnte.com" target="_blank" class="card-integrasi">
            <span class="material-symbols-outlined">link</span>
            <h3>Fonnte</h3>
        </a>

        <!-- Raja Ongkir -->
        <a href="https://rajaongkir.com" target="_blank" class="card-integrasi">
            <span class="material-symbols-outlined">link</span>
            <h3>Raja Ongkir</h3>
        </a>
    </div>
</div>
@endsection
