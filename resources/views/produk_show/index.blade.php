<!DOCTYPE html>
<html lang="en" x-data="cartData()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style-detail-produk.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
    <style>
        /* CSS untuk tombol yang enable (warna aslinya) */
        .checkout-button {
            background-color: #4CAF50; /* Warna asli tombol */
            color: white;
            cursor: pointer;
        }

        /* CSS untuk tombol yang disable */
        .checkout-button.disabled {
            background-color: #ccc; /* Warna abu-abu ketika disable */
            color: #666;
            cursor: not-allowed;
        }
    </style>
    @foreach ($produk as $p)
        
    <title>{{$p->nama_produk}}</title>
    @endforeach
</head>
<body>
    <div id="bg-header">
        <div id="bo-header" class="clearfix">
            <div id="kiri-header" class="clearfix">
                <div id="atas-header">
                    <h1>PT. Bintang</h1>
                </div>
                <div id="bawah-header">
                    <h1>Mitra Kencana</h1>
                </div>
            </div>
            <div id="kanan-header">
                <ul>
                    <li class="kuning">Home</li>
                    <li>About Us</li>
                    <li>Services</li>
                    <li><a href="/catalog">Catalog</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Button to Open Cart -->
    <button class="open-cart-btn" @click="toggleCart()">🛒</button>

    <!-- Cart Menu -->
    <div class="cart-menu" :class="{ 'active': cartVisible }">
        <div class="cart-header">
            <h3>Keranjang Belanja</h3>
            <span class="close-cart" @click="toggleCart()">✖</span>
        </div>
        <div class="cart-body">
            <ul>
                <template x-for="(item, index) in cartItems" :key="item.pid">
                    <li class="cart-item">
                        <div class="cart-item-info">
                            <span x-text="item.nama_produk"></span>
                            <div class="cart-item-quantity">
                                <button @click="decreaseQuantity(index)" class="quantity-btn">-</button>
                                <input type="number" x-model="item.quantity" @change="updateCart(index)" min="1">
                                <button @click="increaseQuantity(index)" class="quantity-btn">+</button>
                                <span>Rp <span x-text="item.harga * item.quantity"></span></span>
                            </div>
                        </div>
                        <button @click="removeFromCart(index)">Hapus</button>
                    </li>
                </template>
            </ul>
        </div>
        <div class="cart-total">
            Total: Rp <span x-text="cartTotal"></span>
        </div>
    </div>
    {{-- <h1>Biaya Ongkir</h1>
    <p>Biaya: Rp {{ number_format($ongkir, 0, ',', '.') }}</p> --}}
    <div id="background">
        <div id="co-background">
            @foreach ($produk as $p)
            <div id="content">
                <div id="image-produk">
                    <img src="{{ asset('storage/' . $p->image) }}" alt="Gambar {{$p->nama_produk}}">
                </div>
                <div id="keterangan-produk">
                    <div id="nama-produk">
                        <p id="nama">{{$p->nama_produk}}</p>
                    </div>
                    <div id="harga-produk">
                        <p id="harga" data-harga="{{ $p->harga }}">{{ $p->harga }}</p>
                    </div>
                    <div id="deskripsi-produk">
                        <p id="judul-deskripsi">Deskripsi</p>
                    </div>
                    <div id="deskripsi-text">
                        <p id="deskripsi">{{$p->deskripsi}}</p>
                    </div>
                    <div id="text-atur-produk">
                        <p id="atur-produk">Masukan Jumlah Produk Yang Ingin Dibeli !</p>
                    </div>
                    <div id="jumlah-produk">
                        <div id="banyak-kuantitas-produk">
                            <p id="banyak-kuantitas">Banyak : </p>
                        </div>
                        <div id="text-kuantitas-produk">
                            <input type="number" name="qty" class="qty" value="">
                        </div>
                        <div id="text-stock">
                            <p id="stock">Stock Tersedia : </p>
                        </div>
                        <div id="stock-barang">
                            <p id="angka-barang">{{ $p->jumlah_produk }}</p>
                        </div>
                    </div>
                    <div id="container-total-produk">
                        <div id="sub-text">
                            <p id="subtotal-produk">SUB TOTAL : </p>
                        </div>
                        <div id="harga-total">
                            <input type="number" name="total_pembayaran" class="total_pembayaran" value="" readonly>
                        </div>
                    </div>
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
                    <div id="card-text">
                        <button @click="addToCart('{{ $p->pid }}', '{{ $p->nama_produk }}', {{ $p->harga }})">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- MODAL -->
    <div id="modal-biodata" class="modal">
        <div class="modal-content" id="mainForm">
            <span class="close">&times;</span>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="header-modul">
                    <h2>Pengisian Biodata</h2>
                </div>
                <div class="form-group">
                    <label for="nama-lengkap">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Masukan Nama Lengkap" required>
                </div>
                <label for="province">Provinsi:</label>
                <select id="province">
                    <option value="">Pilih Provinsi</option>
                </select>

                <label for="city">Kota:</label>
                <select id="city" disabled>
                    <option value="">Pilih Kota</option>
                </select>

                <label for="courier">Kurir:</label>
                <select id="courier">
                    <option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">TIKI</option>
                </select>
                
                <label for="courier_service">Layanan Kurir:</label>
                <select id="courier_service" disabled>
                    <option value="">Pilih Layanan Kurir</option>
                </select>                

                <h3>Biaya Ongkir:</h3>
                <div id="cost">Pilih kota dan kurir untuk melihat ongkir</div>
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap<span class="required">*</span></label>
                    <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="kode_produk" id="kode_produk" value="{{$p->kode_produk}}">
                    <input type="hidden" name="jenis_produk" id="jenis_produk" value="{{$p->jenis_produk}}">
                    <input type="hidden" name="modal_qty" id="modal_qty" value="">
                    <input type="hidden" name="modal_harga" id="modal_harga" value="">
                    <input type="hidden" name="modal_total" id="modal_total" value="">
                </div>
                <div class="form-group">
                    <label for="city">Kota <span class="required">*</span></label>
                    <input type="text" name="city" id="city" placeholder="Masukan Kota" required>
                </div>
                <div class="form-group">
                    <label for="pos">Kode Pos <span class="required">*</span></label>
                    <input type="text" name="pos" id="pos" placeholder="Masukan Kode Pos" required>
                </div>
                <div class="form-group">
                    <label for="nohp">Nomor HP <span class="required">*</span></label>
                    <input type="text" name="nohp" id="nohp" placeholder="Masukan Nomor Hp" required>
                </div>
                <div class="form-group">
                    <button type="submit" id="cek" class="submit-btn checkout-button">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function calculateTotal(qtyElement) {
            var qty = qtyElement.value;
            var harga = qtyElement.closest('#content').querySelector("#harga").getAttribute("data-harga");

            var qtyInt = parseInt(qty, 10);
            var hargaInt = parseInt(harga, 10);

            if (isNaN(qtyInt) || isNaN(hargaInt)) {
                qtyElement.closest('#content').querySelector(".total_pembayaran").value = "";
                return;
            }

            var total = qtyInt * hargaInt;
            qtyElement.closest('#content').querySelector(".total_pembayaran").value = total;
        }

        document.querySelectorAll(".qty").forEach(function (element) {
            element.addEventListener("input", function () {
                calculateTotal(this);
            });
        });

        // Modal handling
        var modal = document.getElementById("modal-biodata");
        var btn = document.getElementById("btnBeli");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "flex";
            modal.style.justifyContent = "center";
            modal.style.alignItems = "center";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.querySelector("#btnBeli").addEventListener("click", function(e) {
            e.preventDefault();
            document.getElementById("modal_qty").value = document.querySelector(".qty").value;
            document.getElementById("modal_harga").value = document.querySelector("#harga").textContent;
            document.getElementById("modal_total").value = document.querySelector(".total_pembayaran").value;
        });

        document.querySelector("#cek").addEventListener("click", function(e) {
            e.preventDefault();

            var formData = {
                nama: document.getElementById("name").value,
                alamat: document.getElementById("alamat").value,
                city: document.getElementById("city").value,
                pos: document.getElementById("pos").value,
                nohp: document.getElementById("nohp").value,
                kode_produk: document.getElementById("kode_produk").value,
                modal_total: document.getElementById("modal_total").value,
                nama_produk: document.querySelector("#nama-produk p").textContent,
                modal_qty: document.getElementById("modal_qty").value,
                modal_harga: document.getElementById("modal_harga").value,
                jenis_produk: document.getElementById("jenis_produk").value,
            };

            for (var key in formData) {
                localStorage.setItem(key, formData[key]);
            }

            window.location.href = "/checkout";
        });

        // Implementing checkForm function
        function checkForm() {
            var isDisabled = false;
            $("#mainForm input").each(function() {
                if ($(this).val() === "") {
                    isDisabled = true;
                }
            });
            if (isDisabled) {
                $(".checkout-button").addClass("disabled");
                $(".checkout-button").prop("disabled", true);
            } else {
                $(".checkout-button").removeClass("disabled");
                $(".checkout-button").prop("disabled", false);
            }
        }

        // Trigger checkForm on input changes within the modal form
        $("#mainForm input").on("input", function() {
            checkForm();
        });

        // Run checkForm initially when the modal opens
        btn.onclick = function() {
            modal.style.display = "flex";
            modal.style.justifyContent = "center";
            modal.style.alignItems = "center";
            checkForm(); // Check form state when modal is opened
        }

    </script>
    <script>
