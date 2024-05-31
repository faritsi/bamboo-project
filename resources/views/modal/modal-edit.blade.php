
@foreach ($produk as $p)
<div id="modalUpdate{{$p->id}}" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit Produk</h2>
        <form action="{{ route('produk.update', $p->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" value="{{ $p->judul }}" required>
            <label for="slug">Slug:</label>
            <input type="text" id="slug" name="slug" value="{{ $p->slug }}" required>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            <label for="deskripsi">Deskripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" value="{{ $p->deskripsi }}" required>
            <label for="tokped">Tokopedia:</label>
            <input type="text" id="tokped" name="tokped" value="{{ $p->tokped }}" required>
            <label for="shopee">Shopee:</label>
            <input type="text" id="shopee" name="shopee" value="{{ $p->shopee }}" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
@endforeach