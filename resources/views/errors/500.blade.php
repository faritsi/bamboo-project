<!-- resources/views/errors/500.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Kesalahan Server</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px;
        }
        h1 {
            font-size: 100px;
            color: #ffc107;
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
    <h1>500</h1>
    <p>Terjadi kesalahan pada server. Mohon coba lagi nanti.</p>
    <a href="{{ url('/') }}">Kembali ke Halaman Utama</a>
</body>
</html>
