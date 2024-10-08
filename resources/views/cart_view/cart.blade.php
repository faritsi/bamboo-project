@extends('produk_show.index')

@section('content')
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
@endsection