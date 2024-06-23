@extends('halaman.admin')
@section('content')
<div id="bg-tambah-data">
    <div id="bo-tambah-data">
        <div class="icon-tambah-data">
            <span class="material-symbols-outlined">
            add
            </span></td>                                                        
        </div>
        <div id="text">
            <strong>Pimpinan</strong>
        </div>
    </div>
</div>
<div id="bg-isi-content" class="clearfix">
    <div id="bo-isi-content">
        {{-- Table --}}
        <div id="table-pimpinan">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Pengalaman</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pimpinan as $p) 
                    <tr>
                        <td>
                            <div class="btn-details">
                                <span class="material-symbols-outlined">
                                add
                                </span></td>                                                        
                            </div>
                        <td>1</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->jabatan}}</td>
                        <td>{{$p->deskripsi}}</td>
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
                            <div><strong>Poto: </strong> Poto</div>
                            <div><strong>Nama Lengkap: </strong> {{$p->name}}</div>
                            <div><strong>Jabatan: </strong> {{$p->jabatan}}</div>
                            <div><strong>Pengalaman: </strong> {{$p->deskripsi}}</div>
                            {{-- <div><strong>Status : </strong> Aktif</div> --}}
                        </td>
                    </tr>
                    @endforeach
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
        <h2>Tambah {{$title}}</h2>
        <form id="add-admin-form" action="{{ route('pimpinan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
            @foreach ($errors->all() as $err)
                <p class="hayo">{{ $err }}</p>
            @endforeach
            @endif --}}
            {{-- <label for="judul">ID:</label> --}}
            {{-- <input type="text" id="ppid" name="ppid"  hidden>
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
@include('modal-pimpinan.pimpinan-edit')
@include('modal-pimpinan.pimpinan-delet') --}}
@endsection