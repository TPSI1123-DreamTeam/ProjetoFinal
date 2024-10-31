<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo | PRIME TIME EVENTS</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="wrapper">
    <video autoplay muted loop id="myVideo">
            <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
        <div class="register-container">
        <div class="register-box">
            <div class="header">
                <h1>PRIME TIME EVENTS</h1>
                <p>Creating Memories</p>
            </div>
            <form action="/register" method="POST" class="register-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite o seu email" required>
                </div>
                <div class="form-group">
                    <label for="password">Palavra-passe</label>
                    <input type="password" id="password" name="password" placeholder="Digite a sua palavra-passe" required>
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
                    <p>Ou entra com:</p>
                    <div class="google-login">
                        <a href="/auth/google" class="google-button">Entrar com Google</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>
