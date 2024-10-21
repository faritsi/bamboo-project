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
            <strong>Services</strong>
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
                        <th>Image</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($service as $index => $p)
                    <tr>
                        <td>
                            <div class="btn-details">
                                <span class="material-symbols-outlined">
                                add
                                </span>                                                        
                            </div>
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ asset('/storage/' . $p->img) }}</td>
                        <td>{{ $p->judul }}</td>
                        <td>{{ $p->desc }}</td>
                        <td>
                            <div id="btn-cfg">
                                <div class="btn-edit" data-id="{{ $p->id }}">
                                    <span class="material-symbols-outlined">
                                    edit
                                    </span>                                                       
                                </div>
                                <div class="btn-delete" data-id="{{ $p->id }}">
                                    <span class="material-symbols-outlined">
                                    delete
                                    </span>                                                       
                                </div>
                            </div>
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
      <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div id="head-modul">
            <h1>Tambah Service</h1>
          </div>
          <div class="thumbnail">
            <img id="thumbnail-preview" src="https://via.placeholder.com/100" alt="Thumbnail">
            <input type="file" id="thumbnail" name="img">
            @if ($errors->has('img'))
                <p class="alert alert-danger">{{ $errors->first('img') }}</p>
            @endif
          </div>
          <div class="form-group">
              <label for="name">Judul Service <span class="required">*</span></label>
              <input type="text" id="name" name="judul" placeholder="Masukan Judul" value="{{ old('judul') }}">
              @if ($errors->has('judul'))
                  <p class="alert alert-danger">{{ $errors->first('judul') }}</p>
              @endif
          </div>
          <div class="form-group">
              <label for="desc">Deskripsi <span class="required">*</span></label>
              <input type="text" id="desc" name="desc" placeholder="Masukan desc" value="{{ old('desc') }}">
              @if ($errors->has('desc'))
                  <p class="alert alert-danger">{{ $errors->first('desc') }}</p>
              @endif
          </div>
          <div class="form-group">
            <button type="submit" class="submit-btn">Submit</button>
          </div>
      </form>
    </div>
</div>

<!-- Edit Modals -->
@foreach ($service as $p)
<div id="editModal-{{ $p->id }}" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('services.update', $p->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="head-modul">
                <h1>Edit Service</h1>
            </div>
            <div class="thumbnail">
                <input type="hidden" name="oldImage" value="{{ $p->img }}">
                <img id="thumbnail-preview-{{ $p->id }}" src="{{ asset('/storage/' . $p->img) }}" alt="Thumbnail">
                <input type="file" id="thumbnail-{{ $p->id }}" name="img">
                @if ($errors->has('img'))
                    <p class="alert alert-danger">{{ $errors->first('img') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="name-{{ $p->id }}">Judul Service <span class="required">*</span></label>
                <input type="text" id="name-{{ $p->id }}" name="judul" placeholder="Masukan Nama" value="{{ old('judul', $p->judul) }}">
                @if ($errors->has('judul'))
                    <p class="alert alert-danger">{{ $errors->first('judul') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="desc-{{ $p->id }}">desc <span class="required">*</span></label>
                <input type="text" id="desc-{{ $p->id }}" name="desc" placeholder="Masukan desc" value="{{ old('desc', $p->desc) }}">
                @if ($errors->has('desc'))
                    <p class="alert alert-danger">{{ $errors->first('desc') }}</p>
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
@foreach ($service as $p)
<div id="deleteModal-{{ $p->id }}" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('services.destroy', $p->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div id="head-modul">
                <h1>Delete Service</h1>
            </div>
            <p>Are you sure you want to delete {{ $p->judul }}?</p>
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
