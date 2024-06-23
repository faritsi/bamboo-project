@extends('halaman.admin')
@section('content')
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
                    <tr>
                        <td>
                            <div class="btn-details">
                                <span class="material-symbols-outlined">
                                add
                                </span>                                                  
                            </div>
                        </td>
                        <td>1</td>
                        <td>Tumbler Bambu</td>
                        <td>Link TokPed</td>
                        <td>Link Shopee</td>
                        <td>
                            <div id="btn-cfg">
                                <div class="btn-edit">
                                    <span class="material-symbols-outlined">
                                    edit
                                    </span>                                                       
                                </div>
                                <div class="btn-delete">
                                    <span class="material-symbols-outlined">
                                    delete
                                    </span>                                                       
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="details-row">
                        <td colspan="6">
                            <div><strong>Poto Produk: </strong> Poto Tumbler Bambu</div>
                            <div><strong>Nama Produk: </strong> Tumbler Bambu</div>
                            <div><strong>Link Tokopedia: </strong> Tokopedia.com</div>
                            <div><strong>Link Shoppe: </strong> shoppe.com</div>
                            <!-- <div><strong>Status : </strong> Aktif</div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
</div>
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
    });
</script>
<!-- Modal -->
{{-- <div id="modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Tambah Produk</h2>
        <form id="add-admin-form" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf --}}
            {{-- <label for="judul">ID:</label> --}}
            {{-- <input type="text" id="pid" name="pid"  hidden>
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" >
            <label for="slug">Slug:</label>
            <input type="text" id="slug" name="slug" >
            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" >
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" >
            <label for="deskripsi">Deskripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" >
            <label for="tokped">Tokopedia:</label>
            <input type="text" id="tokped" name="tokped" >
            <label for="shopee">Shopee:</label>
            <input type="text" id="shopee" name="shopee" >
            <button type="submit">Submit</button>
        </form>
    </div>
</div> --}}
{{-- edit --}}
{{-- @yield('modal-edit') --}}
{{-- @include('modal-produk.modal-edit') --}}
{{-- @include('modal-produk.modal-delet') --}}

@endsection
