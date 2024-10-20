@foreach ($users as $p)
<div id="modalDelete{{$p->id}}" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus produk ini?</p>
        <form action="{{ route('admin.destroy', $p->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit">Hapus</button>
        </form>
    </div>
</div>
@endforeach