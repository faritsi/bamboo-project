@extends('halaman.admin')
@section('content')
<div id="btn-modal">
    <button type="button" id="addButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activityModal">
        Tambah Gambar Kegiatan
    </button>
</div>
<div id="modal">
    <div id="modal-dialog">
        <div id="modal-content">
            <div id="modal-header">
                <h5 class="modal-title" id="activityModalLabel">Upload Gambar Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="activityForm">
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
        <div class="flex-row" id="row1"></div>
        <div class="flex-row" id="row2"></div>
        <div class="flex-row" id="row3"></div>
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

    document.getElementById('activityForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        const uploadedImages = document.getElementById('uploadedImages');
        const addButton = document.getElementById('addButton');

        // Add images to the appropriate rows in the uploadedImages div
        const files = document.getElementById('images').files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'image-container';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-img';
                imgContainer.appendChild(img);

                // Add edit and delete buttons
                const btnEdit = document.createElement('button');
                btnEdit.className = 'btn btn-warning btn-sm btn-edit';
                btnEdit.innerText = 'Edit';
                btnEdit.onclick = function() {
                    // Handle edit image
                    const newFileInput = document.createElement('input');
                    newFileInput.type = 'file';
                    newFileInput.accept = 'image/*';
                    newFileInput.onchange = function(event) {
                        const newFile = event.target.files[0];
                        const newReader = new FileReader();
                        newReader.onload = function(e) {
                            img.src = e.target.result;
                        };
                        newReader.readAsDataURL(newFile);
                    };
                    newFileInput.click();
                };

                const btnDelete = document.createElement('button');
                btnDelete.className = 'btn btn-danger btn-sm btn-delete';
                btnDelete.innerText = 'Delete';
                btnDelete.onclick = function() {
                    imgContainer.remove();
                    checkImageCount();
                };

                imgContainer.appendChild(btnEdit);
                imgContainer.appendChild(btnDelete);

                // Append to the correct row
                if (document.getElementById('row1').childElementCount < 2) {
                    document.getElementById('row1').appendChild(imgContainer);
                } else if (document.getElementById('row2').childElementCount < 3) {
                    document.getElementById('row2').appendChild(imgContainer);
                } else if (document.getElementById('row3').childElementCount < 4) {
                    document.getElementById('row3').appendChild(imgContainer);
                }

                // Check image count to disable add button if needed
                checkImageCount();
            };

            reader.readAsDataURL(file);
        }

        // Close the modal
        document.querySelector('.btn-close').click();

        // Clear the form
        document.getElementById('activityForm').reset();
        document.getElementById('imagePreview').innerHTML = '';
    });

    function checkImageCount() {
        const uploadedImages = document.getElementById('uploadedImages');
        const addButton = document.getElementById('addButton');
        const imageCount = uploadedImages.getElementsByClassName('image-container').length;

        if (imageCount >= 9) {
            addButton.disabled = true;
        } else {
            addButton.disabled = false;
        }
    }
</script>
@endsection