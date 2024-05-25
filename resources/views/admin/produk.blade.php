@extends('halaman.admin')
@section('content')
<div id="bungkus-produk">
  <div id="tabel-produk" class="clearfix">
    <div id="kiri">
      <h1>Produk</h1>
    </div>
    <div id="kanan">
      <a href="{{ route('produk.create') }}">Tambah produk</a>
    </div>
    <hr>
    <div id="isi-tabel">
      <div id="bo-tabel">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th> Show </th>
              <th> Judul </th>
              <th> Deskripsi </th>
              <th> Image </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($produk as $p)
              <tr>
                <td> 
                  <i class="fa fa-plus-circle" onclick="triggerTable(1, this)"></i> 
                  <i class="fa fa-plus-circle" onclick="triggerTable(2, this)"></i> 
                </td>
                <td> {{ $p->judul }} </td>
                <td> {{ $p->deskripsi }} </td>
                <td> {{ $p->image }} </td>
              </tr>
              <tr class="extra-info-1" style="display: none;">
                <td>Slug</td>
                <td colspan="3">{{$p->slug}}</td>
              </tr>
              <tr class="extra-info-2" style="display: none;">
                <td colspan="4">Info tambahan 2</td>
              </tr>
            @endforeach
          </tbody>
        </table> 
      </div>
    </div>
  </div>
</div> 
@endsection
