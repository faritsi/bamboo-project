<a href="{{ route('produk.create') }}"><button type="button" class="btn btn-primary btn-icon-text">
    <i class="mdi mdi-plus-box btn-icon-prepend"></i> Tambah produk </button></a>
<table class="table table-bordered">
    <thead>
      <tr>
        <th> No </th>
        <th> Nama Balita </th>
        <th> Nama Ibu </th>
        <th> Tanggal Lahir </th>
        <th> Jenis Kelamin </th>
        <th> Aksi </th>
      </tr>
    </thead>
    <tbody>
    @foreach ($produk as $p)
      <tr>
        <td> {{ $p->judul }} </td>
        <td> {{ $p->slug }} </td>
        <td> {{ $p->deskripsi }} </td>
        <td> {{ $p->image }} </td>
        <td> {{ $p->tokped }} </td>
        <td> {{ $p->shopee }} </td>
      </tr>
    @endforeach
    </tbody>
  </table>