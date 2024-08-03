<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- LINK --}}
    <link rel="stylesheet" href="{{ asset('css/style-all-produk.css') }}">
    <link rel="stylesheet" href="resources\js\script-all-produk.js">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Document</title>
</head>
<body>
    <div id="background">
        {{-- TIPE PRODUK --}}
        <div id="bg-container">
            <div id="container">
                <div id="tipe-produk" class="clearfix">
                    <div id="tipe-semua-produk">
                        <h3>Semua</h3>
                    </div>
                    <div id="tipe-toples-produk">
                        <h3>Toples</h3>
                    </div>
                    <div id="tipe-layangan-produk">
                        <h3>Layangan</h3>
                    </div>
                    <div id="tipe-miniatur-produk">
                        <h3>Miniatur</h3>
                    </div>
                </div>
                {{-- Content Produk --}}
                <div id="content-produk">
                    <div id="card-container">
                        <div id="card-produk">
                            <div id="card-stok">
                                <p id="stok-produk">Stock : 18</p>
                            </div>
                            <div id="card-image">
                                <img src="img/pd.png" alt="Produk Image" id="image-produk">
                            </div>
                        </div>
                            <div id="card-text">
                            <h4 id="nama-produk">Tatakan Bambu Kuning Hitam Putih</h3>
                            <p id="harga-produk">Rp. 99.99</p>
                        </div>
                    </div>

                    <div id="card-container">
                        <div id="card-produk">
                            <div id="card-stok">
                                <p id="stok-produk">Stock :18</p>
                            </div>
                            <div id="card-image">
                                <img src="" alt="Produk Image" id="image-produk">
                            </div>
                        </div>
                            <div id="card-text">
                            <h4 id="nama-produk">Tatakan Bambu Kuning Hitam Putih</h3>
                            <p id="harga-produk">Rp. 99.99</p>
                        </div>
                    </div>
                    
                    <div id="card-container">
                        <div id="card-produk">
                            <div id="card-stok">
                                <p id="stok-produk">Stock :18</p>
                            </div>
                            <div id="card-image">
                                <img src="" alt="Produk Image" id="image-produk">
                            </div>
                        </div>
                            <div id="card-text">
                            <h4 id="nama-produk">Tatakan Bambu Kuning Hitam Putih</h3>
                            <p id="harga-produk">Rp. 99.99</p>
                        </div>
                    </div>

                    <div id="card-container">
                        <div id="card-produk">
                            <div id="card-stok">
                                <p id="stok-produk">Stock :18</p>
                            </div>
                            <div id="card-image">
                                <img src="" alt="Produk Image" id="image-produk">
                            </div>
                        </div>
                            <div id="card-text">
                            <h4 id="nama-produk">Tatakan Bambu Kuning Hitam Putih</h3>
                            <p id="harga-produk">Rp. 99.99</p>
                        </div>
                    </div>

                    <div id="card-container">
                        <div id="card-produk">
                            <div id="card-stok">
                                <p id="stok-produk">Stock :18</p>
                            </div>
                            <div id="card-image">
                                <img src="" alt="Produk Image" id="image-produk">
                            </div>
                        </div>
                            <div id="card-text">
                            <h4 id="nama-produk">Tatakan Bambu Kuning Hitam Putih</h3>
                            <p id="harga-produk">Rp. 99.99</p>
                        </div>
                    </div>

                    <div id="card-container">
                        <div id="card-produk">
                            <div id="card-stok">
                                <p id="stok-produk">Stock :18</p>
                            </div>
                            <div id="card-image">
                                <img src="" alt="Produk Image" id="image-produk">
                            </div>
                        </div>
                            <div id="card-text">
                            <h4 id="nama-produk">Tatakan Bambu Kuning Hitam Putih</h3>
                            <p id="harga-produk">Rp. 99.99</p>
                        </div>
                    </div>
                </div>
                {{-- Button Page --}}
                <div id="container-page-button">
                    <div id="page-button">
                        1 2 3 4 5 
                    </div>
                </div>

                {{-- Pengisian Biodata --}}
                <div id="btnBeli" class="bg-biodata">
                    <div id="container-biodata">
                        <div class="biodata">
                            <span class="material-symbols-outlined">shopping_bag</span>
                        </div>
                        <div id="text-button">
                            <p>Beli</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

{{-- Modal Pengisian Biodata --}}
<div id="modal-biodata" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="header-modul">
                <p>Pengisian Biodata</p>
            </div>
            <div class="form-group">
                <label for="nama-lengkap">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="nama-lengkap" id="nama-lengkap" placeholder="Masukan Nama Lengkap">
            </div>
        </form>
    </div>
</div>

{{-- Script --}}
<script>
    $(document).ready(function(){
        function showModal(modalId) {
            $(modalId).show();
        }

        function hideModals() {
            $(".modal").hide();
        }

        $("#btnBeli").on("click", function() {
            showModal("#modal-biodata");
        });

        $('.close').on("click", function() {
            hideModals();
        });

        $(window).on("click", function(event) {
            if ($(event.target).hasClass("modal")) {
                hideModals();
            }
        });
    });
</script>
</html>