@extends('halaman.admin')
@section('content')
<div id="bg-header-content">
    <div id="bo-header-content">
        <div id="header-content" class="clearfix">
            <div id="judul-content">
                <h3>{{$title}}</h3>
            </div>
            @if ($user->role_id == 1)                    
            <div id="tambah-content" class="clearfix">
                    <div id="container-icon-tambah">
                        <div id="icon-tambah">
                            <h4>+</h4>
                        </div>
                    </div>
                    <div id="text-content">
                        <h4>Tambah</h4>
                    </div>
                </div>
            @endif
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
        <div id="table-admin">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pimpinan as $p)                       
                    <tr>
                        <td><span class="btn-toggle icon-plus"><i class="fa-solid fa-plus"></i></span></td>
                        <td>1</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->jabatan}}</td>
                        <td><span id="btn-edit">
                            <button type="button" class="cek" data-id=""><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="delete-btn" data-id=""><i class="fa-solid fa-trash"></i></button>
                        </span></td>
                    </tr>
                    <tr class="details-row">
                        <td colspan="5">
                            <div><strong>Nama Pimpinan: </strong> {{$p->name}}</div>
                            <div><strong>Deskripsi: </strong> {{$p->deskripsi}}</div>
                            <div><img src="{{ asset('images/' . $p->image) }}" alt="{{ $p->judul }}"></div>    
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

<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Tambah {{$title}}</h2>
        <form id="add-admin-form" action="{{ route('pimpinan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <label for="judul">ID:</label> --}}
            <input type="text" id="ppid" name="ppid"  hidden>
            <label for="judul">Nama:</label>
            <input type="text" id="name" name="name" >
            <label for="jabatan">Jabatan:</label>
            <input type="text" id="jabatan" name="jabatan" >
            <label for="deskripsi">Deskripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" >
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" >
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
{{-- @include('modal-admin.admin-edit') --}}
{{-- @include('modal-admin.admin-delete') --}}
@endsection