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
                <div class="thumbnail-images">
                    <img src="{{ asset('/storage/' . $p->image) }}" alt="Thumbnail 1" onclick="changeMainImage(this)">
                    <img src="{{ asset('/storage/' . $p->image1) }}" alt="Thumbnail 1" onclick="changeMainImage(this)">
                    <img src="{{ asset('/storage/' . $p->image2) }}" alt="Thumbnail 2" onclick="changeMainImage(this)">
                    <img src="{{ asset('/storage/' . $p->image3) }}" alt="Thumbnail 3" onclick="changeMainImage(this)">
                    <img src="{{ asset('/storage/' . $p->image4) }}" alt="Thumbnail 4" onclick="changeMainImage(this)">
                </div>
            </div>
    
            <!-- Product Details Section on the Right -->
            <div id="keterangan-produk">
                <div id="nama-produk">
                    <p id="nama">{{$p->nama_produk}}</p>
                </div>
                <div id="harga-produk">
                    <p id="harga" data-harga="{{ $p->harga }}">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                </div>
                <p id="berat">{{$p->berat}}</p>
                
                <div id="deskripsi-produk">
                    <h3>Deskripsi</h3>
                </div>
                <div id="deskripsi-text">
                    <p id="deskripsi">{{$p->deskripsi}}</p>
                </div>
    
                <div id="jumlah-produk">
                    <div id="text-stock">
                        <p id="stock">Stok Tersedia: <span id="angka-barang">{{ $p->jumlah_produk }}</span></p>
                    </div>
                </div>
    
                <div id="text-atur-produk">
                    <p id="atur-produk">Masukan Jumlah Produk Yang Ingin Dibeli!</p>
                </div>
                <div id="text-kuantitas-produk">
                    <input type="number" name="qty" class="qty" value="1" min="1" id="qty-{{ $p->pid }}">
                </div>
    
                <div id="container-total-produk">
                    <div id="sub-text">
                        <p id="subtotal-produk">SUB TOTAL:</p>
                    </div>
                    <div id="harga-total">
                        <input type="number" name="total_pembayaran" id="tot_bayar" class="total_pembayaran" x-text="formatRupiah(cartTotal)" value="" readonly>
                    </div>
                </div>
    
                <div id="btnAddCart" @click="addToCart('{{ $p->pid }}', '{{ $p->nama_produk }}', {{ $p->harga }}, $event)">
                    <div id="container-biodata">
                        <div class="biodata">
                            <span class="material-symbols-outlined">shopping_cart</span>
                        </div>
                        <div id="text-button">
                            <p>Tambah ke Keranjang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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
                <div class="cart-total">
                    Total Berat: <span x-text="totalWeight + ' gram'"></span> <!-- Tampilkan total berat -->
                </div>
                <input type="hidden" id="total-weight" x-model="totalWeight">
                
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
                <div id="container-ongkir">
                    <div id="ongkir">Biaya Ongkir: </div>
                    <div id="cost">Ongkir ?</div>
                </div>
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
                this.updateShippingCost(); // Hitung ongkos kirim saat inisialisasi
            },

            toggleCart() {
                this.cartVisible = !this.cartVisible;
            },

            addToCart(pid, nama_produk, harga, event) {
                let qtyElement = event.target.closest('#content').querySelector('.qty');
                let qty = parseInt(qtyElement.value, 10);
                let subTotal = qty * harga;
                let berat = parseFloat(event.target.closest('#content').querySelector('#berat').textContent);

                let product = this.cartItems.find(item => item.pid === pid);
                if (product) {
                    product.quantity += qty;
                    product.subTotal = product.quantity * product.harga;
                    product.totalWeight = product.quantity * product.berat;
                } else {
                    this.cartItems.push({
                        pid,
                        nama_produk,
                        harga,
                        quantity: qty,
                        subTotal: subTotal,
                        berat: berat,
                        totalWeight: qty * berat
                    });
                }

                this.updateCartTotal();
                this.updateTotalWeight();
                this.saveCartToLocalStorage();
                this.updateShippingCost();
            },

            removeFromCart(pid) {
                let productIndex = this.cartItems.findIndex(item => item.pid === pid);
                if (productIndex !== -1) {
                    this.cartItems.splice(productIndex, 1);
                }
                this.updateCartTotal();
                this.updateTotalWeight();
                this.saveCartToLocalStorage();
                this.updateShippingCost();
            },

            updateQuantity(pid, newQty) {
                let product = this.cartItems.find(item => item.pid === pid);
                if (product) {
                    product.quantity = newQty;
                    product.subTotal = product.quantity * product.harga;
                    product.totalWeight = product.quantity * product.berat;
                }
                this.updateCartTotal();
                this.updateTotalWeight();
                this.saveCartToLocalStorage();
                this.updateShippingCost();
            },

            updateCartTotal() {
                this.cartTotal = this.cartItems.reduce((total, item) => total + item.subTotal, 0);
                localStorage.setItem("cartTotal", this.cartTotal); // Simpan cartTotal
            },

            updateTotalWeight() {
                this.totalWeight = this.cartItems.reduce((total, item) => total + item.totalWeight, 0);
                localStorage.setItem("totalWeight", this.totalWeight); // Simpan totalWeight
            },

            saveCartToLocalStorage() {
                localStorage.setItem("cartItems", JSON.stringify(this.cartItems));
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

            increaseQuantity(pid) {
                let product = this.cartItems.find(item => item.pid === pid);
                if (product) {
                    product.quantity++;
                    product.subTotal = product.quantity * product.harga;
                    product.totalWeight = product.quantity * product.berat;
                }
                this.updateCartTotal();
                this.updateTotalWeight();
                this.saveCartToLocalStorage();
                this.updateShippingCost();
            },

            decreaseQuantity(pid) {
                let product = this.cartItems.find(item => item.pid === pid);
                if (product && product.quantity > 1) {
                    product.quantity--;
                    product.subTotal = product.quantity * product.harga;
                    product.totalWeight = product.quantity * product.berat;
                } else if (product && product.quantity === 1) {
                    this.removeFromCart(pid);
                }
                this.updateCartTotal();
                this.updateTotalWeight();
                this.saveCartToLocalStorage();
                this.updateShippingCost();
            },

            formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount).replace('IDR', '').trim();
            }
        };
    }
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
