<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product Page</title>
    <link rel="stylesheet" href="{{ asset('css/style-detail-produk.css') }}">
</head>

<body>
    <section class="detail-produk">
        <div class="container">
            <div class="produk-details">
                <div class="image">
                    <img src="{{ asset('img/junk.jpg') }}" alt="Product Image">
                    <div class="thumbnails">
                        <img src="{{ asset('img/junk.jpg') }}" alt="Thumbnail 1">
                        <img src="{{ asset('img/junk.jpg') }}" alt="Thumbnail 2">
                        <img src="{{ asset('img/junk.jpg') }}" alt="Thumbnail 3">
                    </div>
                </div>
                <div class="title">
                    <h1>Example Product Name</h1>
                </div>
                <div class="rating">
                    <p>Terjual 250+ ⭐ 4.9 (103 rating) • Diskusi (12)</p>
                </div>
                <div class="price">
                    <p>Rp.225.000</p>
                </div>
                <div class="description">
                    <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisiut aliquip.</p>
                </div>
                <div class="quantity">
                    <label for="quantity">Atur jumlah dan catatan</label>
                    <button>-</button>
                    <input type="number" id="quantity" value="2" min="1">
                    <button>+</button>
                    <p>Stock Total: 120</p>
                </div>
                <p>Subtotal: Rp.450.000</p>
                <button class="buy-button">Beli</button>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="product-details">
            <img src="{{ asset('img/junk.jpg') }}" alt="Product Image">
            <div class="thumbnails">
                <img src="{{ asset('img/junk.jpg') }}" alt="Thumbnail 1">
                <img src="{{ asset('img/junk.jpg') }}" alt="Thumbnail 2">
                <img src="{{ asset('img/junk.jpg') }}" alt="Thumbnail 3">
            </div>
            <h1>Example Product Name</h1>
            <p>Terjual 250+ ⭐ 4.9 (103 rating) • Diskusi (12)</p>
            <p class="price">Rp.225.000</p>
            <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                ut aliquip.</p>
            <div class="quantity">
                <label for="quantity">Atur jumlah dan catatan</label>
                <button>-</button>
                <input type="number" id="quantity" value="2" min="1">
                <button>+</button>
                <p>Stock Total: 120</p>
            </div>
            <p>Subtotal: Rp.450.000</p>
            <button class="buy-button">Beli</button>
        </div>
    </div>
</body>

</html>