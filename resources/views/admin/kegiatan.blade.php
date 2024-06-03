@extends('halaman.admin')
@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
        <div id="bg-kegiatan">
            <div id="bo-kegiatan">
                <div id="container-kegiatan" class="clearfix">
                    <!-- Bagian Atas -->
                    <div id="info-kegiatan">
                        <div id="letak-foto">
                            <h3>Foto Bagian Atas</h3>
                        </div>
                        <!-- <form action="your-upload-url" method="POST" enctype="multipart/form-data"> -->
                            
                            <div id="foto">
                                <label for="foto1">Foto 1</label>
                                <input type="file" id="foto1" name="foto1" class="upload-button">
                            </div>
                            <div id="foto">
                                <label for="foto2">Foto 2</label>
                                <input type="file" id="foto2" name="foto2" class="upload-button">
                            </div>
                        <!-- </form> -->
                    </div>

                    <!-- Bagian Tengah -->
                    <div id="info-kegiatan">
                        <div id="letak-foto">
                            <h3>Foto Bagian Atas</h3>
                        </div>
                        <!-- <form action="your-upload-url" method="POST" enctype="multipart/form-data"> -->
                            
                            <div id="foto">
                                <label for="foto1">Foto 3</label>
                                <input type="file" id="foto3" name="foto3" class="upload-button">
                            </div>
                            <div id="foto">
                                <label for="foto2">Foto 4</label>
                                <input type="file" id="foto4" name="foto4" class="upload-button">
                            </div>
                            <div id="foto">
                                <label for="foto2">Foto 5</label>
                                <input type="file" id="foto5" name="foto5" class="upload-button">
                            </div>
                        <!-- </form> -->
                    </div>

                    <!-- Bagian Bawah -->
                    <div id="info-kegiatan">
                        <div id="letak-foto">
                            <h3>Foto Bagian Bawah</h3>
                        </div>
                        <!-- <form action="your-upload-url" method="POST" enctype="multipart/form-data"> -->
                            
                            <div id="foto">
                                <label for="foto1">Foto 6</label>
                                <input type="file" id="foto6" name="foto6" class="upload-button">
                            </div>
                            <div id="foto">
                                <label for="foto2">Foto 74</label>
                                <input type="file" id="foto7" name="foto7" class="upload-button">
                            </div>
                            <div id="foto">
                                <label for="foto2">Foto 8</label>
                                <input type="file" id="foto8" name="foto8" class="upload-button">
                            </div>
                            <div id="foto">
                                <label for="foto2">Foto 9</label>
                                <input type="file" id="foto8" name="foto9" class="upload-button">
                            </div>
                        <!-- </form> -->
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
@endsection