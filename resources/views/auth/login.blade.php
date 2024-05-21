<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/css/style-login.css" />
</head>
<body>
    <div class="square-container">
        <div class="left-section">
            <img
                src="https://via.placeholder.com/800x600"
                alt="Background Placeholder Image"
                class="background-image"
            />
            <div class="logo-container">
                <img src="logo.png" alt="Logo" class="logo" />
            </div>
        </div>
        <div class="right-section">
            <div class="login-form">
                <h2>Login</h2>
                <form action="{{ url('login/proses') }}" method="post">
                @csrf
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="example@example.com" name="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>