@extends('halaman.admin')
@section('content')
<div id="myKegiatan" class="bg-tambah-data">
    <div id="bo-tambah-data">
        <div class="icon-tambah-data">
            <span class="material-symbols-outlined">add</span>                                                        
        </div>
        <div id="text">
            <strong>Kegiatan</strong>
        </div>
    </div>
</div>
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
                            <div><strong>Kategori Produk: </strong> {{ $p->kategori->name }}</div>
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

{{-- modal kegiatan --}}
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
                <input type="text" id="name" name="name" placeholder="Masukkan Nama Kategiri Baru" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <p class="alert alert-danger">{{ $errors->first('name') }}</p>
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
            <div class="thumbnail">
                <img id="thumbnail-preview" src="https://via.placeholder.com/100" alt="Thumbnail">
                <input type="file" id="thumbnail" name="image">
                @if ($errors->has('image'))
                    <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image_produk">Gambar Produk <span class="required">*</span></label>
                <input type="file" id="image1" name="image1">
                @if ($errors->has('image1'))
                    <p class="alert alert-danger">{{ $errors->first('image1') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image_produk">Gambar Produk <span class="required">*</span></label>
                <input type="file" id="image2" name="image2">
                @if ($errors->has('image2'))
                    <p class="alert alert-danger">{{ $errors->first('image2') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image_produk">Gambar Produk <span class="required">*</span></label>
                <input type="file" id="image3" name="image3">
                @if ($errors->has('image3'))
                    <p class="alert alert-danger">{{ $errors->first('image3') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="image_produk">Gambar Produk <span class="required">*</span></label>
                <input type="file" id="image4" name="image4">
                @if ($errors->has('image4'))
                    <p class="alert alert-danger">{{ $errors->first('image4') }}</p>
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
                <label for="kategori_id">Kategori <span class="required">*</span></label>
                <select id="kategori_id" name="kategori_id" class="form-control">
                    <option value="" disabled selected>Pilih Kategori</option>
                    @foreach ($kategori as $p)
                    <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="jumlah_produk">Jumlah Produk <span class="required">*</span></label>
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
                <label for="berat">Berat Produk <span class="required">*</span></label>
                <input type="number" id="berat" name="berat" placeholder="1" value="{{ old('berat') }}">
                @if ($errors->has('berat'))
                    <p class="alert alert-danger">{{ $errors->first('berat') }}</p>
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
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image1 }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image1) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image1">
                @if ($errors->has('image1'))
                    <p class="alert alert-danger">{{ $errors->first('image1') }}</p>
                @endif
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image2 }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image2) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image2">
                @if ($errors->has('image2'))
                    <p class="alert alert-danger">{{ $errors->first('image2') }}</p>
                @endif
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image3 }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image3) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image3">
                @if ($errors->has('image3'))
                    <p class="alert alert-danger">{{ $errors->first('image3') }}</p>
                @endif
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image4 }}">
                <img id="thumbnail-preview-{{ $p->pid }}" src="{{ asset('/storage/' . $p->image4) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->pid }}" name="image4">
                @if ($errors->has('image4'))
                    <p class="alert alert-danger">{{ $errors->first('image4') }}</p>
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
            <!-- Kategori Dropdown -->
            <div class="form-group">
                <label for="kategori_id-{{ $p->pid }}">Kategori <span class="required">*</span></label>
                <select id="kategori_id-{{ $p->pid }}" name="kategori_id" class="form-control">
                    @foreach ($kategori as $kategoriItem)
                        <option value="{{ $kategoriItem->id }}" {{ $kategoriItem->id == $p->kategori_id ? 'selected' : '' }}>{{ $kategoriItem->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('kategori_id'))
                    <p class="alert alert-danger">{{ $errors->first('kategori_id') }}</p>
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
    });
</script>

@endsection