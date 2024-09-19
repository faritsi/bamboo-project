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
        <h1>Layout</h1>
        <p>Edit layout dashboard</p>
        <hr>

        <!-- Background Header with Preview -->
        <h2>Background Header</h2>
        <input type="file" id="image_header" name="image_header" onchange="previewImage(event, 'imageHeaderPreview')">
        <img id="imageHeaderPreview" src="{{ asset('storage/' . $i->image_header) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">

        <h2>Deskripsi Header</h2>
        <input type="text" id="desc_header" name="desc_header" value="{{$i->desc_header}}">
        
        <h2>Slogan</h2>
        <input type="text" id="slogan" name="slogan" value="{{$i->slogan}}">
        
        <h2>Deskripsi Slogan</h2>
        <input type="text" id="desc_slogan" name="desc_slogan" value="{{$i->desc_slogan}}">

        <h2>Image About</h2>
        <input type="file" id="image_about" name="image_about" onchange="previewImage(event, 'imageAboutPreview')">
        <img id="imageAboutPreview" src="{{ asset('storage/' . $i->image_about) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
        
        <h2>Deskripsi About</h2>
        <input type="text" id="desc_about" name="desc_about" value="{{$i->desc_about}}">

        <h2>Image Visi</h2>
        <input type="file" id="image_visi" name="image_visi" onchange="previewImage(event, 'imageVisiPreview')">
        <img id="imageVisiPreview" src="{{ asset('storage/' . $i->image_visi) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
        
        <h2>Deskripsi Visi</h2>
        <input type="text" id="desc_visi" name="desc_visi" value="{{$i->desc_visi}}">

        <h2>Image Misi</h2>
        <input type="file" id="image_misi" name="image_misi" onchange="previewImage(event, 'imageMisiPreview')">
        <img id="imageMisiPreview" src="{{ asset('storage/' . $i->image_misi) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
        
        <h2>Deskripsi Misi</h2>
        <input type="text" id="desc_misi" name="desc_misi" value="{{$i->desc_misi}}">

        <h2>Judul Service</h2>
        <input type="text" id="judul_service" name="judul_service" value="{{$i->judul_service}}">

        <h2>Deskripsi Service</h2>
        <input type="text" id="desc_service" name="desc_service" value="{{$i->desc_service}}">

        <h2>Logo Service 1</h2>
        <input type="file" id="logo_service1" name="logo_service1" onchange="previewImage(event, 'logoService1Preview')">
        <img id="logoService1Preview" src="{{ asset('storage/' . $i->logo_service1) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
        
        <h2>Judul Service 1</h2>
        <input type="text" id="judul_service1" name="judul_service1" value="{{$i->judul_service1}}">

        <h2>Deskripsi Service 1</h2>
        <input type="text" id="desc_service1" name="desc_service1" value="{{$i->desc_service1}}">

        <h2>Logo Service 2</h2>
        <input type="file" id="logo_service2" name="logo_service2" onchange="previewImage(event, 'logoService2Preview')">
        <img id="logoService2Preview" src="{{ asset('storage/' . $i->logo_service2) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
        
        <h2>Judul Service 2</h2>
        <input type="text" id="judul_service2" name="judul_service2" value="{{$i->judul_service2}}">

        <h2>Deskripsi Service 2</h2>
        <input type="text" id="desc_service2" name="desc_service2" value="{{$i->desc_service2}}">

        <h2>Logo Service 3</h2>
        <input type="file" id="logo_service3" name="logo_service3" onchange="previewImage(event, 'logoService3Preview')">
        <img id="logoService3Preview" src="{{ asset('storage/' . $i->logo_service3) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
        
        <h2>Judul Service 3</h2>
        <input type="text" id="judul_service3" name="judul_service3" value="{{$i->judul_service3}}">

        <h2>Deskripsi Service 3</h2>
        <input type="text" id="desc_service3" name="desc_service3" value="{{$i->desc_service3}}">

        <h2>Logo Service 4</h2>
        <input type="file" id="logo_service4" name="logo_service4" onchange="previewImage(event, 'logoService4Preview')">
        <img id="logoService4Preview" src="{{ asset('storage/' . $i->logo_service4) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
        
        <h2>Judul Service 4</h2>
        <input type="text" id="judul_service4" name="judul_service4" value="{{$i->judul_service4}}">

        <h2>Deskripsi Service 4</h2>
        <input type="text" id="desc_service4" name="desc_service4" value="{{$i->desc_service4}}">

        <h2>Judul Produk</h2>
        <input type="text" id="judul_produk" name="judul_produk" value="{{$i->judul_produk}}">

        <h2>Deskripsi Produk</h2>
        <input type="text" id="desc_produk" name="desc_produk" value="{{$i->desc_produk}}">

        <h2>Logo Footer</h2>
        <input type="file" id="logo_footer" name="logo_footer" onchange="previewImage(event, 'logoFooterPreview')">
        <img id="logoFooterPreview" src="{{ asset('storage/' . $i->logo_footer) }}" alt="Image Preview" style="max-width: 200px; max-height: 150px;">
        
        <h2>Judul Footer</h2>
        <input type="text" id="judul_footer" name="judul_footer" value="{{$i->judul_footer}}">

        <h2>Deskripsi Footer</h2>
        <input type="text" id="desc_footer" name="desc_footer" value="{{$i->desc_footer}}">

        <!-- Submit Button -->
        <button type="submit">Update Layout</button>
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
