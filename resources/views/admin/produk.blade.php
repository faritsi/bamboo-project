@extends('halaman.admin')
@section('content')


<link rel="stylesheet" href="/css/style-ds-produk.css" />
<link rel="stylesheet" href="/css/style-tabel-produk.css" />

<div id="buttonInKategori">
    <div id="myKegiatan" class="bg-tambah-data-kategori">
        <div id="bo-tambah-data-kategori">
            <div class="icon-tambah-data-kategori">
                <span class="material-symbols-outlined">add</span>                                                        
            </div>
            <div id="text-kategori">
                <p>Kategori</p>
            </div>
        </div>
    </div>
    <div id="myBtn" class="bg-tambah-data-produk">
        <div id="bo-tambah-data-produk">
            <div class="icon-tambah-data-produk">
                <span class="material-symbols-outlined">add</span>                                                        
            </div>
            <div id="text-produk">
                <p>Produk</p>
            </div>
        </div>
    </div>
</div>

@if ($errors->has('name'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("myActivity").style.display = "block";
        });
    </script>
@elseif ($errors->has('kode_produk') || $errors->has('nama_produk'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("myModal").style.display = "block";
        });
    </script>
@endif


@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("myModal").style.display = "none";
            document.getElementById("myActivity").style.display = "none";
        });
    </script>
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div id="bg-isi-content-produk">
    <div id="bo-isi-content-produk">
        <div id="table-produk">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Berat (g)</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $index => $p)
                    <tr>
                        <td>
                            <div class="btn-details-produk">
                                <span class="material-symbols-outlined">
                                add
                                </span>                                                        
                            </div>
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->nama_produk }}</td>
                        <td>{{ $p->jumlah_produk }}</td>
                        <td>{{ $p->berat }}</td>
                        <td>{{$p->harga}}</td>
                        <td>
                            <div id="btn-cfg-produk">
                                <div class="btn-edit" data-id="{{ $p->pid }}" data-toggle="modal" data-target="#editModal-{{ $p->pid }}">
                                    <span class="material-symbols-outlined">
                                    edit
                                    </span>                                                       
                                </div>
                                <div class="btn-delete" data-id="{{ $p->pid }}" data-toggle="modal" data-target="#deleteModal-{{ $p->pid }}">
                                    <span class="material-symbols-outlined">
                                    delete
                                    </span>                                                       
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="details-row-produk">
                        <td colspan="7">
                            @if ($p->image)
                            <img src="{{asset('/storage/' .$p->image)}}" alt="Image Produk" id="avatar-produk">
                            @else
                            <img src="/img/default-img/default.png" alt="" id="avatar-produk">
                            @endif
                            <div><strong>Kategori Produk: </strong> {{ $p->kategori->name}}</div>
                            <div><strong>Kode Produk: </strong> {{ $p->kode_produk}}</div>
                            <div><strong>Nama Produk: </strong> {{ $p->nama_produk }}</div>
                            <div><strong>Stok: </strong> {{ $p->jumlah_produk}}</div>
                            <div><strong>Berat: </strong> {{ $p->berat}}</div>
                            <div><strong>Harga: </strong> {{ $p->harga}}</div>
                            <div><strong>Deskripsi: </strong> <span class="desc-limit">{{ $p->deskripsi}}</span></div>
                            <div><strong>Link Tokopedia: </strong> {{ $p->tokped}}</div>
                            <div><strong>Link Shoppee: </strong> {{ $p->shopee}}</div>
                            <div id="btn-cfg-detail">
                                <div class="btn-edit" data-id="{{ $p->pid }}" data-toggle="modal" data-target="#editModal-{{ $p->pid }}">
                                    <span class="material-symbols-outlined">
                                    edit
                                    </span>
                                    <p id="edit-text">Edit</p>                                                       
                                </div>
                                <div class="btn-delete" data-id="{{ $p->pid }}" data-toggle="modal" data-target="#deleteModal-{{ $p->pid }}">
                                    <span class="material-symbols-outlined">
                                    delete
                                    </span>    
                                    <p id="delete-text">Delete</p>                                                   
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-section">
                <div class="pagination-links">
                    <a href="{{ $produkPreviousPageUrl }}" class="page-link">&#10094;</a>
                    <!-- First Page Link -->
                    @if ($produkCurrentPage > 5)
                        <a href="{{ $produkFirstPageUrl }}" class="page-link">1</a>
                        <span class="page-link">...</span>
                    @endif
            
                    <!-- Previous Pages -->
                    @foreach ($produk->getUrlRange(max(1, $produkCurrentPage - 4), min($produkTotalPages, $produkCurrentPage + 2)) as $page => $url)
                        <a href="{{ $url }}" class="page-link {{ $page == $produkCurrentPage ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach
            
                    <!-- Next Pages -->
                    @if ($produkCurrentPage < $produkTotalPages - 3)
                        <span class="page-link">...</span>
                        <a href="{{ $produkLastPageUrl }}" class="page-link">{{ $produkTotalPages }}</a>
                    @endif
                    <a href="{{ $produkNextPageUrl }}" class="page-link">&#10095;</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal kategori --}}
