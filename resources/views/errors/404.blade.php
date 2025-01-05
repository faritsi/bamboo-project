<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Halaman Tidak Ditemukan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 100px;
            color: #dc3545;
        }
        p {
            font-size: 20px;
            color: #6c757d;
        }
        a {
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>ERROR 404</h1>
    <p>Halaman yang Anda cari tidak dapat ditemukan.</p>
    <a href="{{ url()->previous() }}">Go Back</a> | <a href="dashboard">Home</a>

</body>
</html>
