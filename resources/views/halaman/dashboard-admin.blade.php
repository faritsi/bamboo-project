<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="/css/style-ds-admin.css" />
    <link rel="stylesheet" href="{{ asset('css/style-tabel-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-tabel-produk.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-tabel-pimpinan.css') }}">
    <!-- <link rel="stylesheet" href="/css/style-ds-produk.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="bg-container">
        <div id="bo-container">
            <!-- SideBar -->
            <div id="container-sidebar">
                <!-- <img src="https://via.placeholder.com/50x50" alt="Image"> -->
                <!-- <h2>Dashboard</h2> -->
                <div id="container-sidebar-menu">
                <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('admin') }}">Admin</a>
                        </li>
                        <li>
                            <a href="{{ route('produk') }}">Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('kegiatan') }}">Kegiatan</a>
                        </li>
                        <li>
                            <a href="{{ route('pimpinan') }}">Pimpinan Perusahaan</a>
                        </li>
                        <li>
                            <a href="{{ route('info-lainnya') }}">Info Lainnya</a>
                        </li>
                    </ul>
                </div>
                <div id="container-logout">
                    <ul>
                        <li>
                            <a href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Header Content -->
            <div id="bg-content">
                <div id="bo-content">
                    <div id="header-admin" class="clearfix">
                        <div id="left-admin">
                            <h3>Dashboard</h3>
                        </div>
                        <div id="right-admin" class="clearfix">
                            <div id="poto-admin">
                                <img src="https://via.placeholder.com/50x50" alt="Poto Admin">
                            </div>
                            <div id="nama-admin">
                                <h4>Nama Admin</h4>
                            </div>
                        </div>
                    </div>

                    <!-- Isi Content -->
                    <div id="bg-header-content">
                        <div id="bo-header-content">
                            <div id="header-content" class="clearfix">
                                <div id="judul-content">
                                    <h3>ADMIN</h3>
                                </div>
                                <div id="tambah-content" class="clearfix">
                                    <div id="container-icon-tambah">
                                        <div id="icon-tambah">
                                            <h4>+</h4>
                                        </div>
                                    </div>
                                    <div id="text-content">
                                        <h4>ADMIN</h4>
                                    </div>
                                </div>
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
                                        <tr>
                                            <td><span class="btn-toggle icon-plus"><i class="fa-solid fa-plus"></i></span></td>
                                            <td>1</td>
                                            <td>Hafied</td>
                                            <td>admin@gmail.com</td>
                                            <td>aktif</td>
                                            <td><span id="btn-edit"><i class="fa-solid fa-pen-to-square"></i><i class="fa-solid fa-trash"></i></span></td>
                                        </tr>
                                        <tr class="details-row">
                                            <td colspan="6">
                                                <div><strong>Nama Admin: </strong> M.Hafied</div>
                                                <div><strong>Username: </strong> admin@gmail.com</div>
                                                <div><strong>Password: </strong> 12345678</div>
                                                <div><strong>Status : </strong> Aktif</div>
                                            </td>
                                        </tr>

                                        
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
                                <form id="add-admin-form">
                                    <label for="name">Nama:</label>
                                    <input type="text" id="name" name="name" required>
                                    <label for="username">Username:</label>
                                    <input type="text" id="username" name="username" required>
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" name="password" required>
                                    <label for="role">Role:</label>
                                    <input type="text" id="role" name="role" required>
                                    <label for="status">Status:</label>
                                    <input type="text" id="status" name="status" required>
                                    <button type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".btn-toggle").on("click", function () {
                var row = $(this).closest("tr").next(".details-row");
                row.toggle();
                var icon = $(this).find("i");
                if (row.is(":visible")) {
                    $(this).removeClass("icon-plus").addClass("icon-minus");
                    icon.removeClass("fa-plus").addClass("fa-minus");
                } else {
                    $(this).removeClass("icon-minus").addClass("icon-plus");
                    icon.removeClass("fa-minus").addClass("fa-plus");
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("modal");
        var btn = document.getElementById("add-admin-btn");
        var span = document.getElementsByClassName("close-btn")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
    </script>
</body>
</html>