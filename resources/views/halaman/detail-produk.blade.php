<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- LINK --}}
    <link rel="stylesheet" href="{{ asset('css/style-detail-produk.css') }}">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Detail Produk</title>
</head>
<body>
    <div id="background">
        <div id="co-background">
            <div id="content">
                <div id="image-produk">
                    <img src="img/bambu/bambu_11.jpeg" alt="Image Produk">
                </div>
                <div id="keterangan-produk">
                    <div id="nama-produk">
                        <p id="nama">EXAMPLE PRODUK</p>
                    </div>
                    <div id="harga-produk">
                        <p id="harga">Rp. 25.000</p>
                    </div>
                    <div id="deskripsi-produk">
                        <p id="judul-deskripsi">Deskripsi</p>
                    </div>
                    <div id="deskripsi-text">
                        <p id="deskripsi">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio, repellendus!</p>
                    </div>
                    <div id="text-atur-produk">
                        <p id="atur-produk">Masukan Jumlah Produk Yang Ingin Dibeli !</p>
                    </div>
                    {{-- JUMLAH PRODUK --}}
                    <div id="jumlah-produk">
                        <div id="banyak-kuantitas-produk">
                            <p id="banyak-kuantitas">Banyak : </p>
                        </div>
                        <div id="text-kuantitas-produk">
                            <p id="text-kuantitas">BOX ANGKA</p>
                        </div>
                        <div id="text-stock">
                            <p id="stock">Stock Tersedia : </p>
                        </div>
                        <div id="stock-barang">
                            <p id="angka-barang"> GET DB STOCK</p>
                        </div>
                    </div>
                    {{-- HARGA TOTAL PRODUK --}}
                    <div id="container-total-produk">
                        <div id="sub-text">
                            <p id="subtotal-produk">SUB TOTAL : </p>
                        </div>
                        <div id="harga-total">
                            <p id="text-total">HASIL KALI Rp. 40.000</p>
                        </div>
                    </div>
                    {{-- BUTTON BELI --}}
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
                    <!-- MODAL -->
                    <div id="modal-biodata" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="header-modul">
                                    <h2>Pengisian Biodata</h2>
                                </div>
                                <div class="form-group">
                                    <label for="nama-lengkap">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" name="nama-lengkap" id="nama-lengkap" placeholder="Masukan Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat <span class="required">*</span></label>
                                    <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota <span class="required">*</span></label>
                                    <input type="text" name="kota" id="kota" placeholder="Masukan Kota" required>
                                </div>
                                <div class="form-group">
                                    <label for="kode-pos">Kode Pos <span class="required">*</span></label>
                                    <input type="text" name="kode-pos" id="kode-pos" placeholder="Masukan Kode Pos" required>
                                </div>
                                <div class="form-group">
                                    <label for="no-telepon">Nomor WhatsApp <span class="required">*</span></label>
                                    <input type="text" name="no-telepon" id="no-telepon" placeholder="Masukan Nomor WhatsApp" required>
                                </div>
                                <div class="info-message">
                                    <p>Harap Pastikan Dengan Benar Nomor WhatsApp Karena Informasi mengenai pengiriman dan resi akan dikirimkan oleh admin melalui WhatsApp.</p>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="submit-btn">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("modal-biodata");

        // Get the button that opens the modal
        var btn = document.getElementById("btnBeli");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "flex";
            modal.style.justifyContent = "Center"
            modal.style.alignItems = "Center"
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>
</body>
</html>