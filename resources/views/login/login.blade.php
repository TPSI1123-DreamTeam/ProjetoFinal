<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PRIME TIME EVENTS</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="wrapper">
        <video autoplay muted loop id="myVideo">
            <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
        <div class="login-container">
            <div class="login-box">
                <div class="header">
                    <h1>PRIME TIME EVENTS</h1>
                    <p>Creating Memories</p>
                </div>
                <form action="/login" method="POST" class="login-form">
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
                        <p>Ainda não tens conta? <a href="/registo">Regista-te aqui</a></p>
                        <p><a href="/forgot-password">Esqueceu-se da palavra-passe?</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>
</html>