<div id="myActivity" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div id="head-modul">
                <h1>Tambah Kategori</h1>
            </div>
            <div class="form-group">
                <label for="name">Nama Kategori Baru <span class="required">*</span></label>
                <input type="text" id="name" name="name" placeholder="Masukkan Nama Kategori Baru" value="{{ old('name') }}" class="capitalize-input">
                @if ($errors->has('name'))
                    <p class="alert-modal alert-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

{{-- ADD --}}
<div id="myModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="head-modul">
                <h1>Tambah Produk</h1>
            </div>
            <div id="text-thumbnail">
                <label for="image_produk">Thumbnail Produk <span class="required">*</span></label>
            </div>

            <div class="thumbnail">
                <img id="thumbnail-preview" src="https://via.placeholder.com/100" alt="Thumbnail">
                <input type="file" id="thumbnail" name="image">
                @if ($errors->has('image'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image_produk">Gambar Produk 1</label>
                <input type="file" id="image1" name="image1">
                @if ($errors->has('image1'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image1') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image_produk">Gambar Produk 2</label>
                <input type="file" id="image2" name="image2">
                @if ($errors->has('image2'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image2') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image_produk">Gambar Produk 3</label>
                <input type="file" id="image3" name="image3">
                @if ($errors->has('image3'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image3') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image_produk">Gambar Produk 4</label>
                <input type="file" id="image4" name="image4">
                @if ($errors->has('image4'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image4') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="kode_produk">Kode Produk <span class="required">*</span></label>
                <input type="text" id="kode_produk" name="kode_produk" placeholder="EXP-021" value="{{ old('kode_produk') }}">
                @if ($errors->has('kode_produk'))
                    <p class="alert-modal alert-danger">{{ $errors->first('kode_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="nama_produk">Nama Produk <span class="required">*</span></label>
                <textarea id="nama_produk" name="nama_produk" placeholder="Masukan Nama Produk" value="{{ old('nama_produk') }}"></textarea>
                @if ($errors->has('nama_produk'))
                    <p class="alert-modal alert-danger">{{ $errors->first('nama_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori <span class="required">*</span></label>
                <select id="kategori_id" name="kategori_id" class="form-control scrollable-dropdown">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($kategori as $p)
                    <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="jumlah_produk">Jumlah Produk <span class="required">*</span></label>
                <input type="number" id="jumlah_produk" name="jumlah_produk" placeholder="Masukan jumlah produk" value="{{ old('jumlah_produk') }}">
                @if ($errors->has('jumlah_produk'))
                    <p class="alert-modal alert-danger">{{ $errors->first('jumlah_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk <span class="required">*</span></label>
                <textarea id="deskripsi" name="deskripsi" placeholder="Masukan deskripsi produk" value="{{ old('deskripsi') }}" maxlength="2000"></textarea>
                @if ($errors->has('deskripsi'))
                <p class="alert-modal alert-danger">{{ $errors->first('deskripsi') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="tokped">Link Tokopedia <span class="required">*</span></label>
                <textarea id="tokped" name="tokped" placeholder="Masukan link tokped" value="{{ old('tokped') }}"></textarea>
                @if ($errors->has('tokped'))
                    <p class="alert-modal alert-danger">{{ $errors->first('tokped') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="shopee">Link Shopee <span class="required">*</span></label>
                <textarea id="shopee" name="shopee" placeholder="Masukan link shopee" value="{{ old('shopee') }}"></textarea>
                @if ($errors->has('shopee'))
                    <p class="alert-modal alert-danger">{{ $errors->first('shopee') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="harga">Harga Produk <span class="required">*</span></label>
                <input type="number" id="harga" name="harga" placeholder="Rp. 9000" value="{{ old('harga') }}">
                @if ($errors->has('harga'))
                    <p class="alert-modal alert-danger">{{ $errors->first('harga') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="berat">Berat Produk (g) <span class="required">*</span></label>
                <input type="number" id="berat" name="berat" placeholder="1" value="{{ old('berat') }}">
                @if ($errors->has('berat'))
                    <p class="alert-modal alert-danger">{{ $errors->first('berat') }}</p>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT --}}
<!-- Edit Modals -->
@foreach ($produk as $p)
<div id="editModal-{{ $p->pid }}" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('produk.update', $p->pid) }}" method="POST" enctype="multipart/form-data" id="categoryForm">
            @csrf
            @method('PUT')
            <div id="head-modul">
                <h1>Edit Produk</h1>
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image">
                @if ($errors->has('image'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image1 }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image1) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image1">
                @if ($errors->has('image1'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image1') }}</p>
                @endif
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image2 }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image2) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image2">
                @if ($errors->has('image2'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image2') }}</p>
                @endif
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image3 }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image3) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image3">
                @if ($errors->has('image3'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image3') }}</p>
                @endif
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image4 }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image4) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image4">
                @if ($errors->has('image4'))
                    <p class="alert-modal alert-danger">{{ $errors->first('image4') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="kode_produk-{{ $p->pid }}">Kode Produk <span class="required">*</span></label>
                <input type="text" id="kode_produk-{{ $p->pid }}" name="kode_produk" placeholder="Masukan Nama" value="{{ old('kode_produk', $p->kode_produk) }}">
                @if ($errors->has('kode_produk'))
                    <p class="alert-modal alert-danger">{{ $errors->first('kode_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="nama_produk-{{ $p->pid }}">Nama Produk <span class="required">*</span></label>
                <input type="text" id="nama_produk-{{ $p->pid }}" name="nama_produk" placeholder="Masukan Nama" value="{{ old('nama_produk', $p->nama_produk) }}">
                @if ($errors->has('nama_produk'))
                    <p class="alert-modal alert-danger">{{ $errors->first('nama_produk') }}</p>
                @endif
            </div>
            <!-- Kategori Dropdown -->
            <div class="form-group">
                <label for="kategori_id-{{ $p->pid }}">Kategori <span class="required">*</span></label>
                <select id="kategori_id-{{ $p->pid }}" name="kategori_id" class="form-control">
                    @foreach ($kategori as $kategoriItem)
                        <option value="{{ $kategoriItem->id }}" {{ $kategoriItem->id == $p->kategori_id ? 'selected' : '' }}>{{ $kategoriItem->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('kategori_id'))
                    <p class="alert-modal alert-danger">{{ $errors->first('kategori_id') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="jumlah_produk-{{ $p->pid }}">Jumlah Produk <span class="required">*</span></label>
                <input type="text" id="jumlah_produk-{{ $p->pid }}" name="jumlah_produk" placeholder="Masukan jumlah_produk" value="{{ old('jumlah_produk', $p->jumlah_produk) }}">
                @if ($errors->has('jumlah_produk'))
                    <p class="alert-modal alert-danger">{{ $errors->first('jumlah_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="deskripsi-{{ $p->pid }}">Deskripsi Produk <span class="required">*</span></label>
                <textarea id="deskripsi-{{ $p->pid }}" name="deskripsi" placeholder="Masukan Pengalaman">{{$p->deskripsi}}</textarea>
                @if ($errors->has('deskripsi'))
                <p class="alert-modal alert-danger">{{ $errors->first('deskripsi') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="tokped-{{ $p->pid }}">Link Tokopedia <span class="required">*</span></label>
                <textarea id="tokped-{{ $p->pid }}" name="tokped" placeholder="Masukan tokped">{{$p->tokped}}</textarea>
                @if ($errors->has('tokped'))
                    <p class="alert-modal alert-danger">{{ $errors->first('tokped') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="shopee-{{ $p->pid }}">Link Shopee <span class="required">*</span></label>
                <textarea id="shopee-{{ $p->pid }}" name="shopee" placeholder="Masukan shopee">{{$p->shopee}}</textarea>
                @if ($errors->has('shopee'))
                    <p class="alert-modal alert-danger">{{ $errors->first('shopee') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="harga-{{ $p->pid }}">Harga Produk <span class="required">*</span></label>
                <input type="text" id="harga-{{ $p->pid }}" name="harga" placeholder="Masukan harga" value="{{ old('harga', $p->harga) }}">
                @if ($errors->has('harga'))
                    <p class="alert-modal alert-danger">{{ $errors->first('harga') }}</p>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Delete Modal -->
@foreach ($produk as $p)
<div id="deleteModal-{{ $p->pid }}" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('produk.destroy', $p->pid) }}" method="POST">
            @csrf
            @method('DELETE')
            <div id="head-modul">
                <h1>Delete Produk</h1>
            </div>
            <p>Are you sure you want to delete {{ $p->nama_produk }}?</p>
            <div class="form-group">
                <button type="submit" class="submit-btn">Delete</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>

    document.addEventListener('DOMContentLoaded', function () {
        // Select all inputs with the class 'capitalize-input'
        const capitalizeInputs = document.querySelectorAll('.capitalize-input');
        
        // Add an event listener to each input
        capitalizeInputs.forEach(input => {
            input.addEventListener('input', function () {
                // Only capitalize if the field is not empty
                if (input.value.length > 0) {
                    input.value = input.value
                        .charAt(0)
                        .toUpperCase() + input.value.slice(1);
                }
            });
        });
    });

    $(document).ready(function () {
        $(".btn-details-produk").on("click", function () {
            var row = $(this).closest("tr").next(".details-row-produk");
            row.toggle();
            var icon = $(this).find(".material-symbols-outlined");
            if (row.is(":visible")) {
                icon.text("remove");
                $(this).addClass("red");
            } else {
                icon.text("add");
                $(this).removeClass("red");
            }
        });

        function showModal(modalId) {
            $(modalId).show();
        }
        
        function showKegiatan(modalId) {
            $(modalId).show();
        }

        function hideModals() {
            $(".modal").hide();
        }
        // Tambah Produk
        $("#myBtn").on("click", function () {
            showModal("#myModal");
        });
        // Tambah Kegiatan
        $("#myKegiatan").on("click", function () {
            showKegiatan("#myActivity");
        });

        $(".close").on("click", function () {
            hideModals();
        });

        $(window).on("click", function (event) {
            if ($(event.target).hasClass("modal")) {
                hideModals();
            }
        });

        $('.thumbnail').on('click', function() {
            $(this).find('input[type="file"]').click();
        });

        $('input[type="file"]').on('change', function(event) {
            var reader = new FileReader();
            var preview = $(this).siblings('img');
            reader.onload = function() {
                preview.attr('src', reader.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        $(".btn-edit").on("click", function () {
            var ppid = $(this).data('id');
            showModal("#editModal-" + ppid);
        });

        $(".btn-delete").on("click", function () {
            var ppid = $(this).data('id');
            showModal("#deleteModal-" + ppid);
        });
        
        $(".dropdown").on("click", function() {
            $(this).find(".dropdown-content").toggle();
        });

        $(window).on("click", function(event) {
            if (!$(event.target).closest(".dropdown").length) {
                $(".dropdown-content").hide();
            }
        });

        @foreach ($produk as $p)
            // Set the dropdown button text based on the hidden input value on page load
            var existingValue = $("#jenis_produk-{{ $p->pid }}").val();
            if (existingValue) {
                $("#dropdownButton-{{ $p->pid }}").text(existingValue);
            }

            // Toggle dropdown menu visibility
            $("#dropdownButton-{{ $p->pid }}").on("click", function(event) {
                event.preventDefault();
                $("#dropdownMenu-{{ $p->pid }}").toggleClass("show");
            });

            // Handle click event on dropdown menu items
            $("#dropdownMenu-{{ $p->pid }} a").on("click", function(event) {
                event.preventDefault();
                var selectedCategory = $(this).data('value');
                $("#dropdownButton-{{ $p->pid }}").text(selectedCategory); // Update dropdown button text
                $("#dropdownMenu-{{ $p->pid }}").removeClass("show"); // Hide dropdown menu
                $("#jenis_produk-{{ $p->pid }}").val(selectedCategory); // Update hidden input value
            });

            // Close the dropdown if the user clicks outside of it
            $(window).on("click", function(event) {
                if (!event.target.matches('#dropdownButton-{{ $p->pid }}')) {
                    $("#dropdownMenu-{{ $p->pid }}").removeClass("show");
                }
            });
        @endforeach
        $(document).ready(function() {
        // Tampilkan dropdown
            $("#dropdownButton").on("click", function(event) {
                event.preventDefault();
                $("#dropdownMenu").toggleClass("show");
            });

            // Pilih kategori dan simpan ke input tersembunyi
            $("#dropdownMenu a").on("click", function(event) {
                event.preventDefault();
                var selectedCategory = $(this).data('value');
                $("#dropdownButton").text(selectedCategory); // Ubah teks tombol dropdown
                $("#dropdownMenu").removeClass("show"); // Sembunyikan menu dropdown
                $("input[name='kategori']").val(selectedCategory); // Simpan nilai ke input tersembunyi
            });

            // Tutup dropdown jika klik di luar
            $(window).on("click", function(event) {
                if (!event.target.matches('#dropdownButton')) {
                    $("#dropdownMenu").removeClass("show");
                }
            });
        });

        // Adjust Table 
        function updateColspan() {
            const detailsCells = document.querySelectorAll('.details-row-produk td'); // Select all matching elements
            detailsCells.forEach(detailsCell => {
                if (window.innerWidth <= 576) {
                    detailsCell.setAttribute('colspan', '4');
                } else if (window.innerWidth <= 768) {
                    detailsCell.setAttribute('colspan', '6');
                } else {
                    detailsCell.setAttribute('colspan', '7'); // Default colspan for larger screens
                }
            });
        }

        // Run on initial load
        updateColspan();

        // Add an event listener for window resizing
        window.addEventListener('resize', updateColspan);
    });
</script>

@endsection