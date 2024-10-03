<!DOCTYPE html>
<html lang="en" x-data="cartData()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- LINK -->
    <link rel="stylesheet" href="{{ asset('css/style-all-produk.css') }}">
    <!-- Corrected script linking -->
    {{-- <script src="resources/js/script-all-produk.js"></script> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>

    <title>{{$title}}</title>
</head>
<body>
    <div id="background">
        <!-- TIPE PRODUK -->
        <div id="bg-container">
            <div id="container">
                <div id="tipe-produk" class="clearfix">
                    <div id="tipe-semua-produk" class="kategori" data-kategori_id="semua">
                        <h3>Semua</h3>
                    </div>
                    <div id="tipe-toples-produk" class="kategori" data-kategori_id="Awet">
                        <h3>Toples</h3>
                    </div>
                    <div id="tipe-layangan-produk" class="kategori" data-kategori_id="Keripik">
                        <h3>Layangan</h3>
                    </div>
                    <div id="tipe-miniatur-produk" class="kategori" data-kategori_id="miniatur">
                        <h3>Miniatur</h3>
                    </div>
                </div>
                
                <!-- Content Produk -->
                <div id="content-produk">
                    @foreach ($produk as $p)
                    <div id="card-container" class="content-produk" data-kategori_id="{{$p->kategori_id}}">
                        <a href="/produk/{{$p->pid}}">
                            <div id="card-produk">
                                <div id="card-stok">
                                    <p id="stok-produk">Stock : {{$p->jumlah_produk}}</p>
                                </div>
                                <div id="card-image">
                                    <img src="{{ asset('/storage/' . $p->image) }}" alt="Produk Image" id="image-produk">
                                </div>
                            </div>
                        </a>
                        <div id="card-text">
                            <h4 id="nama-produk">{{$p->nama_produk}}</h4>
                            <p id="harga-produk">{{$p->harga}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Button to Open Cart -->
                <button class="open-cart-btn" @click="toggleCart()"><span class="material-symbols-outlined">
                    shopping_cart
                    </span></button>

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

                <!-- Button Page -->
                <div id="container-page-button">
                    <div id="page-button">
                        1 2 3 4 5 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Script -->
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
<script>
    $(document).ready(function(){
        localStorage.clear();
        // Fungsi untuk menampilkan produk berdasarkan kategori_id
        function filterProduk(kategori_id) {
            if (kategori_id === "semua") {
                $(".content-produk").show(); // Tampilkan semua produk
            } else {
                $(".content-produk").hide(); // Sembunyikan semua produk
                $('.content-produk[data-kategori_id="'+kategori_id+'"]').show(); // Tampilkan produk berdasarkan kategori_id
            }
        }

        // Event listener untuk klik pada kategori
        $(".kategori").on("click", function(){
            var kategori_id = $(this).data("kategori_id");
            filterProduk(kategori_id);

            // Menambahkan kelas aktif pada kategori yang dipilih
            $(".kategori").removeClass("active");
            $(this).addClass("active");
        });

        // Inisialisasi: tampilkan semua produk pada load pertama
        filterProduk("semua");
    });
</script>
</html>
