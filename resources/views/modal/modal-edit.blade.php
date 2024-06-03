
@foreach ($produk as $p)
<div id="modalUpdate{{$p->pid}}" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit Produk</h2>
        <form action="{{ route('produk.update', $p->pid) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="text" id="pid" name="pid" value="{{ $p->pid }}" hidden>
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" value="{{ $p->judul }}" required>
            <label for="slug">Slug:</label>
            <input type="text" id="slug" name="slug" value="{{ $p->slug }}" required>
            @if ($p->image) 
                <img src="{{ asset('images/' . $p->image) }}" alt="" class="img-preview">
            @else            
                <img class="img-preview" style="display: block; max-width: 100px; height: auto;">
            @endif
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" onchange="previewImage()">
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
<script>
    function previewImage() {
        const image = document.querySelector("#image");
        const imgPreview = document.querySelector(".img-preview");

        imgPreview.style.display = "block";
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>