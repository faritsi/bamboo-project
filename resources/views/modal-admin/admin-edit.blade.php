
@foreach ($users as $u)
<div id="modalUpdate{{$u->id}}" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit Admin</h2>
        <form action="{{ route('admin.update', $u->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{$u->name}}" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{$u->username}}" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="password">Konfirmasi Password:</label>
            <input type="password" name="password_confirm" placeholder="Konfirmasi Password" required>
            {{-- <label for="role">Role:</label> --}}
            <input type="text" id="role" name="role_id" required value="{{$u->role_id}}" hidden>
            {{-- <label for="status">Status:</label> --}}
            <input type="text" id="status" name="status" value="aktif" hidden>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

@endforeach
<script>
    function previewImage() {
        const image = document.querySelector("#image");
        const imgPreview = document.querySelector(".img-preview");

        imgPreview.style.display = "block";
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>