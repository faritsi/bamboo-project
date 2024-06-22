<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard Admin</title>

        <!-- Link -->
        <link rel="stylesheet" href="/css/style-ds-kegiatan.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        />
    </head>
    <body>
        <div id="container">
            <!-- Sidebar -->
            <div id="bg-sidebar">
                <div id="bo-sidebar">
                    <aside id="sidebar">
                        <div id="sidebar-header">
                            <img
                                src="https://via.placeholder.com/800x600"
                                alt="Logo"
                            />
                            <h2>Dashboard BMK</h2>
                        </div>
                        <ul id="sidebar-links">
                            <h4>
                                <span>Main Menu</span>
                                <div id="menu-seperate"></div>
                            </h4>

                            <li>
                                <a href="{{ route('home') }}">
                                    <span class="material-symbols-outlined">
                                        dashboard </span
                                    >Dashboard
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <span class="material-symbols-outlined">
                                        monitoring </span
                                    >Analytic
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <span class="material-symbols-outlined">
                                        attach_money </span
                                    >Pembelian
                                </a>
                            </li>

                            <h4>
                                <span>General</span>
                                <div id="menu-seperate"></div>
                            </h4>

                            <li>
                                <a href="{{ route('admin') }}">
                                    <span class="material-symbols-outlined">
                                        manage_accounts </span
                                    >Admin
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('pimpinan') }}">
                                    <span class="material-symbols-outlined">
                                        groups </span
                                    >Pimpinan
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('produk') }}">
                                    <span class="material-symbols-outlined">
                                        inventory_2 </span
                                    >Produk
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('kegiatan') }}">
                                    <span class="material-symbols-outlined">
                                        image </span
                                    >Kegiatan
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('info-lainnya') }}">
                                    <span class="material-symbols-outlined">
                                        category </span
                                    >Footer
                                </a>
                            </li>
                        </ul>
                        <div id="logout">
                            <a href="#">
                                <span class="material-symbols-outlined">
                                    logout </span
                                >Logout
                            </a>
                        </div>
                    </aside>
                </div>
            </div>

            <!-- Header -->
            <div id="bg-header">
                <div id="bo-header">
                    <div id="header" class="clearfix">
                        <div id="judul-header">
                            <h2>Dashboard</h2>
                        </div>
                        <div id="user-account">
                            <div id="user-profile">
                                <img
                                    src="https://via.placeholder.com/800x600"
                                    alt="profile-img"
                                />
                                <div id="user-detail">
                                    <h3>Nama</h3>
                                    <span>Superadmin</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div id="bg-content">
                <div id="bo-content">
                    <div id="content">
                        <h2>Selamat Datang !</h2>
                        <h3>
                            Ini Adalah Halaman Dashboard Untuk Mengubah Data
                        </h3>

                        <!-- Isi Content -->
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
    </body>
</html>
