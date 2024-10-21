@extends('halaman.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Section Title -->
<div class="section-title">
    <h2>Galeri Foto Kegiatan</h2>
</div>

<!-- Button to Add Image -->
<div class="add-photo-button my-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
        Tambah Foto Kegiatan
    </button>
</div>

<!-- Modal for Adding New Photo -->
<div class="modal fade" id="addPhotoModal" tabindex="-1" aria-labelledby="addPhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPhotoModalLabel">Upload Foto Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="photoForm" action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Pilih Gambar</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
                        <div id="imagePreview" class="mt-3"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Display Uploaded Images -->
<div class="photo-gallery mt-5">
    <div class="grid-gallery">
        @foreach ($kegiatan as $i)
            <div class="photo-card">
                <div class="photo-image">
                    <img src="{{ asset('storage/' . $i->image_path) }}" alt="Foto Kegiatan" class="img-fluid">
                </div>
                <div class="photo-details">
                    <button class="btn btn-warning btn-sm" onclick="editImage({{ $i->id }})">Edit</button>
                    <form action="{{ route('kegiatan.destroy', $i->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';
        const file = event.target.files[0];

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-fluid';
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
            imagePreview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });

    function editImage(imageId) {
        const newFileInput = document.createElement('input');
        newFileInput.type = 'file';
        newFileInput.accept = 'image/*';
        newFileInput.onchange = function(event) {
            const newFile = event.target.files[0];
            const formData = new FormData();
            formData.append('image', newFile);
            formData.append('_method', 'PUT'); // For Laravel PUT method

            const xhr = new XMLHttpRequest();
            xhr.open('POST', `/kegiatan/${imageId}`);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const imageElement = document.querySelector(`.photo-card img[data-id="${imageId}"]`);
                    imageElement.src = response.image_path;
                } else {
                    console.error('Error:', xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
            };
            xhr.send(formData);
        };
        newFileInput.click();
    }
</script>
@endsection
