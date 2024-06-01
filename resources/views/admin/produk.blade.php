@extends('halaman.admin')
@section('content')
<div id="bg-header-content">
    <div id="bo-header-content">
        <div id="header-content" class="clearfix">
            <div id="judul-content">
                <h3>PRODUK</h3>
            </div>
            <div id="tambah-content" class="clearfix">
                <div id="add-admin-btn" >
                    <div id="icon-tambah">
                        <h4>+</h4>
                    </div>
                </div>
                <div id="text-content">
                    <h4>Produk</h4>
                </div>
            </div>
        </div>
        <!-- Search Box -->
        <div id="bg-show-search">
            <div id="bo-show-search">
                <div id="show-search" class="clearfix">
                    <div id="container-show" class="clearfix">
                        <div id="text-show">
                            <h3>Show</h3>
                        </div>
                        <div id="show-entries">
                            10
                        </div>
                        <div id="text-entries">
                            <h3>Entries</h3>
                        </div>
                    </div>
                    <div id="container-search" class="clearfix">
                        <div id="text-search">
                            <h3>Search: </h3>
                        </div>
                        <input type="text" class="search-input" placeholder="Enter Name">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Admin -->
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
                    <?php $i = 1; ?>
                    @foreach ($produk as $p)
                    <tr>
                        <td><span class="btn-toggle icon-plus"><i class="fa-solid fa-plus"></i></span></td>
                        <td><?= $i++ ?></td>
                        <td>{{$p->judul}}</td>
                        <td><a href="{{$p->tokped}}">{{$p->tokped}}</a></td>
                        <td><a href="{{$p->shopee}}">{{$p->shopee}}</a></td>
                        {{-- <td><span id="btn-edit"><i class="fa-solid fa-pen-to-square"></i><i class="fa-solid fa-trash"></i></span></td> --}}
                        <td><span id="btn-edit">
                            <button type="button" class="cek" data-id="{{ $p->pid }}"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="delete-btn" data-id="{{ $p->pid }}"><i class="fa-solid fa-trash"></i></button>
                        </span></td>
                    </tr>
                    <tr class="details-row">
                        <td colspan="6">
                            <div><strong>Nama Produk: </strong> {{$p->judul}}</div>
                            <div><strong>Deskripsi Produk: </strong> {{$p->deskripsi}}</div>
                            <div><img src="{{ asset('images/' . $p->image) }}" alt="{{ $p->judul }}"></div>                          
                            {{-- <div><strong>Link Shoppe: </strong> shoppe.com</div> --}}
                            <!-- <div><strong>Status : </strong> Aktif</div> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Next Btn -->
            <div id="bg-btn">
                    <div id="bo-btn">
                        <div id="btn" class="clearfix">
                            <div id="prev-btn">
                                <i class="fa-solid fa-circle-chevron-left"></i>
                            </div>
                            <div id="count-page-tabel">1, 2 ,3</div>
                            <div id="next-btn">
                                <i class="fa-solid fa-circle-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Tambah Admin</h2>
        <form id="add-admin-form" action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="judul">ID:</label>
            <input type="text" id="pid" name="pid"  >
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" >
            <label for="slug">Slug:</label>
            <input type="text" id="slug" name="slug" >
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
</div>
{{-- edit --}}
{{-- @yield('modal-edit') --}}
@include('modal.modal-edit')
@include('modal.modal-delet')

@endsection
