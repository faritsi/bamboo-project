@extends('halaman.admin')
@section('content')
<div id="bg-info">
    <div id="bo-info">
        <div id="container-info" class="clearfix">
            <!-- Bagian Atas -->
            <div id="info-info">
                {{-- <div id="footer-info">
                    <h3>Footer</h3>
                </div> --}}
                <div id="email">
                    <strong>Email</strong>
                </div>
                <input type="text" class="email-input" placeholder="Enter your email" disabled>
                <div id="whatsapp">
                    <Strong>Nomor WhatsApp</Strong>
                </div>
                <input type="number" class="whatsapp-input" placeholder="Enter WhatsApp number" disabled>
            </div>
        </div>
    </div>

    <div id="bg-tambah-data">
        <div id="bo-tambah-data">
            <div class="icon-tambah-data">
                <span class="material-symbols-outlined">
                add
                </span></td>                                                        
            </div>
            <div id="text">
                <strong>Admin</strong>
            </div>
        </div>
    </div>
</div>
{{-- <div id="modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Tambah {{$title}}</h2>
        <form id="add-admin-form" action="{{ route('info.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
             --}}
            {{-- <label for="judul">ID:</label> --}}
            {{-- <input type="text" id="iid" name="iid"  hidden>
            <label for="judul">Email:</label>
            <input type="email" id="email" name="email" >
            <label for="nowa">No. WhatsApp:</label>
            <input type="text" id="nowa" name="nowa" >
            <button type="submit">Submit</button>
        </form>
    </div>
</div> --}}
@endsection