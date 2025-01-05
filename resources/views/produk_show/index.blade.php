<!DOCTYPE html>
<html lang="en" x-data="cartData()">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @foreach($ingpo as $i)
    <link rel="icon" href="{{ asset('/storage/' . $i->favicon) }}" type="image/x-icon">
    @endforeach
    <link rel="stylesheet" href="{{ asset('css/style-detail-produk.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
    <title>{{$produk[0]->nama_produk}}</title>
</head>
<body>
    <!-- Toast Container -->
<div id="toast-container">
    <div id="toast-message" class="toast">
        Produk telah ditambahkan ke keranjang!
    </div>
</div>
   <!-- Button to Open Cart -->
    <div id="bg-navbar">
        <div id="navbar">
                <div id="header-kiri">
                    <a href="{{ route('dashboard.index') }}">
                        <div id="logo-company">
                            <img src="{{ asset('/storage/' . $i->favicon) }}" alt="Logo">
                        </div>
                    </a>
                    <div id="header-teks">
                        <div id="header-atas">
                            <p>PT. Bintang</p>
                        </div>
                        <div id="header-bawah">
                            <p>Mitra Kencana</p>
                        </div>
                    </div>
                </div>
            <div id="header-kanan" class="navbar-links">
                <ul>
                    <li><a href="{{ route('dashboard.index') }}">Home</a></li>
                    {{-- <li>About Us</li> --}}
                    <li><a href="{{ route('catalog.index') }}">Catalog</a></li>
                    {{-- <li>Contact Us</li> --}}
                    <li class="open-cart-btn" @click="toggleCart()">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span id="cart-count" class="cart-count" style="display: none;">0</span> <!-- Hidden until cart count > 0 -->
                    </li>
                </ul>
                {{-- Burger Icon --}}
                <div id="burger-menu">
                    <span id="burger-icon">&#9776;</span>
                </div>
                <div class="burger-menu-list" id="burgerMenuList">
                    <li><a href="{{ route('dashboard.index') }}">Home</a></li>
                    {{-- <li>About Us</li> --}}
                    <li><a href="{{ route('catalog.index') }}">Catalog</a></li>
                    {{-- <a href="#">Contact Us</a> --}}
                </div>
            </div>
        </div>
    </div>

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
                        <span class="nama-produk" x-text="item.nama_produk"></span>
                        <div class="cart-item-quantity">
                            <!-- Div untuk tombol minus -->
                            <div class="quantity-control" @click="decreaseQuantity(item.pid)">
                                <span class="material-symbols-outlined">
                                    remove
                                </span>
                            </div>
                
                            <input type="number" x-model="item.quantity" @change="updateQuantity(item.pid, item.quantity)" min="1">
                            
                            <!-- Div untuk tombol plus -->
                            <div class="quantity-control" @click="increaseQuantity(item.pid)">
                                <span class="material-symbols-outlined">
                                    add
                                </span>
                            </div>
                            
                            <span><span x-text="formatRupiah(item.harga * item.quantity)"></span></span>
                        </div>
                    </div>
                
                    <!-- Div untuk tombol delete -->
                    <div class="delete-control" @click="removeFromCart(item.pid)">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </div>
                </li>
                
               </template>
           </ul>
       </div>
       <div class="cart-total">
           Total: <span x-text="formatRupiah(cartTotal)"></span>
       </div>
       <div id="btnBeli" class="bg-biodata">
            <div id="container-beli">
                <div class="beli">
                    <span class="material-symbols-outlined">shopping_bag</span>
                </div>
                <div id="text-button">
                    <p>Checkout</p>
                </div>
            </div>
        </div>
   </div>
   <div id="product-page">
        <div id="co-background">
            @foreach ($produk as $p)
            <div id="content">
                <!-- Product Gallery with Main Image and Thumbnails -->
                <div id="image-produk">
                    <div class="main-image">
                        <img id="main-image" src="{{ asset('/storage/' . $p->image) }}" alt="Gambar {{$p->nama_produk}}">
                    </div>
                    <!-- Thumbnails below the main image -->
                    <div class="thumbnail-carousel">
                        <div class="thumbnail-images">
                            @if ($p->image)
                                <img src="{{ asset('/storage/' . $p->image) }}" alt="Thumbnail 1" onclick="changeMainImage(this)">
                            @endif
                            @if ($p->image1)
                                <img src="{{ asset('/storage/' . $p->image1) }}" alt="Thumbnail 1" onclick="changeMainImage(this)">
                            @endif
                            @if ($p->image2)
                                <img src="{{ asset('/storage/' . $p->image2) }}" alt="Thumbnail 2" onclick="changeMainImage(this)">
                            @endif
                            @if ($p->image3)
                                <img src="{{ asset('/storage/' . $p->image3) }}" alt="Thumbnail 3" onclick="changeMainImage(this)">
                            @endif
                            @if ($p->image4)
                                <img src="{{ asset('/storage/' . $p->image4) }}" alt="Thumbnail 4" onclick="changeMainImage(this)">
                            @endif
                        </div>
                     </div>                    
                </div>
        
                <!-- Product Details Section on the Right -->
                <div id="keterangan-produk">
                    <div id="nama-produk">
                        <p id="nama">{{$p->nama_produk}}</p>
                    </div>

                    <div id="kategori_id" hidden>
                        <p id="kategori_id">{{$p->kategori_id}}</p>
                    </div>
                    <div id="kode_produk" hidden>
                        <p id="kode_produk">{{$p->kode_produk}}</p>
                    </div>
                    
                    <div id="harga-produk">
                        <p id="harga" data-harga="{{ $p->harga }}">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                    </div>
        
                    <div id="deskripsi-produk">
                        <h3>Deskripsi</h3>
                    </div>
                    <div id="deskripsi-text">
                        <p id="deskripsi">{{$p->deskripsi}}</p>
                        <button id="show-more-btn" onclick="toggleDescription()">Lihat Selengkapnya</button>
                    </div>

                    <p id="berat">Berat : <span id="berat-barang">{{$p->berat}}</span><span id="gram"> Gram</span></p>
        
                    <div id="jumlah-produk">
                        <div id="text-stock">
                            <p id="stock">Stok Tersedia : <span id="angka-barang">{{ $p->jumlah_produk }}</span><span id="stok-buah"> Buah</span></p>
                        </div>
                    </div>
        
                    <div id="text-atur-produk">
                        <p id="atur-produk">Masukan Jumlah Produk Yang Ingin Dibeli!</p>
                    </div>

                    <div class="quantity-wrapper" style="{{ $p->jumlah_produk <= 0 ? 'pointer-events: none; opacity: 0.6;' : '' }}">
                        <button 
                            class="quantity-btn" 
                            @click="kurangBarangBelanja($event)">
                            -
                        </button>
                        <input 
                            type="number" 
                            class="qty quantity-input" 
                            value="1" 
                            min="1" 
                            name="qty" readonly>
                        <button 
                            class="quantity-btn" 
                            @click="tambahBarangBelanja($event, {{ $p->jumlah_produk }})">
                            +
                        </button>
                    </div>
        
                    <div id="container-total-produk">
                        <div id="sub-text">
                            <p id="subtotal-produk">SUB TOTAL:</p>
                        </div>
                        <div id="harga-total">
                            {{-- <input type="number" name="total_pembayaran" id="tot_bayar" class="total_pembayaran" x-text="formatRupiah(cartTotal)" value="" readonly> --}}
                            <span id="tot_bayar" class="total_pembayaran"></span>
                        </div>
                    </div>
        
                    <div id="btnAddCart" @click="addToCart('{{ $p->pid }}', '{{ $p->kategori_id }}', '{{ $p->kode_produk }}', '{{ $p->nama_produk }}', {{ $p->harga }}, $event)" style="{{ $p->jumlah_produk <= 0 ? 'pointer-events: none; opacity: 0.6;' : '' }}">
                        <div id="container-keranjang" >
                            <div class="keranjang">
                                <span class="material-symbols-outlined">shopping_cart</span>
                            </div>
                            <div id="text-button" >
                                <p>Tambah ke Keranjang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
   </div>

   {{-- Show Other Produk --}}
    <div id="produk-section">
        <div id="border-container">
            <h2>Produk Lainnya</h2>
            <div class="product-grid">
                @foreach($produkLainnya as $p)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('/storage/' . $p->image) }}" alt="Gambar {{ $p->nama_produk }}">
                    </div>
                    <div class="product-info">
                        <h3>{{ $p->nama_produk }}</h3>
                        {{-- <p>Rp {{ number_format($p->harga, 0, ',', '.') }}</p> --}}
                        <a href="{{ route('produk.show', $p->nama_produk) }}" class="btn-view-detail">Detail</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="footer-copyright">
        <p>&copy; {{ date('Y') }} ITENAS</p>
    </div>

    <!-- MODAL -->
    <div id="modal-biodata" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="mainForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="header-modul">
                    <h2>Pengisian Biodata</h2>
                </div>
                <div class="form-group">
                    <label for="name">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Masukan Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat <span class="required">*</span></label>
                    <input type="text" name="alamat" id="alamat" placeholder="Masukan Alamat" required>
                </div>
                <!-- Hidden Inputs -->
                {{-- <input type="hidden" name="kode_produk" id="kode_produk" value="{{$p->kode_produk}}"> --}}
                {{-- <input type="hidden" name="kategori_id" id="kategori_id" value="{{$p->kategori_id}}"> --}}
                <input type="hidden" name="modal_qty" id="modal_qty" value="">
                <input type="hidden" name="modal_harga" id="modal_harga" value="">
                <input type="hidden" name="modal_total" id="modal_total" value="">
                <input type="hidden" id="total-weight" x-model="totalWeight">

                <div class="form-group">
                    <label for="pos">Kode Pos <span class="required">*</span></label>
                    <input type="text" name="pos" id="pos" placeholder="Masukan Kode Pos" required>
                </div>
                <div class="form-group">
                    <label for="nohp">Nomor HP <span class="required">*</span></label>
                    <input type="text" name="nohp" id="nohp" placeholder="Masukan Nomor HP" required>
                    <small class="form-text text-muted">
                        Harap gunakan nomor WhatsApp Anda, karena invoice akan dikirim melalui WhatsApp.
                    </small>
                </div>
                <H3>PILIHAN PENGIRIMAN</H3>
                <div class="form-group">
                    <label for="province">Provinsi <span class="required">*</span></label>
                    <select id="province" name="province" required>
                        <option value="">Pilih Provinsi</option>
                        <!-- Tambahkan opsi provinsi di sini -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">Kota <span class="required">*</span></label>
                    <select id="city" name="city" disabled required>
                        <option value="">Pilih Kota</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="courier">Kurir <span class="required">*</span></label>
                    <select id="courier" name="courier" required>
                        <option value="jne">JNE</option>
                        <option value="pos">POS</option>
                        <option value="tiki">TIKI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="courier_service">Layanan Kurir <span class="required">*</span></label>
                    <select id="courier_service" name="courier_service" disabled required>
                        <option value="">Pilih Layanan Kurir</option>
                    </select>
                </div>
                <div id="container-ongkir" hidden>
                    <div id="ongkir" hidden>Biaya Ongkir: </div>
                    <div id="cost" hidden>Ongkir ?</div>
                </div>
                <div class="form-group">
                    <button type="submit" id="cek" class="submit-btn checkout-button">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
    <script src="/js/burger.js"></script>


    <script>

        function toggleDescription() {
            var descElement = document.getElementById("deskripsi");
            var btn = document.getElementById("show-more-btn");

            // Expand the description (show full text)
            if (descElement.style.webkitLineClamp === '5' || descElement.style.webkitLineClamp === '') {
                descElement.style.webkitLineClamp = 'unset';  // Unset the line clamp to show full text
                btn.textContent = "Lihat Lebih Sedikit";       // Change button text to "Show Less"
            } else {
                // Collapse the description back to 5 lines
                descElement.style.webkitLineClamp = '5';      // Limit to 5 lines
                btn.textContent = "Lihat Selengkapnya";       // Change button text to "Show More"
            }
        }



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
            qtyElement.closest('#content').querySelector(".total_pembayaran").innerText = formatRupiah(total);
        }

        // Fungsi untuk mengurangi kuantitas produk
        function kurangBarangBelanja(event) {
            var button = event.target;  // Get the clicked button element
            var qtyElement = button.nextElementSibling;  // Get the input element
            var value = parseInt(qtyElement.value, 10);

            if (value > 1) {
                qtyElement.value = value - 1;
                calculateTotal(qtyElement);  // Recalculate total after decreasing
            }
        }

    // Function to increase quantity
        function tambahBarangBelanja(event, maxStok) {
            var button = event.target;  // Get the clicked button element
            var qtyElement = button.previousElementSibling;  // Get the input element
            var value = parseInt(qtyElement.value, 10);

            if (value < maxStok) {
                qtyElement.value = value + 1;
                calculateTotal(qtyElement);  // Recalculate total after decreasing
            } // Recalculate total after increasing
        }
        
        
        // Kalkulasi harga total saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll(".qty").forEach(function (element) {
                calculateTotal(element); // Hitung total harga ketika halaman dimuat

                // Kalkulasi ulang ketika jumlah produk diubah
                element.addEventListener("input", function () {
                    calculateTotal(this);
                });
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
            var province = document.getElementById("province").options[document.getElementById("province").selectedIndex].text;
            var city = document.getElementById("city").options[document.getElementById("city").selectedIndex].text;
            var courier = document.getElementById("courier").value;
            var courierService = document.getElementById("courier_service").value;

            var cost = document.getElementById("cost").textContent.replace("Rp", "").trim();  // Fix: Use textContent instead of value
            var formData = {
                nama: document.getElementById("name").value,
                alamat: document.getElementById("alamat").value,
                city: city,
                pos: document.getElementById("pos").value,
                nohp: document.getElementById("nohp").value,
                kode_produk: document.getElementById("kode_produk").value,
                // modal_total: document.getElementById("modal_total").value,
                // nama_produk: document.querySelector("#nama-produk").textContent,
                // modal_qty: document.getElementById("modal_qty").value,
                // modal_harga: document.getElementById("modal_harga").value,
                kategori_id: document.getElementById("kategori_id").value,
                cost: cost,  // Fix: Store the cost correctly
                province: province,  // Fix: Added province to formData
                courier: courier,  // Fix: Added courier to formData
                courierService: courierService  // Fix: Added courier service to formData
            };

            for (var key in formData) {
                localStorage.setItem(key, formData[key]);
            }

            window.location.href = "/checkout";
            // console.log(formData);
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

        // Modal Scrolling
        // Mendapatkan elemen modal dan tombol close
        var modal = document.getElementById("modal-biodata");
        var closeBtn = document.getElementsByClassName("close")[0];
        var body = document.body;

        // Saat tombol 'Beli' diklik, modal akan terbuka
        document.getElementById("btnBeli").onclick = function() {
            modal.style.display = "flex"; // Menampilkan modal
            modal.style.justifyContent = "center"; // Pusatkan secara vertikal
            modal.style.alignItems = "center"; // Pusatkan secara horizontal
            body.style.overflow = "hidden"; // Mengunci scroll halaman belakang
        }

        // Saat tombol 'X' diklik, modal akan ditutup
        closeBtn.onclick = function() {
            modal.style.display = "none"; // Sembunyikan modal
            body.style.overflow = "auto"; // Kembalikan scroll halaman belakang
        }

        // Jika user mengklik di luar modal, modal akan ditutup
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none"; // Sembunyikan modal
                body.style.overflow = "auto"; // Kembalikan scroll halaman belakang
            }
        }
    </script>
    
    <script>
        $(document).ready(function () {
        // Fetch provinces
        $.get('/provinces')
            .done(function (data) {
                if (data.length === 0) {
                    console.log("No provinces found.");
                } else {
                    data.forEach(function (province) {
                        $('#province').append('<option value="' + province.province_id + '">' + province.province + '</option>');
                    });
                }
            })
            .fail(function () {
                console.error("Error fetching provinces. Check your endpoint or server response.");
            });

        // Fetch cities based on selected province
        $('#province').change(function () {
            var province_id = $(this).val();
            $('#city').prop('disabled', false).empty().append('<option value="">Pilih Kota</option>');

            $.get('/cities/' + province_id)
                .done(function (data) {
                    if (data.length === 0) {
                        console.log("No cities found for this province.");
                    } else {
                        data.forEach(function (city) {
                            $('#city').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
                        });
                    }
                })
                .fail(function () {
                    console.error("Error fetching cities for the selected province.");
                });
        });

        // Fetch services and costs based on selected city and courier
        $('#city, #courier').change(function () {
            var city_id = $('#city').val();
            var courier = $('#courier').val();
            var weight = $('#total-weight').val();

            if (city_id && courier) {
                $.post('/cost', {
                    _token: '{{ csrf_token() }}',
                    origin: 24, // Example origin city ID
                    destination: city_id,
                    courier: courier,
                    weight: weight,
                })
                .done(function (data) {
                    if (data && data[0] && data[0].costs && data[0].costs.length > 0) {
                        var services = data[0].costs;
                        $('#courier_service').prop('disabled', false).empty().append('<option value="">Pilih Layanan Kurir</option>');
                        services.forEach(function (service) {
                            $('#courier_service').append('<option value="' + service.service + '" data-cost="' + service.cost[0].value + '">' + service.service + ' - Rp ' + service.cost[0].value + '</option>');
                        });
                    } else {
                        $('#courier_service').prop('disabled', true).empty().append('<option value="">Tidak ada layanan tersedia</option>');
                    }
                })
                .fail(function () {
                    console.error("Error fetching courier services and costs.");
                });
            }
        });

        // Update shipping cost display based on selected courier service
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
                    cartItems: JSON.parse(localStorage.getItem("cartItems")) || [],
                    cartTotal: parseFloat(localStorage.getItem("cartTotal")) || 0,
                    totalWeight: parseFloat(localStorage.getItem("totalWeight")) || 0,
                    cartVisible: false,

                    init() {
                        this.updateCartTotal();
                        this.updateTotalWeight();
                        this.updateShippingCost();
                        this.updateCartCount(); // Update the cart count after changing quantity
                    },

                    toggleCart() {
                        this.cartVisible = !this.cartVisible;
                    },

                    addToCart(pid, kategori_id, kode_produk, nama_produk, harga, event) {
                        // Ambil elemen terkait di DOM
                        const qtyElement = event.target.closest('#content').querySelector('.qty');
                        const beratElement = event.target.closest('#content').querySelector('#berat-barang');
                        
                        // Ambil nilai quantity dan berat
                        const qty = parseInt(qtyElement.value, 10) || 0; // Jika qty kosong, default ke 0
                        const berat = parseFloat(beratElement.textContent) || 0; // Jika berat kosong, default ke 0

                        // Validasi jumlah
                        if (qty <= 0) {
                            alert("Jumlah produk harus lebih dari 0.");
                            return;
                        }

                        // Hitung sub-total dan total berat
                        const subTotal = qty * harga;
                        const totalWeight = qty * berat;

                        // Periksa apakah produk sudah ada di keranjang
                        let product = this.cartItems.find(item => item.pid === pid);

                        if (product) {
                            // Update produk yang sudah ada
                            product.quantity += qty;
                            product.subTotal = product.quantity * product.harga;
                            product.totalWeight = product.quantity * product.berat;
                        } else {
                            // Tambahkan produk baru ke keranjang
                            this.cartItems.push({
                                pid,
                                kategori_id,
                                kode_produk,
                                nama_produk,
                                harga,
                                quantity: qty,
                                subTotal: subTotal,
                                berat: berat,
                                totalWeight: totalWeight,
                            });
                        }

                        // console.log(JSON.parse(localStorage.getItem("cartItems")));


                        // Perbarui keranjang dan localStorage
                        this.updateCartTotal();
                        this.updateTotalWeight();
                        this.saveCartToLocalStorage();
                        this.updateShippingCost();
                        this.updateCartCount(); // Update the cart count after changing quantity
                        this.showToast("Produk telah ditambahkan ke keranjang!");

                        // Tampilkan notifikasi sukses
                        
                    },



                    removeFromCart(pid) {
                        // Find the product index
                        let productIndex = this.cartItems.findIndex(item => item.pid === pid);
                        if (productIndex !== -1) {
                            // Remove product from the array
                            this.cartItems.splice(productIndex, 1);
                        }

                        // Update the cart and localStorage
                        this.updateCartTotal();
                        this.updateTotalWeight();
                        this.saveCartToLocalStorage();
                        this.updateShippingCost();
                        this.updateCartCount(); // Update the cart count after changing quantity
                        this.showToast("Produk telah dihapus dari keranjang!"); // Show toast when item is removed
                    },

                    updateQuantity(pid, newQty) {
                        // Find the product in the array
                        let product = this.cartItems.find(item => item.pid === pid);
                        if (product) {
                            product.quantity = newQty;
                            product.subTotal = product.quantity * product.harga; // Recalculate sub-total
                            product.totalWeight = product.quantity * product.berat;
                        }

                        // Update the cart and localStorage
                        this.updateCartTotal();
                        this.updateTotalWeight();
                        this.saveCartToLocalStorage();
                        this.updateShippingCost();
                        this.showToast("Jumlah produk diperbarui!");
                    },

                    updateCartTotal() {
                        // Update the overall cart total (sum of all sub-totals)
                        this.cartTotal = this.cartItems.reduce((total, item) => total + item.subTotal, 0);
                        localStorage.setItem("cartTotal", this.cartTotal);
                    },

                    updateTotalWeight() {
                        this.totalWeight = this.cartItems.reduce((total, item) => total + item.totalWeight, 0);
                        localStorage.setItem("totalWeight", this.totalWeight); // Simpan totalWeight
                    },

                    saveCartToLocalStorage() {
                        // console.log("Saving to localStorage:", this.cartItems); // Debug
                        localStorage.setItem("cartItems", JSON.stringify(this.cartItems)); // Save the updated cartItems array to localStorage
                    
                    },

                    increaseQuantity(pid) {
                        let product = this.cartItems.find(item => item.pid === pid);
                        if (product) {
                            product.quantity++; // Increase quantity
                            product.subTotal = product.quantity * product.harga; // Recalculate sub-total
                            product.totalWeight = product.quantity * product.berat;
                        }

                        // Update cart and save changes
                        this.updateCartTotal();
                        this.updateTotalWeight();
                        this.saveCartToLocalStorage();
                        this.updateShippingCost();
                    },

                    decreaseQuantity(pid) {
                        let product = this.cartItems.find(item => item.pid === pid);
                        if (product && product.quantity > 1) {
                            product.quantity--; // Decrease quantity
                            product.subTotal = product.quantity * product.harga; // Recalculate sub-total
                            product.totalWeight = product.quantity * product.berat;
                        } else if (product && product.quantity === 1) {
                            // If quantity is 1, remove the item
                            this.removeFromCart(pid);
                        }

                        // Update cart and save changes
                        this.updateCartTotal();
                        this.updateTotalWeight();
                        this.saveCartToLocalStorage();
                        this.updateShippingCost();
                    },
                    updateCartCount() {
                        // Count the unique products by checking the length of cartItems
                        const uniqueProductCount = this.cartItems.length;

                        // If there are unique products in the cart, show the count, else hide it
                        const cartCountElement = document.getElementById('cart-count');
                        if (uniqueProductCount > 0) {
                            cartCountElement.style.display = 'inline';  // Show the cart count
                            cartCountElement.textContent = uniqueProductCount; // Set the count to the number of unique products
                        } else {
                            cartCountElement.style.display = 'none';  // Hide the cart count if empty
                        }
                    },
                    showToast(message) {
                        const toast = document.getElementById('toast-message');
                        toast.textContent = message; // Set the toast message
                        toast.style.display = 'block'; // Show the toast

                        // Hide the toast after 3 seconds
                        setTimeout(() => {
                            toast.style.display = 'none';
                        }, 3000);
                    },
                    updateShippingCost() {
                        const city_id = $('#city').val();
                        const courier = $('#courier').val();

                        if (city_id && courier && this.totalWeight > 0) {
                            $.post('/cost', {
                                _token: '{{ csrf_token() }}',
                                origin: 24,
                                destination: city_id,
                                courier: courier,
                                weight: this.totalWeight, // Kirim totalWeight
                            })
                            .done((data) => {
                                if (data && data[0] && data[0].costs && data[0].costs.length > 0) {
                                    const services = data[0].costs;
                                    $('#courier_service').prop('disabled', false).empty().append('<option value="">Pilih Layanan Kurir</option>');
                                    services.forEach(function (service) {
                                        $('#courier_service').append('<option value="' + service.service + '" data-cost="' + service.cost[0].value + '">' + service.service + ' - Rp ' + service.cost[0].value + '</option>');
                                    });
                                } else {
                                    $('#courier_service').prop('disabled', true).empty().append('<option value="">Tidak ada layanan tersedia</option>');
                                }
                            })
                            .fail(() => {
                                console.error("Error fetching courier services and costs.");
                            });
                        }
                    },
                };
            }
            function formatRupiah(amount) {
                return '' + new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount).replace('IDR', '').trim();
            }
            // Initialize the cart data on page load
document.addEventListener('DOMContentLoaded', function () {
    const cart = cartData();
    cart.init();  // Call init to ensure cart count is updated
});
    </script>

    <script>
        function changeMainImage(thumbnail) {
            // Get the main image element
            const mainImage = document.getElementById('main-image');
            
            // Update the src of the main image to match the clicked thumbnail's src
            mainImage.src = thumbnail.src;
        }
    </script>
</body>
</html>
