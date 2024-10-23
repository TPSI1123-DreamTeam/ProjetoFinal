<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo | PRIME TIME EVENTS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <div class="header">
                <h1>PRIME TIME EVENTS</h1>
                <p>Creating Memories</p>
            </div>
            <form action="{{ route('register') }}" method="POST" class="register-form">
            @csrf
            <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Digite o seu name" required>
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
                    <label for="password">confirme palavra-passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Digite a sua palavra-passe" required>
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
</body>
</html>
