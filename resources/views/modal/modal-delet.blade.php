@foreach ($produk as $p)
<div id="modalDelete{{$p->pid}}" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus produk ini?</p>
        <form action="{{ route('produk.destroy', $p->pid) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit">Hapus</button>
        </form>
    </div>
</div>
@endforeach