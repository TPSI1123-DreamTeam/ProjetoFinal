<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Login | PRIME TIME EVENTS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite('resources/css/login.css')
</head>
<body>
<div class="wrapper">
    <video autoplay muted loop id="myVideo">
        <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
    </video>
    <div class="video-overlay"></div>

    @if(session('error'))
    <div id="error-notification" 
         class="fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
        {{ session('error') }}
    </div>
    @endif

    <div class="login-container">
        <div class="logo-section">
            <img src="{{ asset ('images/Logotipo.png') }}" alt="Logotipo" class="logo-img">
        </div>
    <div class="divider"></div>
        <div class="form-section">
            <div class="login-box">
                <form action="{{ route('login') }}" method="POST" class="login-form">
                    @csrf
                    <div class="form-group">
                        <a type="button" class="google-login-button" href="/login/google">
                            Entrar com o Google <i class='bx bxl-google'></i>
                        </a>
                    </div>
                    <div class="or-divider">
                        <span>Ou</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Digite o seu email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Palavra-passe</label>
                        <input type="password" id="password" name="password" placeholder="Digite a sua palavra-passe" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="login-button">Entrar</button>
                        <a href="/login/google" class="alt-google-login">Entrar com o Google</a>
                    </div>
                    <div class="form-footer">
                        <p>Ainda não tens conta? <a href="/register">Regista-te aqui</a></p>
                        <p><a href="/forgot-password">Esqueceu-se da palavra-passe?</a></p>
                    </div>
                </form>
            </div>
        </div>
        <a href="/" class="back-home">Voltar à página inicial</a>
    </div>
</div>
</body>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const errorNotification = document.getElementById('error-notification');

        if (errorNotification) {
            setTimeout(() => {
                errorNotification.classList.remove('opacity-0');
                errorNotification.classList.add('opacity-100');
            }, 100);

            setTimeout(() => {
                errorNotification.classList.remove('opacity-100');
                errorNotification.classList.add('opacity-0');
            }, 3000);
        }
    });
</script>


</html>
