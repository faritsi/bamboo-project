@extends('halaman.admin')
@section('content')
<div id="bg-header-content">
    <div id="bo-header-content">
        <div id="header-content" class="clearfix">
            <div id="judul-content">
                <h3>{{$title}}</h3>
            </div>
            <div id="tambah-content">
                <div id="container-icon-tambah">
                    <div id="text-content">
                        <h4>Update Data</h4>
                    </div>
                </div>
            </div>
        </div>
        <div id="bg-info">
            <div id="bo-info">
                <div id="container-info" class="clearfix">
                    <!-- Bagian Atas -->
                    @if(session()->has('success'))
                        <div class="hore">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div id="info-info">
                        <div id="footer-info">
                            <h3>Footer</h3>
                        </div>
                        <div id="email">
                            Email
                        </div>
                        <input type="text" class="email-input" placeholder="Enter your email">
                        <div id="whatsapp">
                            Nomor WhatsApp
                        </div>
                        <input type="number" class="whatsapp-input" placeholder="Enter WhatsApp number">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Tambah {{$title}}</h2>
        <form id="add-admin-form" action="{{ route('info.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- <label for="judul">ID:</label> --}}
            <input type="text" id="iid" name="iid"  hidden>
            <label for="judul">Email:</label>
            <input type="email" id="email" name="email" >
            <label for="nowa">No. WhatsApp:</label>
            <input type="text" id="nowa" name="nowa" >
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection