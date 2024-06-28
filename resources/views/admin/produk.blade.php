@extends('halaman.admin')
@section('content')
<div id="myBtn" class="bg-tambah-data">
    <div id="bo-tambah-data">
        <div class="icon-tambah-data">
            <span class="material-symbols-outlined">add</span>                                                        
        </div>
        <div id="text">
            <strong>Produk</strong>
        </div>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("myModal").style.display = "block";
    });
</script>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div id="bg-isi-content" class="clearfix">
    <div id="bo-isi-content">
        {{-- Table --}}
        <div id="table-produk">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Produk</th>
                        <th colspan="2">Link Produk</th>
                        <th rowspan="2"></th>
                    </tr>
                    <tr>
                        <th>Tokopedia</th>
                        <th>Shopee</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $index => $p)
                    <tr>
                        <td>
                            <div class="btn-details">
                                <span class="material-symbols-outlined">add</span>                                                  
                            </div>
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->nama_produk }}</td>
                        <td>{{ $p->tokped }}</td>
                        <td>{{ $p->shopee }}</td>
                        <td>
                            <div id="btn-cfg">
                                <div class="btn-edit" data-id="{{ $p->pid }}">
                                    <span class="material-symbols-outlined">edit</span>                                                       
                                </div>
                                <div class="btn-delete" data-id="{{ $p->pid }}">
                                    <span class="material-symbols-outlined">delete</span>                                                       
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="details-row" style="display: none;">
                        <td colspan="6">
                            @if ($p->image)
                                <img src="{{ asset('/storage/' . $p->image) }}" alt="" id="avatar-profile">
                            @else
                                <img src="/img/default-img/default.png" alt="" id="avatar-profile">
                            @endif
                            <div><strong>Kode Produk: </strong> {{ $p->kode_produk }}</div>
                            <div><strong>Nama Produk: </strong> {{ $p->nama_produk }}</div>
                            <div><strong>Jenis Produk: </strong> {{ $p->jenis_produk }}</div>
                            <div><strong>Jumlah Produk: </strong>{{ $p->jumlah_produk }}</div>
                            <div><strong>Harga: </strong> {{ $p->harga }}</div>
                            <div><strong>Deskripsi: </strong> {{ $p->deskripsi }}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
            <div class="thumbnail">
                <img id="thumbnail-preview" src="https://via.placeholder.com/100" alt="Thumbnail">
                <input type="file" id="thumbnail" name="image">
                @if ($errors->has('image'))
                    <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="kode_produk">Kode Produk <span class="required">*</span></label>
                <input type="text" id="kode_produk" name="kode_produk" placeholder="EXP-021" value="{{ old('kode_produk') }}">
                @if ($errors->has('kode_produk'))
                    <p class="alert alert-danger">{{ $errors->first('kode_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="nama_produk">Nama Produk <span class="required">*</span></label>
                <input type="text" id="nama_produk" name="nama_produk" placeholder="Masukan Nama Produk" value="{{ old('nama_produk') }}">
                @if ($errors->has('nama_produk'))
                    <p class="alert alert-danger">{{ $errors->first('nama_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="kategori">Kategori <span class="required">*</span></label>
                <div class="dropdown">
                    <button class="dropbtn" type="button" onclick="toggleDropdown()" id="dropdownButton">Pilih Kategori</button>
                    <div class="dropdown-content" id="dropdownMenu">
                        <a href="#" data-value="Kategori 1">Kategori 1</a>
                        <a href="#" data-value="Kategori 2">Kategori 2</a>
                        <a href="#" data-value="Kategori 3">Kategori 3</a>
                    </div>
                </div>
                <input type="hidden" name="jenis_produk" id="jenis_produk"> 

                @if ($errors->has('jenis_produk'))
                    <p class="alert alert-danger">{{ $errors->first('jenis_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="jumlah_produk">Jumalh Produk <span class="required">*</span></label>
                <input type="text" id="jumlah_produk" name="jumlah_produk" placeholder="Masukan jumlah produk" value="{{ old('jumlah_produk') }}">
                @if ($errors->has('jumlah_produk'))
                    <p class="alert alert-danger">{{ $errors->first('jumlah_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Produk <span class="required">*</span></label>
                <input type="text" id="deskripsi" name="deskripsi" placeholder="Masukan deskripsi produk" value="{{ old('deskripsi') }}">
                @if ($errors->has('deskripsi'))
                <p class="alert alert-danger">{{ $errors->first('deskripsi') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="tokped">Link Tokopedia <span class="required">*</span></label>
                <input type="text" id="tokped" name="tokped" placeholder="Masukan link tokped" value="{{ old('tokped') }}">
                @if ($errors->has('tokped'))
                    <p class="alert alert-danger">{{ $errors->first('tokped') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="shopee">Link Shopee <span class="required">*</span></label>
                <input type="text" id="shopee" name="shopee" placeholder="Masukan link shopee" value="{{ old('shopee') }}">
                @if ($errors->has('shopee'))
                    <p class="alert alert-danger">{{ $errors->first('shopee') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="harga">Harga Produk <span class="required">*</span></label>
                <input type="number" id="harga" name="harga" placeholder="Rp. 9000" value="{{ old('harga') }}">
                @if ($errors->has('harga'))
                    <p class="alert alert-danger">{{ $errors->first('harga') }}</p>
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
                    <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="kode_produk-{{ $p->pid }}">Kode Produk <span class="required">*</span></label>
                <input type="text" id="kode_produk-{{ $p->pid }}" name="kode_produk" placeholder="Masukan Nama" value="{{ old('kode_produk', $p->kode_produk) }}">
                @if ($errors->has('kode_produk'))
                    <p class="alert alert-danger">{{ $errors->first('kode_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="nama_produk-{{ $p->pid }}">Nama Produk <span class="required">*</span></label>
                <input type="text" id="nama_produk-{{ $p->pid }}" name="nama_produk" placeholder="Masukan Nama" value="{{ old('nama_produk', $p->nama_produk) }}">
                @if ($errors->has('nama_produk'))
                    <p class="alert alert-danger">{{ $errors->first('nama_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="kategori">Kategori <span class="required">*</span></label>
                <div class="dropdown">
                    <button class="dropbtn" type="button" id="dropdownButton">Pilih Kategori</button>
                    <div class="dropdown-content" id="dropdownMenu">
                        <a href="#" data-value="Kategori 1">Kategori 1</a>
                        <a href="#" data-value="Kategori 2">Kategori 2</a>
                        <a href="#" data-value="Kategori 3">Kategori 3</a>
                    </div>
                </div>
                <input type="hidden" id="jenis_produk-{{ $p->pid }}" name="jenis_produk" value="{{ old('jenis_produk', $p->jenis_produk) }}">        
                @if ($errors->has('jenis_produk'))
                    <p class="alert alert-danger">{{ $errors->first('jenis_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="jumlah_produk-{{ $p->pid }}">Jumlah Produk <span class="required">*</span></label>
                <input type="text" id="jumlah_produk-{{ $p->pid }}" name="jumlah_produk" placeholder="Masukan jumlah_produk" value="{{ old('jumlah_produk', $p->jumlah_produk) }}">
                @if ($errors->has('jumlah_produk'))
                    <p class="alert alert-danger">{{ $errors->first('jumlah_produk') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="deskripsi-{{ $p->pid }}">Deskripsi Produk <span class="required">*</span></label>
                <input type="text" id="deskripsi-{{ $p->pid }}" name="deskripsi" placeholder="Masukan Pengalaman" value="{{ old('deskripsi', $p->deskripsi) }}">
                @if ($errors->has('deskripsi'))
                <p class="alert alert-danger">{{ $errors->first('deskripsi') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="tokped-{{ $p->pid }}">Link Tokopedia <span class="required">*</span></label>
                <input type="text" id="tokped-{{ $p->pid }}" name="tokped" placeholder="Masukan tokped" value="{{ old('tokped', $p->tokped) }}">
                @if ($errors->has('tokped'))
                    <p class="alert alert-danger">{{ $errors->first('tokped') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="shopee-{{ $p->pid }}">Link Shopee <span class="required">*</span></label>
                <input type="text" id="shopee-{{ $p->pid }}" name="shopee" placeholder="Masukan shopee" value="{{ old('shopee', $p->shopee) }}">
                @if ($errors->has('shopee'))
                    <p class="alert alert-danger">{{ $errors->first('shopee') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="harga-{{ $p->pid }}">Harga Produk <span class="required">*</span></label>
                <input type="text" id="harga-{{ $p->pid }}" name="harga" placeholder="Masukan harga" value="{{ old('harga', $p->harga) }}">
                @if ($errors->has('harga'))
                    <p class="alert alert-danger">{{ $errors->first('harga') }}</p>
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
    $(document).ready(function () {
        $(".btn-details").on("click", function () {
            var row = $(this).closest("tr").next(".details-row");
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

        function hideModals() {
            $(".modal").hide();
        }

        $("#myBtn").on("click", function () {
            showModal("#myModal");
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

        $(document).ready(function() {
            // Set the dropdown button text based on the hidden input value on page load
            var existingValue = $("#jenis_produk-{{ $p->pid }}").val();
            if (existingValue) {
                $("#dropdownButton").text(existingValue);
            }

            // Toggle dropdown menu visibility
            $("#dropdownButton").on("click", function(event) {
                event.preventDefault();
                $("#dropdownMenu").toggleClass("show");
            });

            // Handle click event on dropdown menu items
            $(".dropdown-content a").on("click", function(event) {
                event.preventDefault();
                var selectedCategory = $(this).data('value');
                $("#dropdownButton").text(selectedCategory); // Update dropdown button text
                $("#dropdownMenu").removeClass("show"); // Hide dropdown menu
                $("#jenis_produk-{{ $p->pid }}").val(selectedCategory); // Update hidden input value
            });

            // Close the dropdown if the user clicks outside of it
            $(window).on("click", function(event) {
                if (!event.target.matches('.dropbtn')) {
                    $("#dropdownMenu").removeClass("show");
                }
            });
        });
    });
</script>
@endsection
