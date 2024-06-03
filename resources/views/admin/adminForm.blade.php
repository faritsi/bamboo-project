@extends('halaman.admin')
@section('content')
<div id="bg-header-content">
    <div id="bo-header-content">
        <div id="header-content" class="clearfix">
            <div id="judul-content">
                <h3>{{$title}}</h3>
            </div>
            @if ($user->role_id == 1)                    
            <div id="tambah-content" class="clearfix">
                    <div id="container-icon-tambah">
                        <div id="icon-tambah">
                            <h4>+</h4>
                        </div>
                    </div>
                    <div id="text-content">
                        <h4>Tambah</h4>
                    </div>
                </div>
            @endif
        </div>

        <!-- Search Box -->
        <div id="bg-show-search">
            <div id="bo-show-search">
                <div id="show-search" class="clearfix">
                    <div id="container-show" class="clearfix">
                        <div id="text-show">
                            <h3>Show</h3>
                        </div>
                        <div id="show-entries">
                            10
                        </div>
                        <div id="text-entries">
                            <h3>Entries</h3>
                        </div>
                    </div>
                    <div id="container-search" class="clearfix">
                        <div id="text-search">
                            <h3>Search: </h3>
                        </div>
                        <input type="text" class="search-input" placeholder="Enter Name">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Admin -->
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
                    @foreach ($users as $u)                      
                    <tr>
                        <td><span class="btn-toggle icon-plus"><i class="fa-solid fa-plus"></i></span></td>
                        <td>1</td>
                        <td>{{$u->name}}</td>
                        <td>{{$u->username}}</td>
                        <td>aktif</td>
                        <td><span id="btn-edit"><i class="fa-solid fa-pen-to-square"></i><i class="fa-solid fa-trash"></i></span></td>
                    </tr>
                    <tr class="details-row">
                        <td colspan="6">
                            <div><strong>Nama Admin: </strong> {{$u->role->name}}</div>
                            <div><strong>Username: </strong> {{$u->username}}</div>
                            <div><strong>Status : </strong> Aktif</div>
                        </td>
                    </tr>
                    @endforeach

                    
                </tbody>
            </table>

            <!-- Next Btn -->
            <div id="bg-btn">
                <div id="bo-btn">
                    <div id="btn" class="clearfix">
                        <div id="prev-btn">
                            <i class="fa-solid fa-circle-chevron-left"></i>
                        </div>
                        <div id="count-page-tabel">1, 2 ,3</div>
                        <div id="next-btn">
                            <i class="fa-solid fa-circle-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Tambah Admin</h2>
        <form id="add-admin-form" action="{{ route('admin.store') }}" method="POST">
            @csrf
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="password">Konfirmasi Password:</label>
            <input type="password" name="password_confirm" placeholder="Konfirmasi Password" required>
            {{-- <label for="role">Role:</label> --}}
            <input type="text" id="role" name="role_id" required value="2" hidden>
            {{-- <label for="status">Status:</label> --}}
            <input type="text" id="status" name="status" value="aktif" hidden>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection