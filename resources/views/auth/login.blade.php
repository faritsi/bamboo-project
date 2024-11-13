<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/css/style-login.css" />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@2.0.8/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
</head>
<body>
    <div class="login-container">
        <div class="left-section">
            <lottie-player 
                src="https://lottie.host/8503dec0-9ac6-41ec-97ea-0f44e08ee746/s7aOVmWcS2.json" 
                background="transparent" 
                speed="1" 
                loop autoplay>
            </lottie-player>
        </div>
        
        <div class="right-section">
            <div class="login-form">
                <div class="login-header">
                    <div class="header-container">
                        <img src="img/logo/logo.png" alt="Company Logo" class="logo">
                        <h2 class="main-title">Login Admin</h2>
                    </div>
                    <div class="header-welcome">
                        <h3 class="welcome-message">Selamat Datang di Dashboard BMK</h3>
                        <h3 class="instruction">Silahkan Login Terlebih Dahulu!</h3>
                    </div>
                </div>
                <form action="{{ url('login/proses') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <span class="material-symbols-outlined">
                            passkey
                        </span>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Email" name="username">
                    </div>
                    
                    <div class="input-group">
                        <span class="material-symbols-outlined">
                            lock
                        </span>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>

                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn-submit">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>