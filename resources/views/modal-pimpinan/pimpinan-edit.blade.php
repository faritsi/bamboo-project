
@foreach ($pimpinan as $u)
<div id="modalUpdate{{$u->ppid}}" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit Profil</h2>
        <form action="{{ route('pimpinan.update', $u->ppid) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @if ($errors->any())
            @foreach ($errors->all() as $err)
                <p class="hayo">{{ $err }}</p>
            @endforeach
            @endif
            <input type="text" id="ppid" name="ppid" value="{{$u->ppid}}" hidden>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{$u->name}}" required>
            <label for="username">Jabatan:</label>
            <input type="text" id="jabatan" name="jabatan" value="{{$u->jabatan}}" required>
            <label for="username">deskripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" value="{{$u->deskripsi}}" required>
            <label for="username">image:</label>
            {{-- <input type="file" id="image" name="image" value="{{ asset('images/' . $u->image) }}"> --}}
            <div class="form-group">
                @if ($u->image)
                    <img src="{{ asset('images/' . $u->image) }}">
                @else
                        <p>No image found</p>
                @endif
                    image <input type="file" name="image" value="{{ $u->image }}"/>
            </div>
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