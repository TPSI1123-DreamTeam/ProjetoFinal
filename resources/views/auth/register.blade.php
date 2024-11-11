<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo | PRIME TIME EVENTS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite('resources/css/register.css')
    @vite('resources/css/welcomeFooter.css')
</head>
<body>
<div class="wrapper">
    <video autoplay muted loop id="myVideo">
        <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
    </video>
    <div class="video-overlay"></div>
    <div class="register-container">
        <div class="logo-section">
            <img src="{{ asset('images/Logotipo.png') }}" alt="Logotipo" class="logo-img">
        </div>
        <div class="divider"></div> <!-- Linha de sombra entre logotipo e formulário -->
        <div class="register-box">
            <form action="{{ route('register') }}" method="POST" class="register-form">
                @csrf
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Digite o seu nome" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite o seu email" required>
                </div>
                <div class="form-group">
                    <label for="password">Palavra-passe</label>
                    <input type="password" id="password" name="password" placeholder="Digite a sua palavra-passe" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirme a Palavra-passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Digite novamente a palavra-passe" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Data de Nascimento</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="register-button">Registar</button>
                </div>
                <div class="form-footer">
                    <p>Já tens conta? <a href="/login">Entra aqui</a></p>
                    <div class="google-login">
                        <a href="/auth/google" class="google-button">Entrar com Google</a>
                    </div>
                </div>
            </form>
            <a href="/" class="back-home">Voltar à página inicial</a>
        </div>
    </div>
</div>
    @include('master.welcomeFooter')
</body>
</html>
