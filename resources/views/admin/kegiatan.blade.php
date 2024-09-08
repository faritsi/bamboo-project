@extends('halaman.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="btn-modal">
    <button type="button" id="addButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activityModal">
        Tambah Gambar Kegiatan
    </button>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activityModalLabel">Upload Gambar Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="activityForm" action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="images" class="form-label">Pilih Gambar (Max 9)</label>
                        <input class="form-control" type="file" id="images" name="images[]" accept="image/*" multiple required>
                        <div id="imagePreview" class="d-flex flex-wrap mt-3"></div>
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

<div id="container-img-preview">
    <h2>Gambar Kegiatan</h2>
    <div id="uploadedImages" class="flex-container">
        <div class="flex-row" id="row1">
            @foreach ($kegiatan as $i)
                <div class="image-container" data-id="{{ $i->id }}">
                    <img src="{{ asset('storage/' . $i->image_path) }}" class="preview-img">
                    <button class="btn btn-warning btn-sm btn-edit" onclick="editImage({{ $i->id }})">Edit</button>
                    <form action="{{ route('kegiatan.destroy', $i->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.getElementById('images').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';
        const files = event.target.files;

        if (files.length > 9) {
            alert('Maksimal 9 gambar.');
            this.value = ''; // Clear the input if more than 9 files are selected
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-img';
                imagePreview.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    });

    function editImage(imageId) {
        const newFileInput = document.createElement('input');
        newFileInput.type = 'file';
        newFileInput.accept = 'image/*';
        newFileInput.onchange = function(event) {
            const newFile = event.target.files[0];
            const formData = new FormData();
            formData.append('image', newFile);
            formData.append('_method', 'PUT'); // Add this line for Laravel PUT method

            const xhr = new XMLHttpRequest();
            xhr.open('POST', `/kegiatan/${imageId}`);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    // Update the image preview
                    const imageElement = document.querySelector(`.image-container[data-id="${imageId}"] img`);
                    imageElement.src = response.image_path;
                } else {
                    console.error('Error:', xhr.statusText);
                    // Handle error
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
                // Handle error
            };
            xhr.send(formData);
        };
        newFileInput.click();
    }
</script>
@endsection