@extends('halaman.admin')
@section('content')
<div id="myBtn" class="bg-tambah-data">
    <div id="bo-tambah-data">
        <div class="icon-tambah-data">
            <span class="material-symbols-outlined">
            add
            </span>                                                        
        </div>
        <div id="text">
            <strong>Admin</strong>
        </div>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("myModal").style.display = "block";
    });
</script>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div id="bg-isi-content" class="clearfix">
    <div id="bo-isi-content">
        <div id="table-admin">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $u)
                    <tr>
                        <td>
                            <div class="btn-details">
                                <span class="material-symbols-outlined">
                                add
                                </span>                                                        
                            </div>
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->username }}</td>
                        <td>aktif</td>
                        <td>
                            <div id="btn-cfg">
                                <div class="btn-edit" data-id="{{ $u->id }}" data-toggle="modal" data-target="#editModal-{{ $u->id }}">
                                    <span class="material-symbols-outlined">
                                    edit
                                    </span>                                                       
                                </div>
                                <div class="btn-delete" data-id="{{ $u->id }}" data-toggle="modal" data-target="#deleteModal-{{ $u->id }}">
                                    <span class="material-symbols-outlined">
                                    delete
                                    </span>                                                       
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="details-row">
                        <td colspan="6">
                            @if ($u->image)
                                <img src="{{ asset('/storage/' . $u->image) }}" alt="" id="avatar-profile">
                            @else
                                <img src="/img/default-img/default.png" alt="" id="avatar-profile">
                            @endif
                            <div><strong>Nama Admin: </strong> {{ $u->name }}</div>
                            <div><strong>Role: </strong> {{ $u->role->name }}</div>
                            <div><strong>Status : </strong> Aktif</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div id="head-modul">
            <h1>Tambah Admin</h1>
          </div>
          <div class="thumbnail">
            <img id="thumbnail-preview" src="https://via.placeholder.com/100" alt="Thumbnail" style="display: block; margin-bottom: 10px; max-width: 100px;">
            <input type="file" id="thumbnail" name="image" onchange="previewImage(this, 'thumbnail-preview')">
            @if ($errors->has('image'))
                <p class="alert alert-danger">{{ $errors->first('image') }}</p>
            @endif
        </div>
          <div class="form-group">
              <label for="name">Nama Admin <span class="required">*</span></label>
              <input type="text" id="name" name="name" placeholder="Masukan Nama" value="{{ old('name') }}">
              @if ($errors->has('name'))
                  <p class="alert alert-danger">{{ $errors->first('name') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="username">Username <span class="required">*</span></label>
              <input type="text" id="username" name="username" placeholder="Masukan Username" value="{{ old('username') }}">
              @if ($errors->has('username'))
                  <p class="alert alert-danger">{{ $errors->first('username') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="password">Password <span class="required">*</span></label>
              <input type="password" id="password" name="password" placeholder="Masukan Password">
              @if ($errors->has('password'))
                  <p class="alert alert-danger">{{ $errors->first('password') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="password_confirm">Konfirmasi Password <span class="required">*</span></label>
              <input type="password" name="password_confirm" placeholder="Konfirmasi Password">
              @if ($errors->has('password_confirm'))
                  <p class="alert alert-danger">{{ $errors->first('password_confirm') }}</p>
              @endif
          </div>
          <input type="text" id="role" name="role_id" required value="2" hidden>
          <input type="text" id="status" name="status" value="aktif" hidden>
          <div class="form-group">
            <button type="submit" class="submit-btn">Submit</button>
          </div>
      </form>
    </div>
</div>

@foreach ($users as $u)
<!-- Edit Modal -->
<div id="editModal-{{ $u->id }}" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form action="{{ route('admin.update', $u->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
          <div id="head-modul">
            <h1>Edit Admin</h1>
          </div>
          <input type="hidden" id="edit-id-{{ $u->id }}" name="id" value="{{ $u->id }}">
          <div class="thumbnail">
            <img id="edit-thumbnail-preview-{{ $u->id }}" src="{{ $u->image ? asset('/storage/' . $u->image) : 'https://via.placeholder.com/100' }}" alt="Thumbnail" style="display: block; margin-bottom: 10px; max-width: 100px;">
            <input type="file" id="edit-thumbnail-{{ $u->id }}" name="image" onchange="previewImage(this, 'edit-thumbnail-preview-{{ $u->id }}')">
            @if ($errors->has('image'))
                <p class="alert alert-danger">{{ $errors->first('image') }}</p>
            @endif
        </div>
          <div class="form-group">
              <label for="edit-name-{{ $u->id }}">Nama Admin <span class="required">*</span></label>
              <input type="text" id="edit-name-{{ $u->id }}" name="name" placeholder="Masukan Nama" value="{{ $u->name }}">
              @if ($errors->has('name'))
                  <p class="alert alert-danger">{{ $errors->first('name') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="edit-username-{{ $u->id }}">Username <span class="required">*</span></label>
              <input type="text" id="edit-username-{{ $u->id }}" name="username" placeholder="Masukan Username" value="{{ $u->username }}" readonly>
              @if ($errors->has('username'))
                  <p class="alert alert-danger">{{ $errors->first('username') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="edit-password-{{ $u->id }}">Password <span class="required">*</span></label>
              <input type="password" id="edit-password-{{ $u->id }}" name="password" placeholder="Masukan Password">
              @if ($errors->has('password'))
                  <p class="alert alert-danger">{{ $errors->first('password') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="edit-password_confirm-{{ $u->id }}">Konfirmasi Password <span class="required">*</span></label>
              <input type="password" id="edit-password_confirm-{{ $u->id }}" name="password_confirm" placeholder="Konfirmasi Password">
              @if ($errors->has('password_confirm'))
                  <p class="alert alert-danger">{{ $errors->first('password_confirm') }}</p>
              @endif
          </div>
          <input type="text" id="edit-role-{{ $u->id }}" name="role_id" required value="2" hidden>
          <input type="text" id="edit-status-{{ $u->id }}" name="status" value="aktif" hidden>
          <div class="form-group">
            <button type="submit" class="submit-btn">Update</button>
          </div>
      </form>
    </div>
</div>
@endforeach

@foreach ($users as $u)
<!-- Delete Modal -->
<div id="deleteModal-{{ $u->id }}" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h1>Konfirmasi Hapus</h1>
      <p>Apakah Anda yakin ingin menghapus admin ini?</p>
      <form action="{{ route('admin.destroy', $u->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="form-group">
            <button type="submit" class="submit-btn">Hapus</button>
        </div>
      </form>
    </div>
</div>
@endforeach
<script>
    $(document).ready(function () {
        // Menampilkan baris detail
        $(".btn-details").on("click", function () {
            var row = $(this).closest("tr").next(".details-row");
            row.toggle();
            var icon = $(this).find(".material-symbols-outlined");
            icon.text(row.is(":visible") ? "remove" : "add");
        });

        // Menampilkan dan menyembunyikan modal
        function showModal(modalId) { $(modalId).show(); }
        function hideModals() { $(".modal").hide(); }

        $("#myBtn").on("click", function () { showModal("#myModal"); });
        $(".btn-edit").on("click", function () { showModal("#editModal-" + $(this).data('id')); });
        $(".btn-delete").on("click", function () { showModal("#deleteModal-" + $(this).data('id')); });
        $(".close").on("click", function () { hideModals(); });
        $(window).on("click", function (event) { if ($(event.target).hasClass("modal")) { hideModals(); } });
    });

    // Pratinjau Gambar
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) { preview.src = e.target.result; }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "https://via.placeholder.com/100"; // Placeholder jika gambar dihapus
        }
    }
</script>
{{-- <script>
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

        // Function to show modal
        function showModal(modalId) {
            $(modalId).show();
        }

        // Function to hide all modals
        function hideModals() {
            $(".modal").hide();
        }

        // Event listener for Add button
        $("#myBtn").on("click", function () {
            showModal("#myModal");
        });

        // Event listener for Edit button
        $(".btn-edit").on("click", function () {
            var userId = $(this).data('id');
            showModal("#editModal-" + userId);
        });

        // Event listener for Delete button
        $(".btn-delete").on("click", function () {
            var userId = $(this).data('id');
            showModal("#deleteModal-" + userId);
        });

        // Event listener for Close button
        $(".close").on("click", function () {
            hideModals();
        });

        // Close modals when clicking outside of the modal content
        $(window).on("click", function (event) {
            if ($(event.target).hasClass("modal")) {
                hideModals();
            }
        });
    });
</script> --}}
@endsection
