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

</head>
<body>
   <!-- Button to Open Cart -->
   <button class="open-cart-btn" @click="toggleCart()"><span class="material-symbols-outlined">shopping_cart</span></button>

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
                               <button @click="decreaseQuantity(item.pid)">-</button>
                               <input type="number" x-model="item.quantity" @change="updateQuantity(item.pid, item.quantity)" min="1">
                               <button @click="increaseQuantity(item.pid)">+</button>
                               <span>Rp <span x-text="item.harga * item.quantity"></span></span>
                           </div>
                       </div>
                       <button @click="removeFromCart(item.pid)">Hapus</button>
                   </li>
               </template>
           </ul>
       </div>
       <div class="cart-total">
           Total: Rp <span x-text="cartTotal"></span>
       </div>
       <div id="btnBeli" class="bg-biodata">
        <div id="container-biodata">
            <div class="biodata">
                <span class="material-symbols-outlined">shopping_bag</span>
            </div>
            <div id="text-button">
                <p>Buy</p>
            </div>
        </div>
    </div>
   </div>
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
                    {{-- Jumlah Produk --}}
                    <div id="jumlah-produk">
                        <div id="banyak-kuantitas-produk">
                            <p id="banyak-kuantitas">Banyak : </p>
                        </div>
                        <div id="text-kuantitas-produk">
                            <input type="number" name="qty" class="qty" value="1" min="1" id="qty-{{ $p->pid }}">
                        </div>
                        <div id="text-stock">
                            <p id="stock">Stock Tersedia : </p>
                        </div>
                        <div id="stock-barang">
                            <p id="angka-barang">{{ $p->jumlah_produk }}</p>
                        </div>
                    </div>
                    {{-- Harga Total Produk --}}
                    <div id="container-total-produk">
                        <div id="sub-text">
                            <p id="subtotal-produk">SUB TOTAL : </p>
                        </div>
                        <div id="harga-total">
                            <input type="number" name="total_pembayaran" id="tot_bayar" class="total_pembayaran" value="" readonly>
                        </div>
                    </div>
                    <button @click="addToCart('{{ $p->pid }}', '{{ $p->nama_produk }}', {{ $p->harga }}, $event)">Tambah ke Keranjang</button> 
                    <div id="abtnBeli" class="bg-biodata">
                        <div id="container-biodata">
                            <div class="biodata">
                                <span class="material-symbols-outlined">shopping_bag</span>
                            </div>
                            <div id="text-button">
                                <p>Buy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
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
                <input type="hidden" name="kode_produk" id="kode_produk" value="{{$p->kode_produk}}">
                <input type="hidden" name="kategori_id" id="kategori_id" value="{{$p->kategori_id}}">
                <input type="hidden" name="modal_qty" id="modal_qty" value="">
                <input type="hidden" name="modal_harga" id="modal_harga" value="">
                <input type="hidden" name="modal_total" id="modal_total" value="">
                {{-- <div class="form-group">
                    <label for="city">Kota <span class="required">*</span></label>
                    <input type="text" name="city" id="city" placeholder="Masukan Kota" required>
                </div> --}}
                <div class="form-group">
                    <label for="pos">Kode Pos <span class="required">*</span></label>
                    <input type="text" name="pos" id="pos" placeholder="Masukan Kode Pos" required>
                </div>
                <div class="form-group">
                    <label for="nohp">Nomor HP <span class="required">*</span></label>
                    <input type="text" name="nohp" id="nohp" placeholder="Masukan Nomor HP" required>
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
                <h3 id="ongkir">Biaya Ongkir:</h3> <div id="cost">Pilih pengiriman untuk melihat ongkir</div>
                <div class="form-group">
                    <button type="submit" id="cek" class="submit-btn checkout-button">Tambahkan</button>
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
                    cartItems: JSON.parse(localStorage.getItem("cartItems")) || [], // Initialize cartItems from localStorage or as an empty array
                    cartTotal: 0,
                    cartVisible: false,

                    init() {
                        this.updateCartTotal();
                    },

                    toggleCart() {
                        this.cartVisible = !this.cartVisible;
                    },

                    addToCart(pid, nama_produk, harga, event) {
                        let qtyElement = event.target.closest('#content').querySelector('.qty');
                        let qty = parseInt(qtyElement.value, 10); // Get the qty value from the input
                        let subTotal = qty * harga; // Calculate sub-total for this product

                        // Check if the item already exists in the cartItems array
                        let product = this.cartItems.find(item => item.pid === pid);
                        if (product) {
                            product.quantity += qty; // Update the quantity
                            product.subTotal = product.quantity * product.harga; // Recalculate sub-total
                        } else {
                            // Add new product to cartItems array
                            this.cartItems.push({ pid, nama_produk, harga, quantity: qty, subTotal: subTotal });
                        }

                        // Update the cart and localStorage
                        this.updateCartTotal();
                        this.saveCartToLocalStorage(); // Save the updated cartItems array to localStorage
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
                        this.saveCartToLocalStorage(); // Update localStorage after removal
                    },

                    updateQuantity(pid, newQty) {
                        // Find the product in the array
                        let product = this.cartItems.find(item => item.pid === pid);
                        if (product) {
                            product.quantity = newQty;
                            product.subTotal = product.quantity * product.harga; // Recalculate sub-total
                        }

                        // Update the cart and localStorage
                        this.updateCartTotal();
                        this.saveCartToLocalStorage(); // Update localStorage when quantity changes
                    },

                    updateCartTotal() {
                        // Update the overall cart total (sum of all sub-totals)
                        this.cartTotal = this.cartItems.reduce((total, item) => total + item.subTotal, 0);
                    },

                    saveCartToLocalStorage() {
                        localStorage.setItem("cartItems", JSON.stringify(this.cartItems)); // Save the updated cartItems array to localStorage
                    },

                    increaseQuantity(pid) {
                        let product = this.cartItems.find(item => item.pid === pid);
                        if (product) {
                            product.quantity++; // Increase quantity
                            product.subTotal = product.quantity * product.harga; // Recalculate sub-total
                        }

                        // Update cart and save changes
                        this.updateCartTotal();
                        this.saveCartToLocalStorage(); // Save updated data to localStorage
                    },

                    decreaseQuantity(pid) {
                        let product = this.cartItems.find(item => item.pid === pid);
                        if (product && product.quantity > 1) {
                            product.quantity--; // Decrease quantity
                            product.subTotal = product.quantity * product.harga; // Recalculate sub-total
                        } else if (product && product.quantity === 1) {
                            // If quantity is 1, remove the item
                            this.removeFromCart(pid);
                        }

                        // Update cart and save changes
                        this.updateCartTotal();
                        this.saveCartToLocalStorage(); // Save updated data to localStorage
                    },
                };
            }
    </script>
</body>
</html>
