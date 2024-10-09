<form action="{{ route('produk.store') }}" method="POST">
    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
    @endif
    @csrf
    <input class="form-control" type="text" name="judul" placeholder="Judul">
    <input class="form-control" type="text" name="slug" placeholder="slug">
    <input class="form-control" type="text" name="deskripsi" placeholder="deskripsi">
    <input class="form-control" type="text" name="image" placeholder="image">
    <input class="form-control" type="text" name="tokped" placeholder="tokped">
    <input class="form-control" type="text" name="shopee" placeholder="shopee">
    <button type="submit" class="btn btn-primary me-2">Submit</button>
</form>