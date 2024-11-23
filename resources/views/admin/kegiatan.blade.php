@extends('halaman.admin')
@section('content')
    <link rel="stylesheet" href="/css/style-ds-kegiatan.css" />

    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->


    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("myModal").style.display = "block";
            });
        </script>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Section Title -->
    {{-- <div class="section-title">
    <h2>Galeri Foto Kegiatan</h2>
</div> --}}
    <div class="judul-halaman">
        <h2>Foto Kegiatan</h2>
    </div>

    <!-- Button to Add Image -->
    {{-- <div class="add-photo-button    ">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
        Tambah Foto Kegiatan
    </button>
</div> --}}

    <div class="bg-tambah-photo-kegiatan" id="myBtn">
        <div id="bo-tambah-photo-kegiatan">
            <div class="icon-tambah-photo">
                <span class="material-symbols-outlined">
                    add
                </span>
            </div>
            <div id="text-kegiatan">
                <strong>Foto Kegiatan</strong>
            </div>
        </div>
    </div>

    <!-- Modal for Adding New Photo -->
    {{-- <div class="modal fade" id="addPhotoModal" tabindex="-1" aria-labelledby="addPhotoModalLabel" aria-hidden="true">
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
                        <input class="form-control" type="file" id="image" name="images[]" accept="image/*" multiple required>
                        <div id="imagePreview" class="mt-3"></div>
                    </div>
                    <div class="mb-3">
                        <label for="video_path" class="form-label">Link Video</label>
                        <input class="form-control" type="url" id="video_path" name="video_path" placeholder="https://youtube.com/your-video-link">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

    {{-- Add Kegiatan --}}
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="head-modul">
                    <h1>Tambah Photo Kegiatan</h1>
                </div>
                <div class="thumbnail">
                    <img id="thumbnail-preview" src="https://via.placeholder.com/100" alt="Thumbnail"
                        style="display: block; margin-bottom: 10px; max-width: 100px;">
                    <input type="file" id="thumbnail" name="image[]" onchange="previewImage(this, 'thumbnail-preview')"
                        multiple>
                    @if ($errors->has('image'))
                        <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Kegiatan --}}
    @foreach ($kegiatan as $i)
        <div id="editModal-{{ $i->id }}" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form action="{{ route('kegiatan.updateImage', $i->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div id="head-modul">
                        <h1>Edit Photo Kegiatan</h1>
                    </div>
                    <input type="hidden" id="edit-id-{{ $i->id }}" name="id" value="{{ $i->id }}">
                    <div class="thumbnail">
                        <img id="edit-thumbnail-preview-{{ $i->id }}"
                            src="{{ $i->image_path ? asset('/storage/' . $i->image_path) : 'https://via.placeholder.com/100' }}"
                            alt="Thumbnail" style="display: block; margin-bottom: 10px; max-width: 100px;">
                        <input type="file" id="edit-thumbnail-{{ $i->id }}" name="image"
                            onchange="previewImage(this, 'edit-thumbnail-preview-{{ $i->id }}')">
                        @if ($errors->has('image'))
                            <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- Delete Kegiatan --}}
    @foreach ($kegiatan as $i)
        <div id="deleteModal-{{ $i->id }}" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Konfirmasi Hapus</h1>
                <p>Apakah Anda yakin ingin menghapus foto kegiatan ini?</p>
                <form action="{{ route('kegiatan.destroyImage', $i->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <button type="submit" class="submit-btn">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach


    {{-- <div class="photo-gallery mt-5">
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
</div> --}}

    {{-- Display Photo Kegiatan --}}
    <div class="container-photo">
        <div class="card-photo">
            @foreach ($kegiatan as $i)
                <div class="photo-card">
                    <img src="{{ asset('/storage/' . $i->image_path) }}" alt="Photo Kegiatan" class="photo-image">
                    <div class="photo-overlay">
                        <button class="btn-edit" data-id="{{ $i->id }}" data-toggle="modal"
                            data-target="#editModal-{{ $i->id }}">
                            <!-- <button class="btn-edit"> -->
                            <span class="material-symbols-outlined">
                                edit
                            </span>
                        </button>
                        <button class="btn-delete" data-id="{{ $i->id }}" data-toggle="modal"
                            data-target="#deleteModal-{{ $i->id }}">
                            <span class="material-symbols-outlined">
                                delete
                            </span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="judul-halaman">
        <h2>Video Kegiatan</h2>
    </div>

    <div class="bg-tambah-video-kegiatan" id="myBtnVideo">
        <div id="bo-tambah-video-kegiatan">
            <div class="icon-tambah-video">
                <span class="material-symbols-outlined">
                    add
                </span>
            </div>
            <div id="text-video">
                <strong>Video Kegiatan</strong>
            </div>
        </div>
    </div>

    <div id="video-container">
        @foreach ($video as $v)
            <div class="wrapper-video">
                @if ($v->video_path)
                    <iframe src="{{ asset('/storage/' . $v->video_path) }}" title="Company Video"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen auto></iframe>
                @endif
                @if ($v->video_link)
                    <iframe src="{{ $v->video_link }}" title="Company Video"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                @endif
                <div class="video-overlay">
                    <button class="btn-edit-video" data-id="{{ $v->id }}" data-toggle="modal"
                        data-target="#editModal-{{ $v->id }}">
                        <span class="material-symbols-outlined">
                            edit
                        </span>
                    </button>
                    <button class="btn-delete-video" data-id="{{ $v->id }}" data-toggle="modal"
                        data-target="#deleteModal-{{ $v->id }}">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Add Video --}}
    <div id="myModalVideo" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="head-modul">
                    <h1>Tambah Video Kegiatan</h1>
                </div>
                {{-- <div class="thumbnail">
            <img id="thumbnail-preview" src="https://via.placeholder.com/100" alt="Thumbnail" style="display: block; margin-bottom: 10px; max-width: 100px;">
            <textarea id="thumbnail" name="image[]" onchange="previewImage(this, 'thumbnail-preview')"> </textarea>
            @if ($errors->has('image'))
                <p class="alert alert-danger">{{ $errors->first('image') }}</p>
            @endif
            </div> --}}
                <div id="co-title">
                    <h2>Pilih Salah Satu</h2>
                    <hr>
                </div>
                <div class="form-group">
                    <label for="image_produk">Link Youtube</label>
                    <textarea id="video_link" name="video_link"></textarea>
                </div>
                <div class="form-group">
                    <label for="video_path">Unggah Video</label>
                    <input type="file" id="video_path" name="video_path" accept="video/*">
                </div>
                <div class="form-group">
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Video --}}
    @foreach ($video as $v)
        <div id="editModalVideo-{{ $v->id }}" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form action="{{ route('kegiatan.updateVideo', $v->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div id="head-modul">
                        <h1>Edit Video Kegiatan</h1>
                    </div>
                    <div class="form-group">
                        <label for="image_produk">Link Youtube</label>
                        <textarea id="video_link" name="video_link"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_produk">Upload Video</label>
                        <input type="file" id="video_path" name="video_path" accept="video/*">
                    </div>
                    {{-- </div> --}}
                    <div class="form-group">
                        <button type="submit" class="submit-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- Delete Kegiatan & BUAT MODEL BUAT NYIMPEN LINK --}}
    @foreach ($video as $v)
        <div id="deleteModalVideo-{{ $v->id }}" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Konfirmasi Hapus</h1>
                <p>Apakah Anda yakin ingin menghapus video kegiatan ini?</p>
                <form action="{{ route('kegiatan.destroyVideo', $v->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <button type="submit" class="submit-btn">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <script>
        $(document).ready(function() {
            // Menampilkan dan menyembunyikan modal
            function showModal(modalId) {
                $(modalId).show();
            }

            function showVideoKegiatan(modalId) {
                $(modalId).show();
            }

            function hideModals() {
                $(".modal").hide();
            }
            // Tambah Keegitan
            $("#myBtn").on("click", function() {
                showModal("#myModal");
            });

            $(".btn-edit").on("click", function() {
                var ppid = $(this).data('id');
                showModal("#editModal-" + ppid);
            });

            $(".btn-delete").on("click", function() {
                var ppid = $(this).data('id');
                showModal("#deleteModal-" + ppid);
            });

            // Tambah Video
            $("#myBtnVideo").on("click", function() {
                showVideoKegiatan("#myModalVideo");
            });

            $(".btn-edit-video").on("click", function() {
                var ppid = $(this).data('id');
                showModal("#editModalVideo-" + ppid);
            });

            $(".btn-delete-video").on("click", function() {
                var ppid = $(this).data('id');
                showModal("#deleteModalVideo-" + ppid);
            });

            $(".close").on("click", function() {
                hideModals();
            });

            $(window).on("click", function(event) {
                if ($(event.target).hasClass("modal")) {
                    hideModals();
                }
            });
        });

        // Pratinjau Gambar
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "https://via.placeholder.com/100"; // Placeholder jika gambar dihapus
            }
        }
    </script>
@endsection
