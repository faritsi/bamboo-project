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
            <strong>Pimpinan</strong>
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
                    @foreach ($pimpinan as $index => $p)
                    <tr>
                        <td>
                            <div class="btn-details">
                                <span class="material-symbols-outlined">
                                add
                                </span>                                                        
                            </div>
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->jabatan }}</td>
                        <td>{{ $p->deskripsi }}</td>
                        <td>
                            <div id="btn-cfg">
                                <div class="btn-edit" data-id="{{ $p->ppid }}">
                                    <span class="material-symbols-outlined">
                                    edit
                                    </span>                                                       
                                </div>
                                <div class="btn-delete" data-id="{{ $p->ppid }}">
                                    <span class="material-symbols-outlined">
                                    delete
                                    </span>                                                       
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="details-row">
                        <td colspan="6">
                            @if ($p->image)
                                <img src="{{ asset('/storage/' . $p->image) }}" alt="" id="avatar-profile">
                            @else
                                <img src="/img/default-img/default.png" alt="" id="avatar-profile">
                            @endif
                            {{-- <div><img src="{{ asset('/storage/images/' . $p->image) }}" alt=""></div> --}}
                            <div><strong>Nama Pimpinan: </strong> {{ $p->name }}</div>
                            <div><strong>Jabatan: </strong> {{ $p->jabatan }}</div>
                            <div><strong>Pengalaman : </strong> {{ $p->deskripsi }}</div>
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
      <form action="{{ route('pimpinan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div id="head-modul">
            <h1>Tambah Pimpinan</h1>
          </div>
          <div class="thumbnail">
            <img id="thumbnail-preview" src="https://via.placeholder.com/100" alt="Thumbnail">
            <input type="file" id="thumbnail" name="image">
            @if ($errors->has('image'))
                <p class="alert alert-danger">{{ $errors->first('image') }}</p>
            @endif
          </div>
          <div class="form-group">
              <label for="name">Nama Pimpinan <span class="required">*</span></label>
              <input type="text" id="name" name="name" placeholder="Masukan Nama" value="{{ old('name') }}">
              @if ($errors->has('name'))
                  <p class="alert alert-danger">{{ $errors->first('name') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="jabatan">Jabatan <span class="required">*</span></label>
              <input type="text" id="jabatan" name="jabatan" placeholder="Masukan Jabatan" value="{{ old('jabatan') }}">
              @if ($errors->has('jabatan'))
                  <p class="alert alert-danger">{{ $errors->first('jabatan') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="deskripsi">Pengalaman <span class="required">*</span></label>
              <input type="text" id="deskripsi" name="deskripsi" placeholder="Masukan Pengalaman" value="{{ old('deskripsi') }}">
              @if ($errors->has('deskripsi'))
                  <p class="alert alert-danger">{{ $errors->first('deskripsi') }}</p>
              @endif
          </div>
          <div class="form-group">
            <button type="submit" class="submit-btn">Submit</button>
          </div>
      </form>
    </div>
</div>

<!-- Edit Modals -->
@foreach ($pimpinan as $p)
<div id="editModal-{{ $p->ppid }}" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('pimpinan.update', $p->ppid) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="head-modul">
                <h1>Edit Pimpinan</h1>
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->image }}">
                <img id="thumbnail-preview-{{ $p->ppid }}" src="{{ asset('/storage/' . $p->image) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->ppid }}" name="image">
                @if ($errors->has('image'))
                    <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="name-{{ $p->ppid }}">Nama Pimpinan <span class="required">*</span></label>
                <input type="text" id="name-{{ $p->ppid }}" name="name" placeholder="Masukan Nama" value="{{ old('name', $p->name) }}">
                @if ($errors->has('name'))
                    <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="jabatan-{{ $p->ppid }}">Jabatan <span class="required">*</span></label>
                <input type="text" id="jabatan-{{ $p->ppid }}" name="jabatan" placeholder="Masukan Jabatan" value="{{ old('jabatan', $p->jabatan) }}">
                @if ($errors->has('jabatan'))
                    <p class="alert alert-danger">{{ $errors->first('jabatan') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="deskripsi-{{ $p->ppid }}">Pengalaman <span class="required">*</span></label>
                <input type="text" id="deskripsi-{{ $p->ppid }}" name="deskripsi" placeholder="Masukan Pengalaman" value="{{ old('deskripsi', $p->deskripsi) }}">
                @if ($errors->has('deskripsi'))
                    <p class="alert alert-danger">{{ $errors->first('deskripsi') }}</p>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>
@endforeach


<!-- Delete Modal -->
@foreach ($pimpinan as $p)
<div id="deleteModal-{{ $p->ppid }}" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('pimpinan.destroy', $p->ppid) }}" method="POST">
            @csrf
            @method('DELETE')
            <div id="head-modul">
                <h1>Delete Pimpinan</h1>
            </div>
            <p>Are you sure you want to delete {{ $p->name }}?</p>
            <div class="form-group">
                <button type="submit" class="submit-btn">Delete</button>
            </div>
        </form>
    </div>
</div>
@endforeach

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

    function showModal(modalId) {
        $(modalId).show();
    }

    function hideModals() {
        $(".modal").hide();
    }

    $("#myBtn").on("click", function () {
        showModal("#myModal");
    });

    $(".close").on("click", function () {
        hideModals();
    });

    $(window).on("click", function (event) {
        if ($(event.target).hasClass("modal")) {
            hideModals();
        }
    });

    $('.thumbnail').on('click', function() {
        $(this).find('input[type="file"]').click();
    });

    $('input[type="file"]').on('change', function(event) {
        var reader = new FileReader();
        var preview = $(this).siblings('img');
        reader.onload = function() {
            preview.attr('src', reader.result);
        }
        reader.readAsDataURL(event.target.files[0]);
    });

    // Event listener for Edit button
    $(".btn-edit").on("click", function () {
        var ppid = $(this).data('id');
        showModal("#editModal-" + ppid);
    });

    // Event listener for Delete button
    $(".btn-delete").on("click", function () {
        var ppid = $(this).data('id');
        showModal("#deleteModal-" + ppid);
    });
});

</script>
@endsection
