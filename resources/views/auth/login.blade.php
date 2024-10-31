<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PRIME TIME EVENTS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite('resources/css/login.css')
    @vite('resources/css/welcomeFooter.css')
</head>
<body>
<div class="wrapper">
    <video autoplay muted loop id="myVideo">
        <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
    </video>
    <div class="video-overlay"></div>
    <div class="login-container">
        <div class="logo-section">
            <img src="{{ asset ('images/Logotipo.png') }}" alt="Logotipo" class="logo-img">
        </div>
    <div class="divider"></div> <!-- Linha de sombra entre logotipo e formulário -->
        <div class="form-section">
            <div class="login-box">
                <form action="{{ route('login') }}" method="POST" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Digite o seu email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Palavra-passe</label>
                        <input type="password" id="password" name="password" placeholder="Digite a sua palavra-passe" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="login-button">Entrar</button>
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
<footer class="footer">
            @include('master.welcomeFooter')
        </footer>
</body>
</html>
