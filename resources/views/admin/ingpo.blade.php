@extends('halaman.admin')
@section('content')

<!-- Display success message -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Display error messages -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div id="bg-info">
    @foreach ($ingpo as $i)       
    <form action="{{ route('info.update', $i->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Layout Section -->
        <div class="section">
            <h1>Layout</h1>
            <p>Edit layout dashboard</p>
            <hr>
        </div>

        <div class="section">
            <h2>Logo</h2>
            <input type="file" id="favicon" name="favicon">
            <div class="image-preview">
                <img id="imageHeaderPreview1" src="{{ asset('storage/' . $i->favicon) }}" style="max-width: 200px; max-height: 150px;">
            </div>
        </div>

        <div class="section">
            <h2>Title</h2>
            <textarea id="title" name="title" rows="5">{{ $i->title }}</textarea>
        </div>

        <!-- Background Header Section -->
        <div class="section">
            <h2>Background Header</h2>
            <input type="file" id="image_header" name="image_header" onchange="previewImage(event, 'imageHeaderPreview')">
            <div class="image-preview">
                <img id="imageHeaderPreview" src="{{ asset('storage/' . $i->image_header) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
            </div>
        </div>

        <!-- Deskripsi Header -->
        <div class="section">
            <h2>Deskripsi Header</h2>
            <textarea id="desc_header" name="desc_header" rows="5">{{ $i->desc_header }}</textarea>
        </div>

        <!-- Slogan -->
        <div class="section">
            <h2>Slogan</h2>
            <input type="text" id="slogan" name="slogan" value="{{ $i->slogan }}">
        </div>

        <!-- Deskripsi Slogan -->
        <div class="section">
            <h2>Deskripsi Slogan</h2>
            <textarea id="desc_slogan" name="desc_slogan" rows="5">{{ $i->desc_slogan }}</textarea>
        </div>

        <!-- Image About Section -->
        <div class="section">
            <h2>Image About</h2>
            <input type="file" id="image_about" name="image_about" onchange="previewImage(event, 'imageAboutPreview')">
            <div class="image-preview">
                <img id="imageAboutPreview" src="{{ asset('storage/' . $i->image_about) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
            </div>
        </div>

        <!-- Deskripsi About -->
        <div class="section">
            <h2>Deskripsi About</h2>
            <textarea id="desc_about" name="desc_about" rows="5">{{ $i->desc_about }}</textarea>
        </div>

        <!-- Image Visi Section -->
        <div class="section">
            <h2>Image Visi</h2>
            <input type="file" id="image_visi" name="image_visi" onchange="previewImage(event, 'imageVisiPreview')">
            <div class="image-preview">
                <img id="imageVisiPreview" src="{{ asset('storage/' . $i->image_visi) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
            </div>
        </div>

        <!-- Deskripsi Visi -->
        <div class="section">
            <h2>Deskripsi Visi</h2>
            <textarea id="desc_visi" name="desc_visi" rows="5">{{ $i->desc_visi }}</textarea>
        </div>

        <!-- Image Misi Section -->
        <div class="section">
            <h2>Image Misi</h2>
            <input type="file" id="image_misi" name="image_misi" onchange="previewImage(event, 'imageMisiPreview')">
            <div class="image-preview">
                <img id="imageMisiPreview" src="{{ asset('storage/' . $i->image_misi) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
            </div>
        </div>

        <!-- Deskripsi Misi -->
        <div class="section">
            <h2>Deskripsi Misi</h2>
            <textarea id="desc_misi" name="desc_misi" rows="5">{{ $i->desc_misi }}</textarea>
        </div>

        <!-- Service Title Section -->
        <div class="section">
            <h2>Judul Service</h2>
            <input type="text" id="judul_service" name="judul_service" value="{{ $i->judul_service }}">
        </div>

        <!-- Deskripsi Service -->
        <div class="section">
            <h2>Deskripsi Service</h2>
            <textarea id="desc_service" name="desc_service" rows="5">{{ $i->desc_service }}</textarea>
        </div>

        <!-- Product Title Section -->
        <div class="section">
            <h2>Judul Produk</h2>
            <input type="text" id="judul_produk" name="judul_produk" value="{{ $i->judul_produk }}">
        </div>

        <!-- Deskripsi Produk -->
        <div class="section">
            <h2>Deskripsi Produk</h2>
            <textarea id="desc_produk" name="desc_produk" rows="5">{{ $i->desc_produk }}</textarea>
        </div>

        <!-- Footer Logo Section -->
        <div class="section">
            <h2>Logo Footer</h2>
            <input type="file" id="logo_footer" name="logo_footer" onchange="previewImage(event, 'logoFooterPreview')">
            <div class="image-preview">
                <img id="logoFooterPreview" src="{{ asset('storage/' . $i->logo_footer) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
            </div>
        </div>

        <!-- Judul Footer Section -->
        <div class="section">
            <h2>Judul Footer</h2>
            <input type="text" id="judul_footer" name="judul_footer" value="{{ $i->judul_footer }}">
        </div>

        <!-- Deskripsi Footer -->
        <div class="section">
            <h2>Deskripsi Footer</h2>
            <textarea id="desc_footer" name="desc_footer" rows="5">{{ $i->desc_footer }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="section">
            <button type="submit">Update Layout</button>
        </div>
    </form>
    @endforeach
</div>

<script>
    function previewImage(event, imageId) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById(imageId);
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