$(document).ready(function () {
    // Fetch provinces
    $.get('/provinces', function (data) {
        data.forEach(function (province) {
            $('#province').append('<option value="' + province.province_id + '">' + province.province + '</option>');
        });
    });

    // Fetch cities based on province
    $('#province').change(function () {
        var province_id = $(this).val();
        $('#city').prop('disabled', false).empty().append('<option value="">Pilih Kota</option>');

        $.get('/cities/' + province_id, function (data) {
            data.forEach(function (city) {
                $('#city').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
            });
        });
    });

    // Fetch services and costs when city and courier are selected
    $('#city, #courier').change(function () {
        var city_id = $('#city').val();
        var courier = $('#courier').val();

        if (city_id && courier) {
            $.post('/cost', {
                _token: '{{ csrf_token() }}',
                origin: 24, // Example origin city ID (Yogyakarta)
                destination: city_id,
                courier: courier
            }, function (data) {
                if (data && data[0] && data[0].costs && data[0].costs.length > 0) {
                    var services = data[0].costs;
                    $('#courier_service').prop('disabled', false).empty().append('<option value="">Pilih Layanan Kurir</option>');
                    services.forEach(function (service) {
                        $('#courier_service').append('<option value="' + service.service + '" data-cost="' + service.cost[0].value + '">' + service.service + ' - Rp ' + service.cost[0].value + '</option>');
                    });
                } else {
                    $('#courier_service').prop('disabled', true).empty().append('<option value="">Tidak ada layanan tersedia</option>');
                }
            });
        }
    });

    // Update shipping cost when courier service is selected
    $('#courier_service').change(function () {
        var selectedService = $('#courier_service option:selected');
        var cost = selectedService.data('cost');

        if (cost) {
            $('#cost').text('Rp ' + cost);
        } else {
            $('#cost').text('Pilih kota dan kurir untuk melihat ongkir');
        }
    });
});
    </script>
    <script>
        function cartData() {
            return {
                cartItems: @json(session('keranjang', [])), // Fetch cart items from session
                cartTotal: 0,
                cartVisible: false,
        
                init() {
                    this.updateCartTotal();
                },
        
                toggleCart() {
                    this.cartVisible = !this.cartVisible;
                },
        
                addToCart(pid, nama_produk, harga) {
                    let item = this.cartItems.find(item => item.pid === pid);
                    if (item) {
                        item.quantity++;
                    } else {
                        this.cartItems.push({ pid, nama_produk, harga, quantity: 1 });
                    }
                    this.updateCartTotal();
                    this.syncCartWithSession();
                },
        
                updateCartTotal() {
                    this.cartTotal = this.cartItems.reduce((total, item) => total + item.quantity * item.harga, 0);
                },
        
                removeFromCart(index) {
                    this.cartItems.splice(index, 1);
                    this.updateCartTotal();
                    this.syncCartWithSession();
                },
        
                updateCart(index) {
                    if (this.cartItems[index].quantity <= 0) {
                        this.removeFromCart(index);
                    }
                    this.updateCartTotal();
                    this.syncCartWithSession();
                },
        
                syncCartWithSession() {
                    fetch('/sync-cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ cart: this.cartItems })
                    });
                },
        
                increaseQuantity(index) {
                    this.cartItems[index].quantity++;
                    this.updateCartTotal();
                },
        
                decreaseQuantity(index) {
                    if (this.cartItems[index].quantity > 1) {
                        this.cartItems[index].quantity--;
                        this.updateCartTotal();
                    }
                },
            }
        }
        </script>
</body>
</html>
